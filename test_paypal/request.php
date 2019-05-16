<?php

ini_set('display_errors', 1);

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

require 'bootstrap.php';

if (empty($_POST['item_number'])) {
    throw new Exception('This script should not be called directly, expected post data');
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('THB')
    ->setQuantity(1)
    ->setSku("1") // Similar to `item_number` in Classic API
    ->setPrice(7.5);

$item2 = new Item();
$item2->setName('Granola bars')
    ->setCurrency('THB')
    ->setQuantity(5)
    ->setSku("2") // Similar to `item_number` in Classic API
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.5);


$amount = new Amount();
$amount->setCurrency("THB")
    ->setTotal(20)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription('Some description about the payment being made')
    ->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

$request = clone $payment;

try {
    $payment->create($apiContext);
} catch (Exception $e) {
    throw new Exception('Unable to create link for payment');
}

header('location:' . $payment->getApprovalLink());
exit(1);
