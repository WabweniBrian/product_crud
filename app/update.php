<?php

require_once __DIR__ . './../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ../index.php');
    exit;
}


$statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);


$title = $product['title'];
$description = $product['description'];
$price = $product['price'];


// Submit product
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    require_once __DIR__ . './../helpers/validate_product.php';

    if (empty($errors)) {
        $statement = $pdo->prepare("UPDATE products SET title = ?, image = ?, description = ?, price = ? WHERE id = ?");
        $statement->execute([$title, $imagePath, $description, $price, $id]);
        $statement->execute();
        header('Location: ../index.php');
    }
}

ob_start();
include_once __DIR__ . './../views/products/update.php';
$output = ob_get_clean();
include_once __DIR__ . './../views/layout/main.php';