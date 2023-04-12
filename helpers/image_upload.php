<?php

$image =  $_FILES['image']['name'] ?? null;
$temp_name = $_FILES['image']['tmp_name'];
$imagePath = $product['image'];

if ($image) {

    if ($product['image']) {
        unlink('../assets/' . $product['image']);
        rmdir(dirname('../assets/' . $imagePath));
    }

    $imagePath = 'images/' . randomString(10) . '/' . $image;
    mkdir(dirname('../assets/' . $imagePath));
    move_uploaded_file($temp_name, '../assets/' . $imagePath);
}