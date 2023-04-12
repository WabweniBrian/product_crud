<?php
require_once __DIR__ . './../config/database.php';

$errors = [];

$title = $description = $price = "";
$product['image'] = '';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    require_once __DIR__ . './../helpers/validate_product.php';


    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date) VALUES (?,?,?,?,?)");
        $statement->execute([$title, $imagePath, $description, $price, date('Y-m-d H:i:s')]);
        header('Location: ../index.php');
    }
}

ob_start();
include_once __DIR__ . './../views/products/create.php';
$output = ob_get_clean();
include_once __DIR__ . './../views/layout/main.php';