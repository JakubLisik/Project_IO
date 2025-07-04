<?php
require_once __DIR__.'/PaymentGateway.php';

class BlikPayment implements PaymentGatewayInterface
{
    public function pay(float $amount): bool
    {
        // symulacja BLIK
        return true;
    }
}
