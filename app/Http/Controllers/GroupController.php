<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Apply the 'auth' middleware to all methods in this controller.
     */
    public function __construct()
    {
        // This line ensures that a user must be logged in to access any method
        // in this controller (like create, storeGroup, index, store, messages).
        $this->middleware('auth');
    }

    /**
     * Shows the group creation view and lists the user's current groups.
     * (नया ग्रुप बनाने का व्यू दिखाता है और वर्तमान यूज़र के ग्रुप्स को लिस्ट करता है।)
     */
    public function create()
    {
        // Auth::user() will now be guaranteed to return a User model instance, not null.
        $users = User::all(); // All users
        $groups = Auth::user()->groups; // Current user's groups
        return view('groups.create', compact('users', 'groups'));
    }

    // ... (rest of the controller methods remain the same)
    
    /**
     * Creates a new group and attaches the selected users as members.
     * (नया ग्रुप बनाता है और चुने हुए यूज़र्स को मेंबर बनाता है।)
     */
    public function storeGroup(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255|unique:groups,name',
            'members' => 'required|array',
            'members.*' => 'exists:users,id',
        ]);
        
        // 1. Create the Group
        $group = Group::create([
            'name' => $request->group_name,
            'owner_id' => Auth::id(),
        ]);
        
        // 2. Attach members (The current user must also be attached)
        $member_ids = array_merge($request->members, [Auth::id()]);
        // Attach unique IDs to avoid duplicates
        $group->members()->attach(array_unique($member_ids));
        
        return redirect()->route('user.groups.chat', $group)->with('success', 'Group created successfully!');
    }


    /**
     * Shows the group chat view and passes required group data.
     * (ग्रुप चैट व्यू दिखाता है और ज़रूरी ग्रुप डेटा प्रदान करता है।)
     */
    public function index(Group $group)
    {
        // Ensure the user is a member of this group
        if (!$group->members->contains(Auth::id())) {
            abort(403, 'You are not a member of this group.');
        }

        // Data of all members of the group
        $groupMembers = $group->members;
        return view('groups.chat', compact('group', 'groupMembers'));
    }

    /**
     * Stores a new message in the group.
     * (ग्रुप में एक नया मैसेज स्टोर करता है।)
     */
    public function store(Request $request, Group $group)
    {
        // Ensure the user is a member of this group
        if (!$group->members->contains(Auth::id())) {
            return response()->json(['error' => 'Not a member of this group.'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = $group->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            // group_id is automatically set via the relationship
        ]);

        // If using broadcasting for real-time chat, dispatch event here.

        return response()->json([
            'message' => 'Message sent!', 
            'data' => [
                'user_name' => Auth::user()->name, 
                'message_text' => $message->message,
                'time' => $message->created_at->diffForHumans(),
            ]
        ]);
    }

    /**
     * Returns all messages of the group in JSON format for AJAX fetching.
     * (ग्रुप के सभी मैसेजेस को AJAX फेचिंग के लिए JSON फॉर्मेट में लौटाता है।)
     */
    public function messages(Group $group)
    {
        // Ensure the user is a member of this group
        if (!$group->members->contains(Auth::id())) {
            return response()->json(['error' => 'Not a member of this group.'], 403);
        }

        $messages = $group->messages()
            ->with('user') // Eager load the user who sent the message
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'user_name' => $message->user->name,
                    'message_text' => $message->message,
                    'time' => $message->created_at->diffForHumans(),
                    'is_me' => $message->user_id === Auth::id(),
                ];
            });

        return response()->json(['messages' => $messages]);
    }
}