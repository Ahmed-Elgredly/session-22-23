<?php

require_once __DIR__ . "/../Model.php";
require_once __DIR__ . "/../../../core/Database.php";

class AdminModel extends Model
{
    public static function banUser()
    {
        $DB = Database::getConnection();

        $UserId = Request::input('userId');
        
        $stmt = $DB->query("SELECT * FROM users WHERE id = '{$UserId}' ");

        $user = $stmt->fetch();

        $stmt = $DB->prepare("UPDATE users 
                                SET is_banned = :newBan
                                WHERE id = :userId
                                ");

        $user['is_banned'] = !$user['is_banned'];
        
        $stmt ->execute([
            'newBan' => $user['is_banned'],
            'userId' => $UserId,
        ]);

        return $user;
    }
}