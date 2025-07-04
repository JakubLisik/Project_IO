<?php
require_once __DIR__.'/Database.php';

class User
{
    public static function register(string $email, string $password): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
            return false;
        }
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('INSERT IGNORE INTO users (email, password) VALUES (?, ?)');
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param('ss', $email, $hash);
        return $stmt->execute();
    }

    public static function login(string $email, string $password): ?array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT id, password FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if ($res && password_verify($password, $res['password'])) {
            return ['id' => (int)$res['id'], 'email' => $email];
        }
        return null;
    }
}
