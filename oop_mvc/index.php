
<?php

$href = "assets/css/show.css";
include_once "view/header.php";

require_once 'controllers/home_controller.php';

?>


<!-- <div class="container text-center">
<h1>Bienvenue sur MyNft</h1>
</div> -->

<div class="shell">
  <div class="container">
    <div class="row"> 
      <?php 
      foreach($product_list as $product ) {
      ?>
      <div class="col-md-3">
      
        <div class="nft_gp_product">
          <div class="nft_img_product">
            <img src="../assets/img/<?php echo $product->image ?>.png" alt="Product" class="img-responsive" />
             <a href="product_view.php?id=<?php echo $product->id ?>">Voir le NFT</a>
          </div>
         
          <div class="nft_gp_text">
            <div class="category">
              <span><?php echo $product->category_id ?></span>
            </div>
            <div class="title-product">
              <h3><?php echo $product->name ?></h3>
            </div>
            <div class="description-prod">
              <p><?php echo $product->description ?></p>
            </div>
            <div class="card-footer">
              <div class="nft_card_left"><span class="price"><?php echo $product->price ?> Eth</span></div>
              <div class="nft_card_right"><a href="#" class="buy-btn"><i class="nft_shopping_basket"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      <?php  
      } 
      ?>
      

      <?php
    require_once "view/footer.php";
	?>
