<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/cart.css">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/custom.js"></script> 

<?php
  require("../vendor/autoload.php");

  use CartApp\shopController;

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $sc = new shopController();
?>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="/page">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Cart</a>
    </div>
  </div>
</nav>
<?php
  $cartProducts = $sc->getCartProducts($_SERVER['REMOTE_ADDR']);
?>

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">E-COMMERCE CART</h1>
     </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Product</th>
                            <th scope="col">Currency</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-right">Price</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=0;
                      $price_total_eur = 0;
                      while($prod = mysqli_fetch_array($cartProducts)) {
                        $price_total_eur += (double)$prod['price_eur'];
                    ?>
                        <tr>
                            <td><img src="<?php echo $prod["img"]; ?>" height="50px" width="50px" /> </td>
                            <td><?php echo $prod["name"]; ?></td>
                            <td><?php echo $prod["currency"]; ?></td>
                            <td><input class="form-control" type="text" value="<?php echo $prod["amount"]; ?>" /></td>
                            <td class="text-right"><?php echo $prod["price"] . '' . $prod["symbol"]; ?></td>
                            <td class="text-right"><a class="btn btn-sm btn-danger" style="color: white;" onclick="removeFromCart(<?php echo $prod["row_id"]; ?>)"><i class="fa fa-trash"></i> </a> </td>
                        </tr>
                        <?php
                          $i++;
                          }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-right">Total: <?php echo $price_total_eur; ?>€</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <a class="btn btn-block btn-light">Continue Shopping</a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a  style="color: white;" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html> 