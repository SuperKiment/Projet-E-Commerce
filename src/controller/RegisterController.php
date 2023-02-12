<?php

function registerController($twig, $db)
{
    include_once '../src/model/UserModel.php';
    $form = [];
    if (isset($_POST['submitRegister'])) {
        if (
            isset($_POST['firstname'])
            && isset($_POST['lastname'])
            && isset($_POST['email'])
            && isset($_POST['password'])
            && isset($_POST['passwordVerif'])

            && $_POST['firstname'] != ""
            && $_POST['lastname'] != ""
            && $_POST['email'] != ""
            && $_POST['password'] != ""
        ) {
            if (strlen($_POST['password']) >= 3) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordConfirm = $_POST['passwordVerif'];
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                if (!getOneUserCredentials($db, $email)) {
                    if ($password === $passwordConfirm) {
                        saveUser(
                            $db,
                            $email,
                            password_hash($password, PASSWORD_DEFAULT),
                            $lastname,
                            $firstname,
                            1
                        );
                        $form = [
                            'state' => 'success',
                            'message' => "Vous êtes maintenant inscrit au site"
                        ];
                    } else {
                        $form = [
                            'state' => 'danger',
                            'message' => "Les deux mots de passe ne correspondent pas !"
                        ];
                    }
                } else {
                    $form = [
                        'state' => 'danger',
                        'message' => "Un compte avec cette adresse mail existe déjà !"
                    ];
                }
            } else {
                $form = [
                    'state' => 'danger',
                    'message' => "Le mot de passe doit faire au moins 3 caractères !"
                ];
            }
        } else {
            $form = [
                'state' => 'danger',
                'message' => "Veuillez remplir tous les champs !"
            ];
        }
    }
    echo $twig->render('register.html.twig', [
        'form' => $form
    ]);
}
