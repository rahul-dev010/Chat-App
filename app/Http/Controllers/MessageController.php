<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivateMessage;


class MessageController extends Controller
{
    

    // 💬 Save message
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer',
            'content' => 'required|string|max:1000',
        ]);

        PrivateMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        return response()->json(['success' => true]);
    }

    // 🔁 Fetch messages between 2 users
    public function fetchMessages(Request $request)
    {
      
        $receiverId = $request->receiver_id;
        $userId = auth()->id();

        $messages = PrivateMessage::where(function ($query) use ($userId, $receiverId) {
                $query->where('sender_id', $userId)->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($query) use ($userId, $receiverId) {
                $query->where('sender_id', $receiverId)->where('receiver_id', $userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }




}




