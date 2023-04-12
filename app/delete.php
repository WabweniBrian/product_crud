<?php

require_once __DIR__ . './../config/database.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    header('Location: ../index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

unlink('../assets/' . $product['image']);
rmdir(dirname('../assets/' . $product['image']));

$statement = $pdo->prepare('DELETE FROM products WHERE id = ?');
$statement->execute([$id]);

header('Location: ../index.php');