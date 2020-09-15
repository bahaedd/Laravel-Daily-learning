<?php

namespace App\Orders;

use App\Billing\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGatway;

    public function __construct(PaymentGatewayContract $paymentGatway)
    {
        $this->paymentGatway = $paymentGatway;
    }

    public function all()
    {
        $this->paymentGatway->setDiscount(500);

        return [
            'name' => 'Bahaeddine',
            'address' => '123 larocco Street'
        ];
    }
}
