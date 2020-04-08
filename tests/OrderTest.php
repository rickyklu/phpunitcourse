<?php

use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase {
    // paymentgateway method doesn't exist

    public function tearDown(): void {
        Mockery::close();
    }

    public function testOrderProcessed() {
        $gateway = $this->getMockBuilder('PaymentGateway')
            ->setMethods(['charge'])->getMock();

        $gateway->expects($this->once())
            ->method('charge')
            ->with($this->equalTo(200))
            ->willReturn(true);
        $order = new Order($gateway);
        $order->amount = 200;
        $this->assertTrue($order->process());
    }

    public function testOrderProcessedMocker() {
        // using mockery instead of getMockBuilder
        // declare class you want to mock, pass in method name you want to mock
        $gateway = Mockery::mock('PaymentGateway');
        $gateway->shouldReceive('charge')->once()->with(200)->andReturn(true);
        $order = new Order($gateway);
        $order->amount = 200;
        $this->assertTrue($order->process());
    }
}