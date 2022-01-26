<?php

// inclure les fichiers de base de données et d'objets
include_once '../models/database.php';
include_once '../models/product_model.php';
include_once '../models/category_model.php';
  
// obtenir une connexion à la base de données
// $database = new Database();
// $db = $database->getConnection();
  
// passer la connexion aux objets
$product = new Product();
$category = new Category();

$product_list = $product->readAll(0, 20);
// var_dump($product_list);