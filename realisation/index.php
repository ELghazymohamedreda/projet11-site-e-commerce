<?php
include 'cartManager.php';

$cartManager = new CartManager();

if(!isset($_COOKIE['cartCookie']))
{
    $expire=time() + (86400 * 30);//however long you want
    $cookieId = uniqid();
    setcookie('cartCookie', $cookieId, $expire);
    $cartManager->addCartCookie($cookieId);
}

session_start();
$compteur = $cartManager->compteur();



?>

<!-- CSS only -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>prototype 2</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Acueile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Promotion</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Magasin</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>  
                    </ul>
                    <form action="panier.php"method="POST" class="d-flex">
                        <button   class="btn btn-outline-dark" type="submit">
                         <i class="bi-cart-fill me-1" ></i>
                           Panier
                           
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                        <?php 
                            
                        echo $compteur
                        ?>
                        </span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">LES PRODUIT</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <?php 


$data= $cartManager->afficher();

?>

        <section class="py-5">
       
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
        foreach($data as $value){

          ?>
                <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $value->getNom();?></h5>
                                    <!-- Product price-->
                                    <?= $value->getPrix();?> DH
                                </div>
                                <div class="text-center"><a href="detail de produit.php?id=<?= $value->getId();?>"class="btn btn-outline-dark mt-auto" href="#">Détail</a></div>
                            </div>
                            <!-- Product actions-->
                               
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                   </section>
                      
                           
    
    </body>
</html>