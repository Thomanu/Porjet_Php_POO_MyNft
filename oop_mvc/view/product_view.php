<?php
$href = "../assets/css/product_page.css";
require_once "header.php";

require_once '../controllers/product_controller.php';
if (isset($_GET['id'])) {
  $product = readSingleProduct($_GET['id']);
}
// var_dump($product);

?>

<div class="body">
  <div class="product_img">
    <img src="../assets/img/<?php echo $product->image ?>.png" alt="">
  </div>
  <div class="product_info">
    <div class="seller_info">
    <?php echo $product->category_id ?>
    </div>
    <div class="product_title"><?php echo $product->name ?></div>
    
    <div class="product_price">Valeur estimée à <?php echo $product->price ?> ETH
  </div>
    <div class="product_descr"><?php echo $product->description ?></div>
    <form>
  <input type="button" class=btn value="Retour" onclick="history.go(-1)">
 </form>
  </div>
</div>

<?php
    require_once "footer.php";
	?>