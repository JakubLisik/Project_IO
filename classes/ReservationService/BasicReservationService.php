<?php
require_once __DIR__.'/../Reservation.php';
require_once __DIR__.'/ReservationService.php';

class BasicReservationService implements ReservationService
{
    public function make(int $userId, int $spotId, DateTime $start, DateTime $end): int
    {
        return Reservation::create(
            $userId, $spotId,
            $start->format('Y-m-d H:i:s'),
            $end->format('Y-m-d H:i:s')
        );
    }
}
