<?php
require_once __DIR__.'/ReservationServiceDecorator.php';

class LoggingReservationService extends ReservationServiceDecorator
{
    public function make(int $userId, int $spotId, DateTime $start, DateTime $end): int
    {

        $dir = realpath(__DIR__.'/../../') . '/logs';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }


        file_put_contents(
            $dir.'/reservations.log',
            sprintf("[%s] user:%d spot:%d\n", date('c'), $userId, $spotId),
            FILE_APPEND
        );

        return parent::make($userId, $spotId, $start, $end);
    }
}
