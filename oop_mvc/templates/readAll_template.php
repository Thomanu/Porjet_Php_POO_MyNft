<?php

function readAll_template($products, $total_rows, $categories)
{
    
    // echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
    $search_value = isset($search_term) ? "value='{$search_term}'" : "";
    echo "<input type='text' class='form-control' placeholder='Rentrez le nom du produit...' name='s' id='srch-term' required {$search_value} />";
    echo "<div class='input-group-btn'>";
    echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
    echo "</div>";
    echo "</div>";
    echo "</form>";

// créer un bouton de produit
    echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn pull-right'>";
    echo "<span class='glyphicon glyphicon-plus'></span> Créer produit";
    echo "</a>";
    echo "</div>";

// afficher les produits s'il y en a
    if ($total_rows > 0) {

        echo "<table class='table table-responsive table-bordered'>";
        echo "<tr>";
        echo "<th>Produits</th>";
        echo "<th>Prix</th>";
        echo "<th>Description</th>";
        // echo "<th>Categorie</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        foreach ($products as $product) {

            echo "<tr>";
            echo "<td>{$product->name}</td>";
            echo "<td>{$product->price}</td>";
            echo "<td>{$product->description}</td>";
            // echo "<td>  {$product->category_id->name} </td>";
                // {$categories[$product->category_id - 1]->name}
              
           

            echo "<td>";

            // bouton de lecture du produit
            echo "<a href='../view/singleProduct.php?singleId={$product->id}' class='btn left-margin'>";
            echo "<span class='glyphicon glyphicon-list'></span> Lire";
            echo "</a>";

            // bouton de modification du produit
            echo "<a href='../view/update_product.php?update_id={$product->id}' class='btn left-margin'>";
            echo "<span class='glyphicon glyphicon-edit'></span> Editer";
            echo "</a>";

            // bouton de suppression du produit
            echo "<a href='../view/delete_product.php?object_id={$product->id}' class='btn delete-object'>";
            echo "<span class='glyphicon glyphicon-remove'></span> Supprimer";
            echo "</a>";

            echo "</td>";

            echo "</tr>";}

    }

    echo "</table>";

// boutons de pagination
    // include_once 'paging.php'; PAS OUBLIER
}

// dire à l'utilisateur qu'il n'y a pas de produits
// else{
// echo "<div class='alert alert-danger'>No products found.</div>";
// }
// }
