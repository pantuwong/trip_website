<?php

// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require __DIR__  . '/PayPal-PHP-SDK/autoload.php';

// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AT4qWUDsBl-XwCvYJPJzPFV_NmV9WcFojk8AeSZTWJF49zsA7BUeNzU30S4BDIq7ITLhW6xtKTzs1gzx',     // ClientID
        'ECJl9otKKnWRlav2nLwKP3lDkwVDi0uol3bTa7o3PYfWhjLYwKpFieRzatM6-7vOgk6hKVzuigp1_EJD'      // ClientSecret
    )
);

// 3. Lets try to create a Payment
// https://developer.paypal.com/docs/api/payments/#payment_create
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('THB');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://104.248.145.123/paypal_ok.html")
    ->setCancelUrl("https://104.248.145.123/paypal_cancle.html");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// 4. Make a Create Call and print the values
try {
    $payment->create($apiContext);
    echo $payment;

    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}