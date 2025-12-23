<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display all notifications for the current user
     */
    public function index()
    {
        $notifications = Notification::forUser(Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $unreadCount = NotificationService::getUnreadCount(Auth::id());

        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    /**
     * Get unread notification count (API)
     */
    public function unreadCount()
    {
        $count = NotificationService::getUnreadCount(Auth::id());
        return response()->json(['count' => $count]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        NotificationService::markAllAsRead(Auth::id());

        return redirect()->route('notifications.index')
            ->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $notification->delete();

        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted successfully.');
    }
}
