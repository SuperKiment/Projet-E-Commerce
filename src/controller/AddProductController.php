<?php

function addProductController($twig, $db)
{
    include_once '../src/model/ProductModel.php';

    if (isset($_POST['btnAddProduct'])) {
        $label = htmlspecialchars($_POST['productLabel']);
        $description = htmlspecialchars($_POST['productDescription']);
        $price = htmlspecialchars($_POST['productPrice']);
        $category = htmlspecialchars($_POST['productCategory']);

        saveProduct($db, $label, $description, $price, $category);
    }

    var_dump($_POST);

    echo $twig->render('form_product.html.twig', []);
}
