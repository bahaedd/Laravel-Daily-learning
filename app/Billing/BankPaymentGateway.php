<?php


namespace App\Billing;

use Illuminate\Support\Str;

class BankPaymentGateway implements PaymentGatewayContract
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

        return [
            'amount' => $amount - $this->discount,
            'confirmation_code' => Str::random(20),
            'currency' => $this->currency,
            'discount' => $this->discount,
        ];
    }
}
