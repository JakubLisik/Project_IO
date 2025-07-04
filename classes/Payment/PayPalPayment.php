<?php
require_once __DIR__.'/PaymentGateway.php';

class PayPalPayment implements PaymentGatewayInterface
{
    public function pay(float $amount): bool
    {
        // symulacja PayPal
        return true;
    }
}
