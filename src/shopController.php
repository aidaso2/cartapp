<?php

namespace CartApp;

class shopController
{
    const SERVERNAME = 'db';
    const USERNAME = 'appadmin';
    const PASSWORD = 'appadmin';
    const DBNAME = 'cartdb';

    public function __construct()
    {

    }

    public function getProducts() {
        $conn = new \mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
        $sql = "SELECT * FROM product";
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }

    public function getCurrencies() {
        $conn = new \mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
        $sql = "SELECT * FROM currencies";
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }

    public function addToCart($id_product, $amount, $currency_id, $ip) {
        $conn = new \mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
        $sql = "SELECT * FROM cart where ip = '$ip' AND id_product = $id_product AND currency_id = $currency_id";
        $cart_prods = $conn->query($sql);
        if($cart_prods->num_rows > 0){     

            while($prod = mysqli_fetch_array($cart_prods)) {
                $sql = "UPDATE cart SET amount = " . $prod['amount'] . " + $amount where row_id = '".$prod['row_id']."'";
                $result = $conn->query($sql);
            }
        }
        else {
            $sql = "INSERT INTO cart (id_product, amount, currency_id, ip) VALUES ($id_product, $amount, $currency_id, '$ip');";
            $result = $conn->query($sql);
        }
        
        $conn->close();

        if($result) {
            return true;
        }

        return false;
    }

}
