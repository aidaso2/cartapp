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
    echo json_encode($added ? 'Added' : 'Failed to add'.' to cart');
    exit;
}

if($_POST['action'] == 'remove_from_cart') {
    $id = (int) $_POST['id'];

    $added = $sc->removeFromCart($id);
    echo json_encode($added ? 'Removed' : 'Failed to remove'.' from cart');
    exit;
}

echo 'false';
exit;