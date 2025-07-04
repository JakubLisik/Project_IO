<?php
require_once __DIR__.'/Database.php';

class ParkingSpot
{
    public static function getByParking(int $parkingId, bool $onlyFree = true): array
    {
        $db = Database::getInstance()->getConnection();
        $sql = 'SELECT id, number FROM parking_spots WHERE parking_id = ?';
        if ($onlyFree) $sql .= " AND status = 'free'";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $parkingId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function setStatus(int $spotId, string $status): bool
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('UPDATE parking_spots SET status = ? WHERE id = ?');
        $stmt->bind_param('si', $status, $spotId);
        return $stmt->execute();
    }
}
