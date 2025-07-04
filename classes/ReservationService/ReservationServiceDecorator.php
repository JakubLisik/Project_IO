<?php
require_once __DIR__.'/ReservationService.php';

abstract class ReservationServiceDecorator implements ReservationService
{
    protected ReservationService $inner;
    public function __construct(ReservationService $inner) { $this->inner = $inner; }
    public function make(int $userId, int $spotId, DateTime $start, DateTime $end): int
    {
        return $this->inner->make($userId, $spotId, $start, $end);
    }
}
