<?php
session_start();
include 'gestionProduit.php';
$gestion = new GestionProduit ;


$gestion->delete($_GET["id"]);
header('location:cart.php');