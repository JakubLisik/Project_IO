<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../classes/Payment/PaymentGateway.php';

final class PaymentGatewayTest extends TestCase
{
    public function testFactoryReturnsCorrectInstances(): void
    {
        $this->assertInstanceOf(CardPayment::class,   PaymentGateway::create('card'));
        $this->assertInstanceOf(PayPalPayment::class, PaymentGateway::create('paypal'));
        $this->assertInstanceOf(BlikPayment::class,   PaymentGateway::create('blik'));
    }

    public function testMockPaymentAlwaysSucceeds(): void
    {
        $gw = PaymentGateway::create('card');
        $this->assertTrue($gw->pay(1.0));
    }
}
