<?php

require_once "header.php";
require_once '../controllers/product_controller.php';

if (isset($_GET['object_id'])) {
    $product = deleteProduct($_GET['object_id']);
}
header("Location: index.php");
?>

<p>Supprimé</p>



<?php

require_once "footer.php";

?>