<?php  
session_start();

include 'gestionProduit.php';

$gestion = new GestionProduit;
$id = $_GET["id"];
$value = $gestion->getProduit($_GET["id"]);

?>

<h1><?=$value['Name'];?></h1>
<p> Prix:<?=  $value['price']; ?> dh</p>


<form action="ajouter.php" method="POST">
<p>
<label for=""> Quntite</label>
<input type="number" name="qnt" value="<?=$value["qnt"] ?>">
</p>
<p>
<input type="hidden" name="id" value="<?=$value["id"] ?>">
<button type="submit">ajouter au panier</button>
</p>
</form>
