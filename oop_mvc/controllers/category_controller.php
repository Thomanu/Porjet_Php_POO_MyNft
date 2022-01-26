<?php 

$categories = readAllCategory();
function readAllCategory(){
    $category = new Category();
    return $category->readCategory(1, 10);

    }

    
   

