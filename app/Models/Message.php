<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'parent_id',
        'subject',
        'message',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the sender of the message
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver of the message
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the parent message
     */
    public function parent()
    {
        return $this->belongsTo(Message::class, 'parent_id');
    }

    /**
     * Get all replies to this message
     */
    public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Get the root message of the thread
     */
    public function getRootMessage()
    {
        $message = $this;
        while ($message->parent_id) {
            $message = $message->parent;
        }
        return $message;
    }

    /**
     * Get all messages in the thread
     */
    public function getThreadMessages()
    {
        $root = $this->getRootMessage();
        return Message::where('id', $root->id)
            ->orWhere('parent_id', $root->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for messages received by user
     */
    public function scopeReceivedBy($query, $userId)
    {
        return $query->where('receiver_id', $userId);
    }

    /**
     * Scope for messages sent by user
     */
    public function scopeSentBy($query, $userId)
    {
        return $query->where('sender_id', $userId);
    }
}
