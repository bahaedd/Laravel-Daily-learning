<?php


namespace App\Billing;

use Illuminate\Support\Str;

class CreditPaymentGateway implements PaymentGatewayContract
{

    private $currency;
    private $discount;


    public function __construct($currency)
    {
        $this->currency = $currency;
        $this->discount = 0;
    }

    public function setDiscount($amount)
    {
        $this->discount = $amount;
    }

    public function charge($amount)
    {
        //charge bank

        $fees = $amount * 0.03;

        return [
            'amount' => ($amount - $this->discount) + $fees,
            'confirmation_code' => Str::random(20),
            'currency' => $this->currency,
            'discount' => $this->discount,
            'fees' => $fees,
        ];
    }
}
