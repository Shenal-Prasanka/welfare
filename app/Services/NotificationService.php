<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Send notification to all users except role 'User'
     */
    public static function sendToAllStaff($type, $title, $message, $icon = null, $color = 'info')
    {
        // Get all users except those with role 'User' (capital U)
        $users = User::whereHas('roles', function($query) {
            $query->where('name', '!=', 'User');
        })->get();

        foreach ($users as $user) {
            Notification::create([
                'user_id' => $user->id,
                'type' => $type,
                'title' => $title,
                'message' => $message,
                'icon' => $icon,
                'color' => $color,
            ]);
        }

        return $users->count();
    }

    /**
     * Send notification when regiment is added
     */
    public static function regimentAdded($regimentName)
    {
        return self::sendToAllStaff(
            'regiment',
            'New Regiment Added',
            "A new regiment '{$regimentName}' has been added to the system.",
            'fas fa-flag',
            'success'
        );
    }

    /**
     * Send notification when rank is added
     */
    public static function rankAdded($rankName)
    {
        return self::sendToAllStaff(
            'rank',
            'New Rank Added',
            "A new rank '{$rankName}' has been added to the system.",
            'fas fa-star',
            'success'
        );
    }

    /**
     * Send notification when unit is added
     */
    public static function unitAdded($unitName)
    {
        return self::sendToAllStaff(
            'unit',
            'New Unit Added',
            "A new unit '{$unitName}' has been added to the system.",
            'fas fa-building',
            'success'
        );
    }

    /**
     * Send notification when category is added
     */
    public static function categoryAdded($categoryName)
    {
        return self::sendToAllStaff(
            'category',
            'New Category Added',
            "A new category '{$categoryName}' has been added to the system.",
            'fas fa-tags',
            'success'
        );
    }

    /**
     * Send notification when loan interest is added/updated
     */
    public static function loanInterestUpdated($interestRate)
    {
        return self::sendToAllStaff(
            'loan_interest',
            'Loan Interest Rate Updated',
            "The loan interest rate has been updated to {$interestRate}%.",
            'fas fa-percentage',
            'warning'
        );
    }

    /**
     * Get unread count for a user
     */
    public static function getUnreadCount($userId)
    {
        return Notification::forUser($userId)->unread()->count();
    }

    /**
     * Mark all notifications as read for a user
     */
    public static function markAllAsRead($userId)
    {
        return Notification::forUser($userId)->unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }
}
