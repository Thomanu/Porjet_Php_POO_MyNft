<?php
$href = "../assets/css/readAll_template.css";

require_once "header.php";

require_once "../controllers/product_controller.php";

require_once "../controllers/category_controller.php";

require_once "../templates/readAll_template.php";

readAll_template(readAllProduct(), 20, readAllCategory());

require_once "footer.php";
