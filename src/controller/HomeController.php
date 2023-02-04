<?php

function homeController($twig, $db) {

    include_once("../src/model/ProductModel.php");

    echo $twig -> render('home.html.twig', [
        'products' => getAllProducts($db)
    ]);
}