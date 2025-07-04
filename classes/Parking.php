<?php
require_once __DIR__.'/Database.php';

class Parking
{
    public static function getAll(): array
    {
        $db = Database::getInstance()->getConnection();
        return $db->query('SELECT id, name FROM parkings')->fetch_all(MYSQLI_ASSOC);
    }
}
