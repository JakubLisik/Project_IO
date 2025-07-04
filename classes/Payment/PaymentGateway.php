<?php
/* -- ręczne “autoloadowanie” bramek --- */
require_once __DIR__.'/CardPayment.php';
require_once __DIR__.'/PayPalPayment.php';
require_once __DIR__.'/BlikPayment.php';

/* === INTERFEJS ====================================================== */
interface PaymentGatewayInterface
{
    public function pay(float $amount): bool;
}

/* === FABRYKA ======================================================== */
abstract class PaymentGateway
{
    public static function create(string $type): PaymentGatewayInterface
    {
        return match (strtolower($type)) {
            'card'   => new CardPayment(),
            'paypal' => new PayPalPayment(),
            'blik'   => new BlikPayment(),
            default  => throw new InvalidArgumentException("Unknown gateway $type"),
        };
    }
}
