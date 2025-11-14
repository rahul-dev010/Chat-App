<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PrivateMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrivateChatController extends Controller
{
    /**
     * Display a list of all users available for private chat.
     */
    protected function getUsersWithLastMessage()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return $users->map(function ($user) {
            // Last message between auth user and this user
            $lastMessage = PrivateMessage::where(function($query) use ($user) {
                $query->where('sender_id', Auth::id())->where('receiver_id', $user->id);
            })->orWhere(function($query) use ($user) {
                $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
            })->latest()->first();

            // Count of unread messages FROM this user TO auth user
            $unreadCount = PrivateMessage::where('sender_id', $user->id)
                ->where('receiver_id', Auth::id())
                ->whereNull('read_at')
                ->count();

            $user->last_message = $lastMessage;
            $user->unread_count = $unreadCount;

            return $user;
        });
    }


    /**
     * Display the combined chat UI, potentially without an active receiver.
     */
    public function index()
    {
        // Load all users for the sidebar
        $usersWithLastMessage = $this->getUsersWithLastMessage();
        // Check if there's any user to automatically select (e.g., the first one)
        // For simplicity, we just return the view with the list, letting the UI handle the "select user" message.
        return view('private_chat.combined_chat', [
            'usersWithLastMessage' => $usersWithLastMessage,
            'receiver' => null,
            'messages' => collect(),
        ]);
    }

    public function showChat(User $user)
    {
        // 1. Mark all unread messages from this user as read
        PrivateMessage::where('sender_id', $user->id)
                      ->where('receiver_id', Auth::id())
                      ->whereNull('read_at')
                      ->update(['read_at' => now()]);

        // 2. Load the initial set of messages
        $messages = PrivateMessage::where(function($query) use ($user) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })
        ->with('sender', 'receiver') // Eager load sender/receiver info
        ->orderBy('created_at', 'asc')
        ->limit(50) // Load last 50 messages
        ->get();

        // 3. Load all users again for the sidebar (using the helper)
        $usersWithLastMessage = $this->getUsersWithLastMessage();

        // 4. Return the combined view
        return view('private_chat.combined_chat', [
            'receiver' => $user,
            'messages' => $messages,
            'usersWithLastMessage' => $usersWithLastMessage, // Passing the list for the sidebar
        ]);
    }

    /**
     * Store a new private message.
     * @param Request $request
     * @param User $user The user receiving the message.
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $message = PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $request->content,
        ]);
        return redirect()->route('private.chat.show', $user->id)->with('success', 'Message sent!');
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Message sent!',
        //     'data' => $message->load('sender') 
        // ], 201);
    }

    /**
     * Fetch the latest messages for a chat (used for polling/AJAX).
     * @param User $user The user whose messages we are fetching.
     */
    public function messages(User $user)
    {
        // This query fetches messages between the logged-in user and the target user
        $messages = PrivateMessage::where(function($query) use ($user) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id', $user->id)->where('receiver_id', Auth::id());
        })
        ->with('sender')
        ->orderBy('created_at', 'asc')
        ->get();

        // Mark incoming messages as read when fetching them
        PrivateMessage::where('sender_id', $user->id)
                      ->where('receiver_id', Auth::id())
                      ->whereNull('read_at')
                      ->update(['read_at' => now()]);

        return response()->json($messages);
    }
}