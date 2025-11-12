<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $table = 'group_chats'; // आपके टेबल का नाम

    protected $fillable = [
        'group_id',
        'user_id',
        'message',
    ];

    /**
     * The group the message belongs to.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    
    /**
     * The user who sent the message.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}