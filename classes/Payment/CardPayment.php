<?php
require_once __DIR__.'/PaymentGateway.php';

class CardPayment implements PaymentGatewayInterface
{
    public function pay(float $amount): bool
    {
        // tu normalnie wywołanie Stripe / Przelewy24
        return true;
    }
}
