<?php
$href = "../assets/css/singleproduct.css";
require_once "header.php";
require_once '../controllers/product_controller.php';

if (isset($_GET['singleId'])) {
    $product = readSingleProduct($_GET['singleId']);
}
?>

<p><?=$product->name;?></p>

<div class="body">
  <div class="product_img">
    <img src="../assets/img/<?php echo $product->image ?>.png" alt="">
  </div>
  <div class="product_info">
    <div class="seller_info">
    <?php echo $product->category_id ?>
    </div>
    <div class="product_title"><p><?=$product->name;?></p></div>
    
    <div class="product_price">Valeur estimée à <p><?=$product->price;?></p> ETH
  </div>
    <div class="product_descr"><p><?=$product->description;?></p></div>
    <form>
  <input type="button" class="btn" value="Retour" onclick="history.go(-1)">
 </form>
  </div>
</div>



<?php

require_once "footer.php";

?>