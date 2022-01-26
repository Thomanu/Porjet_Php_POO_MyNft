<?php
// core.php contient des variables de pagination
// include_once 'models/core.php';

// inclure les fichiers de base de données et d'objets
include_once '../models/database.php';
include_once '../models/product_model.php';
include_once '../models/category_model.php';
// $filepath = realpath(dirname(__FILE__));
include_once __DIR__.'/../helpers/session.php';
Session::init();
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyNft</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/header.css" >
    
    <link href="<?php echo $href ?>" rel="stylesheet">
    
</head>

<?php 
    if (isset($_GET['action']) && $_GET['action'] =="logout") {
        Session::destroy();
    }
    ?>

<body>
    <!-- container -->
    <div class="container">


    <nav>
        <input id="nav-toggle" type="checkbox">
        <div class="logo"><a href="index.php"><img src="../assets/img/logo3.png" alt=""></a><span>My</span>Nft</div>
        <p></p>
        <ul class="links">
        <?php 
                            $id = Session::get('id');
                             $userlogin = Session::get('login');
                             if ($userlogin == true) {
                             ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="userlist.php">Liste</a></li>
            <li><a href="admin.php">Admin</a></li>
            <li><a href="profile.php?id=<?php echo $id; ?>">Profil</a></li>
            <li><a href="?action=logout">Déconnexion</a></li>
            <?php } else{ ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Se connecter</a></li>
            <li><a href="register.php">S'enregistrer</a></li>
            <?php } ?>
            

        </ul>
        <label for="nav-toggle" class="icon-burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </label>
    </nav>



