<?php
require_once '../models/product_model.php';


if (isset($_POST['action'])) {
    $datas = $_POST;
    createProduct($_POST);
}

if (isset($_POST['update'])) {
    $datas = $_POST;
    updateProduct($_POST, $_GET['update_id']);
}

function readAllProduct()
{
    $product = new Product();
    return $product->readAll(0, 20);
}

function readSingleProduct($id)
{
    $product = new Product();
    $product->setId($id);
    return $product->readOneProduct();
}

function createProduct($param)
{
  
    // valeurs affichées
    $product = new Product();
    $product->setName(htmlspecialchars($param['name']));
    $product->setPrice(htmlspecialchars($param['price']));
    $product->setDescription(htmlspecialchars($param['description']));
    $product->setCategoryId(htmlspecialchars($param['category_id']));
    $product->setImage(htmlspecialchars($param['image']));
    if ($product->create()) {
        $sucess = true;
        if ($sucess) {
            $product->setName('');
            $product->setPrice('');
            $product->setDescription('');
            $product->setCategoryId(0);
            $product->setImage('');

        }
    }
    else{
        echo'here';
    }
}

function updateProduct($param, $id)
{
    // valeurs affichées
    $product = new Product();
    $product->setId($id);
    $product->setName(htmlspecialchars($param['name']));
    $product->setPrice(htmlspecialchars($param['price']));
    $product->setDescription(htmlspecialchars($param['description']));
    $product->setCategoryId(htmlspecialchars($param['category_id']));
    $product->setImage(htmlspecialchars($param['image']));
   
    if ($product->update()) {
        $sucess = true;
        if ($sucess) {
            $product->setName('');
            $product->setPrice('');
            $product->setDescription('');
            $product->setCategoryId(0);
            $product->setImage('');

        }
    }
}

function deleteProduct($id)
{
    // préparer l'objet produit
    $product = new Product();

    // définir l'identifiant du produit à supprimer
    $product->setId($id);
    $product->delete();
}



// obtenir le terme de recherche
// $search_term = isset($_GET['s']) ? $_GET['s'] : '';

// $page_title = "Vous avez recherchés \"{$search_term}\"";

// recherche de produits
// $stmt = $product->search($search_term, $from_record_num, $records_per_page);

// spécifier la page où la pagination est utilisée
// $page_url="search.php?s={$search_term}&";

// compte le nombre total de lignes - utilisé pour la pagination
// $total_rows=$product->countAll_BySearch($search_term);
