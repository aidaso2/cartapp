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

    public function getCartProducts($ip) {
        $conn = new \mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
        $sql = "SELECT c.row_id row_id, p.id id, p.name name, p.description pdesc, p.price_eur price_eur, (p.price_eur * cur.exchange_rate_eur) price, p.image_url img, c.amount amount, cur.code currency, cur.symbol symbol FROM cart c ";
        $sql .= "LEFT JOIN product p ON p.id = c.id_product ";
        $sql .= "LEFT JOIN currencies cur ON cur.id = c.currency_id ";
        $sql .= "WHERE c.ip = '$ip'";
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

    public function removeFromCart($id) {
        $conn = new \mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
        $sql = "DELETE FROM cart WHERE row_id = $id";
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }

}
