<?php

namespace App\Http\Controllers\api\v1;


use Illuminate\Http\Request;

use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController
{
    public function handlePayment()
    {
        $product = [];
        $product['items'] = [
            [
                'name' => 'Architex',
                'price' => 112,
                'desc'  => 'Abonnement Pour Architex',
                'qty' => 1
            ]
        ];

        $product['invoice_id'] = 1;
        $product['invoice_description'] = "Abonnement Pour Architex";
        $product['return_url'] = route('success.payment');
        $product['cancel_url'] = route('cancel.payment');
        $product['total'] = 112;

        $paypalModule = new ExpressCheckout;

        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);

        return $res['paypal_link'];
    }

    public function paymentCancel()
    {
        dd('Your payment has been declend. The payment cancelation page goes here!');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('Payment was successfull!');
        }

        dd('Payment was successfull!');
    }
}
