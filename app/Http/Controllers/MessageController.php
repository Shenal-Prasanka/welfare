<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display inbox messages - one row per user
     */
    public function inbox()
    {
        // Get latest message from each sender
        $messages = Message::with(['sender'])
            ->receivedBy(Auth::id())
            ->select('messages.*')
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('messages')
                    ->where('receiver_id', Auth::id())
                    ->groupBy('sender_id');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Add unread count per sender
        foreach ($messages as $message) {
            $message->unread_count = Message::where('sender_id', $message->sender_id)
                ->where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->count();
        }

        $unreadCount = Message::receivedBy(Auth::id())->unread()->count();

        return view('messages.inbox', compact('messages', 'unreadCount'));
    }

    /**
     * Display sent messages - one row per user
     */
    public function sent()
    {
        // Get latest message to each receiver
        $messages = Message::with(['receiver'])
            ->sentBy(Auth::id())
            ->select('messages.*')
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('messages')
                    ->where('sender_id', Auth::id())
                    ->groupBy('receiver_id');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Add message count per receiver
        foreach ($messages as $message) {
            $message->message_count = Message::where('sender_id', Auth::id())
                ->where('receiver_id', $message->receiver_id)
                ->count();
        }

        return view('messages.sent', compact('messages'));
    }

    /**
     * Show compose message form
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())
            ->whereHas('roles', function($query) {
                $query->where('name', '!=', 'User');
            })
            ->orderBy('name')
            ->get();

        return view('messages.create', compact('users'));
    }

    /**
     * Store a new message
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'parent_id' => 'nullable|exists:messages,id',
        ]);

        $newMessage = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'parent_id' => $request->parent_id,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Always redirect to conversation view with the other user
        return redirect()->route('messages.conversation', $request->receiver_id)
            ->with('success', 'Message sent successfully!');
    }

    /**
     * Display a specific message with thread
     */
    public function show($id)
    {
        $message = Message::with(['sender', 'receiver', 'parent'])->findOrFail($id);

        // Check if user is sender or receiver
        if ($message->sender_id !== Auth::id() && $message->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized access to message');
        }

        // Get all messages in the thread
        $threadMessages = $message->getThreadMessages();

        // Mark unread messages as read for current user
        foreach ($threadMessages as $msg) {
            if ($msg->receiver_id === Auth::id() && !$msg->is_read) {
                $msg->markAsRead();
            }
        }

        // Get the root message for reply
        $rootMessage = $message->getRootMessage();

        return view('messages.show', compact('message', 'threadMessages', 'rootMessage'));
    }

    /**
     * Delete a message
     */
    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        // Only sender or receiver can delete
        if ($message->sender_id !== Auth::id() && $message->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $message->delete();

        return back()->with('success', 'Message deleted successfully!');
    }

    /**
     * Get unread message count
     */
    public function unreadCount()
    {
        $count = Message::receivedBy(Auth::id())->unread()->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Mark message as read
     */
    public function markAsRead($id)
    {
        $message = Message::findOrFail($id);

        if ($message->receiver_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $message->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Show conversation with a specific user
     */
    public function conversation($userId)
    {
        $otherUser = User::findOrFail($userId);
        
        // Get all messages between current user and other user
        $messages = Message::where(function($query) use ($userId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $userId);
            })
            ->orWhere(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', Auth::id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark unread messages from other user as read
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        $lastMessage = $messages->last();

        return view('messages.conversation', compact('otherUser', 'messages', 'lastMessage'));
    }
}
