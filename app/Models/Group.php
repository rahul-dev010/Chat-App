<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id'];

    /**
     * The users that belong to the group (members).
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id');
    }

    /**
     * The messages in the group chat.
     */
    public function messages()
    {
        return $this->hasMany(Message::class); // मान लीजिए GroupChat मॉडल का नाम Message है
    }
    
    /**
     * The owner of the group.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}