
<?php 
include 'gestionProduit.php';
$gestionProduit = new GestionProduit();
$data= $gestionProduit->afficher();

foreach($data as $value){

?>

<div>
<table border="1" width="20%">
<tr>

<td>
    <a href="products-details.php?id=<?= $value->getId();?>">
<?= $value->getNom();?></a> </td>
</tr>




</table>

</div>


<?php } ?>

<a href="panier.php">panier</a>
