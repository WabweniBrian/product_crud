<?php

require_once __DIR__ . './../config/database.php';

$search = $_GET["search"] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY create_date DESC'); // prepare sql statement
    $statement->bindValue(':title', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC'); // prepare sql statement
}


$statement->execute(); // execute sql statement
$products = $statement->fetchAll(PDO::FETCH_ASSOC); // fetch all data from database

ob_start();
include_once __DIR__ . './../views/products/index.php';
$output = ob_get_clean();
include_once __DIR__ . './../views/layout/home.php';