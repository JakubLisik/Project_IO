<?php
require_once __DIR__.'/ReservationServiceDecorator.php';
require_once __DIR__.'/../Payment/PaymentGateway.php';
require_once __DIR__.'/../Payment.php';

class PaymentReservationService extends ReservationServiceDecorator
{
    public function make(int $userId, int $spotId, DateTime $start, DateTime $end): int
    {
        /* --- tworzymy rezerwację (pending payment) ------------------- */
        $reservationId = parent::make($userId, $spotId, $start, $end);

        /* --- obliczamy kwotę i „płacimy” ------------------------------ */
        $amount = Reservation::calculateAmount($reservationId);
        $gw     = PaymentGateway::create('card');

        if ($gw->pay($amount)) {
            /* ✔ oznacz płatność jako opłaconą */
            Payment::updateStatusByReservation($reservationId, 'paid');
        }

        return $reservationId;
    }
}
