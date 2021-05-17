<?php

header('Content-Type: application/json');
require("../vendor/autoload.php");

use CartApp\shopController;

$sc = new shopController();

if($_POST['action'] == 'add_to_cart') {
    $amount = (int) $_POST['amount'];
    $currency_id = (int) $_POST['currency_id'];
    $ip = $_POST['ip'];
    $id = (int) $_POST['id'];

    $added = $sc->addToCart($id, $amount, $currency_id, $ip);
    echo json_encode($added ? 'added' : 'failed to add'.' to cart');
    exit;
}