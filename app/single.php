<?php


require_once __DIR__ . './../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ../index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

ob_start();
include_once __DIR__ . './../views/products/single.php';
$output = ob_get_clean();
include_once __DIR__ . './../views/layout/main.php';