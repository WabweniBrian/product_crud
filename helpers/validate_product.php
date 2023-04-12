<?php

require_once __DIR__ . './randomString.php';

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$imagePath = null;

if (!$title) {
    array_push($errors, 'Product title is required');
}
if (!$price) {
    array_push($errors, 'Product price is required');
}

if (!is_dir(dirname('../assets/images'))) {
    mkdir(dirname('../assets/images'));
}


if (empty($errors)) {
    require_once __DIR__ . './image_upload.php';
}