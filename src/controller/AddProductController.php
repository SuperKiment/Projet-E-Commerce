<?php

function addProductController($twig, $db)
{
    include_once '../src/model/ProductModel.php';
    include_once '../src/model/CategoryModel.php';

    $form = [];

    if (isset($_POST['btnPostProduct'])) {
        $label = htmlspecialchars($_POST['productLabel']);
        $description = htmlspecialchars($_POST['productDescription']);
        $price = htmlspecialchars($_POST['productPrice']);

        if (empty($price)) {
            $price = 0.00;
        }

        $category = htmlspecialchars($_POST['productCategory']);

        if (!empty($label) && !empty($description) && !empty($category)) {
            $form = [
                'state' => 'success',
                'message' => 'Votre produit a bien été ajouté !'
            ];

            saveProduct($db, $label, $description, $price, $category);
        } else {

            $form = [
                'state' => 'danger',
                'message' => 'Votre produit n\'a pas été ajouté car les champs obligatoires
        n\'ont pas été remplis !'
            ];
        }
    }

    echo $twig->render('addProduct.html.twig', [
        'form' => $form,
        'categories' => getAllCategories($db),
        'page' => '?page=addProduct'
    ]);
}
