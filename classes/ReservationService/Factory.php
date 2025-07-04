<?php
require_once __DIR__.'/BasicReservationService.php';
require_once __DIR__.'/LoggingReservationService.php';
require_once __DIR__.'/PaymentReservationService.php';

/** prosta fabryka budująca łańcuch dekoratorów */
class ReservationServiceFactory
{
    public static function buildService(): ReservationService
    {
        return new PaymentReservationService(
                   new LoggingReservationService(
                       new BasicReservationService()
                   ));
    }
}
