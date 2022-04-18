<?php
session_start();
include 'gestionProduit.php';
$gestionProduit = new GestionProduit();
$id=$_POST['id'];


$data = $gestionProduit->afficherProduit($id);
foreach($data as $value);

$valeurs = array(
    "Name" => $value->getNom(),
    'price' => $value->getPrix(),
    'id' => $value->getId(),
);
$gestionProduit->set( $_POST["id"], $valeurs);


header("location: cart.php");


