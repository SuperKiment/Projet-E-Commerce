<?php

function getOneProduct($db, $idProduct)
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory FROM product WHERE id=:id");
    $query->execute([
        'id' => $idProduct
    ]);

    $product = $query->fetch();

    return $product;
}

function getAllProducts($db)
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory FROM product");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
}

function saveProduct($db, $label, $description, $price, $category) {
    $query = $db -> prepare("INSERT INTO product (label, `description`, price, idCategory) VALUES (:label, :descr, :price, :idCategory)");
    return $query -> execute([
        'label' => $label,
        'descr' => $description,
        'price' => $price,
        'idCategory' => $category
    ]);
}