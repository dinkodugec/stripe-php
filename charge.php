<?php
  require_once('vendor/autoload.php');

  \Stripe\Stripe::setApiKey('sk_test_51MVNDvDTS9oZp98BHbNKQ4oRLM3KOStbcU35zwMT1DVDvbb96fXPKYyiqs5Td3p5WVrbRsykFnFHGBMQuqO5leeX00S3VDbMsq');

   // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $first_name = $POST['first_name'];
 $last_name = $POST['last_name'];
 $email = $POST['email'];
 $token = $POST['stripeToken'];

/*  echo $token;   it response with  tok_1MWpSVDTS9oZp98BXoz5Rtc2 */

 // Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));

// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => 5000,
  "currency" => "usd",
  "description" => "PHP book",
  "customer" => $customer->id
));

/* print_r($charge); */

header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);