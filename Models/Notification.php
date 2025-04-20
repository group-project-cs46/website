<?php

namespace Models;

use Core\App;
use Core\Database;

class Notification
{
    public static function getAllByUserId($userId)
    {
        $db = App::resolve(Database::class);
        return $db->query("
            SELECT * 
            FROM notifications
            WHERE user_id = ?
                AND is_read = FALSE
                AND (expires_at IS NULL OR expires_at > NOW())
        ", [$userId])->get();

    }

    public static function markAsReadById($id)
    {
        $db = App::resolve(Database::class);
        $db->query("UPDATE notifications SET is_read = TRUE WHERE id = ?", [$id]);
    }

    public static function getById($id)
    {
        $db = App::resolve(Database::class);
        return $db->query("SELECT * FROM notifications WHERE id = ?", [$id])->find();
    }

    public static function create($user_id, $title, $message, $action_url = null, $expires_at = null)
    {
        $db = App::resolve(Database::class);
        $db->query("INSERT INTO notifications (user_id, title, message, action_url, expires_at) VALUES (?, ?, ?, ?, ?)", [
            $user_id,
            $title,
            $message,
            $action_url,
            $expires_at
        ]);
    }
}