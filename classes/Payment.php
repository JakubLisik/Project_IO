<?php
require_once __DIR__.'/Database.php';

class Payment
{
    public static function create(int $reservationId, float $amount): int
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "INSERT INTO payments (reservation_id, amount, status, created_at)
             VALUES (?, ?, 'pending', NOW())"
        );
        $stmt->bind_param('id', $reservationId, $amount);
        $stmt->execute();
        return $db->insert_id;
    }

    public static function updateStatus(int $id, string $status): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('UPDATE payments SET status = ? WHERE id = ?');
        $stmt->bind_param('si', $status, $id);
        return $stmt->execute();
    }

    public static function updateStatusByReservation(int $reservationId, string $status): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('UPDATE payments SET status = ? WHERE reservation_id = ?');
        $stmt->bind_param('si', $status, $reservationId);
        return $stmt->execute();
    }
}
