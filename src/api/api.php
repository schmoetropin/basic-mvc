<?php
declare(strict_types=1);

require_once(__DIR__.DIRECTORY_SEPARATOR.'includes.php');

use \App\Prod\{CreateDeleteProduct, DisplayProduct};
use \Exception;

$crDlProd = new CreateDeleteProduct();
$dispProd = new DisplayProduct();

try {
    if (isset($_POST['createProduct'])) {
        // Create product type object
        $typeObj = $crDlProd->createObj->type($_POST);
        
        // Create product
        $crDlProd->createProduct($_POST, $typeObj);
    }

    if (isset($_GET['displayProducts'])) {
        // Displays all Products
        echo(json_encode($dispProd->display()));
        exit;
    }

    if (isset($_POST['delProducts'])) {
        // Delet selected products
        $crDlProd->deleteProduct(json_decode($_POST['delProducts']));
    }
} catch (Exception $e) {
    echo $e->getMessage();
}