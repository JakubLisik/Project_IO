<?php
interface ReservationService
{
    public function make(int $userId, int $spotId, DateTime $start, DateTime $end): int;
}
