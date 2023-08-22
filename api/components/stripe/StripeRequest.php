<?php

namespace api\components\stripe;

use api\components\HttpException;
use common\models\User;
use Yii;

class StripeRequest
{
    private $stripe;
    public $customer;

    public function __construct()
    {
        \Stripe\Stripe::setApiKey(Yii::$app->params['STRIPE_SK']);
        $this->stripe = new \Stripe\StripeClient(Yii::$app->params['STRIPE_SK']);
    }

    public function createCustomer(User $user)
    {
        $this->customer = \Stripe\Customer::create([
            'email' => $user['email'],
            'name' => $user['name'],
        ]);
    }

    public function sendACHRequest($cus_id, $amount)
    {
        try {
            // retrieve JSON from POST body
//            $jsonStr = file_get_contents('php://input');
//            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                [
                    'amount' => $amount,
                    'currency' => 'usd',
                    'setup_future_usage' => 'off_session',
                    'customer' => $cus_id,
                    'payment_method_types' => ['us_bank_account'],
//            'payment_method_options' => [
//                'us_bank_account' => [
//                    'financial_connections' => ['permissions' => ['payment_method', 'balances']],
//                ],
//            ],
                ]
            ]);

            return  [
                'client_secret' => $paymentIntent->client_secret,
            ];

        } catch (Error $e) {
            throw new HttpException(500, $e->getMessage());
        }
    }
}
