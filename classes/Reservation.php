<?php
require_once __DIR__.'/Database.php';
require_once __DIR__.'/ParkingSpot.php';
require_once __DIR__.'/Payment.php';

class Reservation
{
    public static function create(int $userId, int $spotId, string $start, string $end): int
    {
        $db = Database::getInstance()->getConnection();

        /* --- INSERT --------------------------------------------------- */
        $stmt = $db->prepare(
            'INSERT INTO reservations (user_id, spot_id, start_datetime, end_datetime)
             VALUES (?, ?, ?, ?)'
        );
        $stmt->bind_param('iiss', $userId, $spotId, $start, $end);
        if (!$stmt->execute()) {
            throw new RuntimeException('Reservation failed: '.$stmt->error);
        }

        /* ❶ ZACHOWAJ insert_id OD RAZU! */
        $reservationId = $db->insert_id;

        /* --- UPDATE statusu miejsca ---------------------------------- */
        ParkingSpot::setStatus($spotId, 'reserved');

        /* --- Wpis w payments (pending) -------------------------------- */
        Payment::create($reservationId, self::calculateAmountRaw($start, $end));

        return $reservationId;
    }

    /** bardzo uproszczona wycena */
    private static function calculateAmountRaw(string $start, string $end): float
    {
        $diff = (strtotime($end) - strtotime($start)) / 3600; // godziny
        return max(1, $diff) * 5.0; // 5 zł za godzinę
    }

    public static function calculateAmount(int $reservationId): float
    {
        $db = Database::getInstance()->getConnection();
        $q  = $db->query("SELECT amount FROM payments WHERE reservation_id = $reservationId");
        return (float)($q->fetch_assoc()['amount'] ?? 0.0);
    }

    public static function getByUser(int $userId): array
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT r.*, p.status AS payment_status
                FROM reservations r
                LEFT JOIN payments p ON p.reservation_id = r.id
                WHERE r.user_id = $userId
                ORDER BY r.start_datetime DESC";
        return $db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
}
