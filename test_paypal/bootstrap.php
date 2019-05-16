<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require __DIR__  . '/PayPal-PHP-SDK/autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AT4qWUDsBl-XwCvYJPJzPFV_NmV9WcFojk8AeSZTWJF49zsA7BUeNzU30S4BDIq7ITLhW6xtKTzs1gzx',
    'client_secret' => 'ECJl9otKKnWRlav2nLwKP3lDkwVDi0uol3bTa7o3PYfWhjLYwKpFieRzatM6-7vOgk6hKVzuigp1_EJD',
    'return_url' => 'https://104.248.145.123/test_paypal/payment-successful.html',
    'cancel_url' => 'https://104.248.145.123/test_paypal/payment-cancelled.html'
];

// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '?halalwayz',
    'name' => 'halalwayz'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
