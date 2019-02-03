<?php
require_once("../includes/braintree_init.php");

$amount = $_POST["amount"];
$nonce = $_POST["payment_method_nonce"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$settlement = False;

if ( isset($_POST["settlement"]) && $_POST["settlement"] == '1') {

    $settlement = True;
}


$result = Braintree\Transaction::sale([
    'amount' => $amount,
    'paymentMethodNonce' => $nonce,
    'customer' => [
      'firstName' => $firstName,
      'lastName' => $lastName,
    ],
    'options' => [
        'submitForSettlement' => $settlement,
        'storeInVaultOnSuccess' => true,
    ]
]);

if ($result->success || !is_null($result->transaction)) {
    $transaction = $result->transaction;
    header("Location: transaction.php?id=" . $transaction->id);
} else {
    $errorString = "";

    foreach($result->errors->deepAll() as $error) {
        $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
    }

    $_SESSION["errors"] = $errorString;
    header("Location: index.php");
}
