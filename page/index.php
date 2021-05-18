<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/index.css">
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
      <a class="nav-item nav-link" href="/page/cart.php">Cart</a>
    </div>
  </div>
</nav>
<?php
  // $conn = new mysqli('db', 'appadmin', 'appadmin', 'cartdb');
  // $sql = "SELECT * FROM product";
  // $result = $conn->query($sql);
  // $conn->close();
  $products = $sc->getProducts();
?>
<!--For Page-->
<div class="page">
    <!--For Row containing all card-->
    <div class="row">
    <?php
      $i=0;
      while($prod = mysqli_fetch_array($products)) {
    ?>
        <!--Card-->
        <div class="col-sm">
            <div class="card card-cascade card-ecommerce wider shadow mb-5 ">
                <!--Card image-->
                <div class="view view-cascade overlay text-center"> <img class="card-img-top" src="<?php echo $prod["image_url"]; ?>" alt=""> <a>
                        <div class="mask rgba-white-slight"></div>
                    </a> </div>
                <!--Card Body-->
                <div class="card-body card-body-cascade text-center">
                    <!--Card Title-->
                    <h4 class="card-title"><strong><a href=""><?php echo $prod["name"]; ?></a></strong></h4> <!-- Card Description-->
                    <p class="card-text"><?php echo $prod["description"]; ?></p>
                    <p class="price"><?php echo $prod["price_eur"]; ?>€</p> <!-- Card Rating-->
                    <ul class="row rating">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                    <!--Amount input-->
                      <input type="number" id="<?php echo $prod["id"]; ?>-amount" class="form-control" value="1" />
                    <!--Currency select-->
                    <select name="currencies" id="<?php echo $prod["id"]; ?>-currencies">
                    <?php
                      $currencies = $sc->getCurrencies();
                      $j=0;
                      while($curr = mysqli_fetch_array($currencies)) {
                    ?>
                      <option value="<?php echo $curr["id"]; ?>"><?php echo $curr["code"]; ?></option>
                      <?php
                        $j++;
                        }
                      ?>
                    </select>
                    <!--Card footer-->
                    <div class="card-footer">
                    <!--Add to cart button-->
                      <p><a href="#"  type="button" class="btn btn-primary btn-lg addToCartBtn" data-toggle="button" autocomplete="off"
                       onclick="addToCart('<?php echo $_SERVER['REMOTE_ADDR']; ?>', <?php echo $prod["id"]; ?>)"
                       >ADD TO CART</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
          $i++;
          }
        ?>
      
    </div>
</div>

</body>
</html> 