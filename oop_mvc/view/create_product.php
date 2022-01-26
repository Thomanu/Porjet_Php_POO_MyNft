<?php
$href = "../assets/css/updateProduct.css";
require_once "header.php";

require_once '../controllers/category_controller.php';
require_once '../controllers/product_controller.php';


?>

<!-- Formulaire HTML pour la création d'un produit -->

<form action= "#" method="POST">

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Nom</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Prix</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>

        <tr>
            <td>Categorie</td>
            <td>
 <select class='form-control' name='category_id'>;
     <option>Choisir catégorie...</option>
            <?php

// lire les catégories de produits depuis la base de données
// $stmt = $category->read();

// les mettre dans une liste déroulante de sélection

foreach ($categories as $category) {

    ?>   <option value="<?=$category->id?>"><?=$category->name?></option> <?php
}
?>
 </select>

            </td>

        </tr>

        <tr>
            <td>Image</td>
            <td><input type='text' name='image' class='form-control'  /></td>

           
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" name="action" class="btn btn-primary">Créer</button>
            </td>
        </tr>

    </table>
</form>

<?php
    require_once "footer.php";
	?>

