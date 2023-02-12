<?php

function saveUser($db, $email, $password, $nom, $prenom, $idrole)
{
    $query = $db->prepare("INSERT INTO users (email, nom, prenom, idRole, `password`) 
                            VALUES (:email, :nom, :prenom, :idRole, :password)");
    return $query->execute([
        'email' => $email,
        'nom' => $nom,
        'prenom' => $prenom,
        'idRole' => $idrole,
        'password' => $password
    ]);
}


function getOneUserCredentials($db, $email)
{
    $query = $db->prepare("SELECT id, email, `password`, idRole FROM users WHERE email=:email");
    $query->execute([
        'email' => $email
    ]);

    $product = $query->fetch();

    return $product;
}
