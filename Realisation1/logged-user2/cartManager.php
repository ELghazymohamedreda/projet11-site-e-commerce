<?php
include "product.php";
include "cart.php";
include "cartLine.php";


class CartManager {

    public $name ;

    private $Connection = Null;

    private function getConnection(){
      
            $this->Connection = mysqli_connect('localhost', 'superuser', 'p@ssword1', 'productiondb');
           
         
       
        
        return $this->Connection;
    }


  public function initCode() {
    if(!isset($_COOKIE['cartCookie']))
    {
        $expire=time() + (86400 * 30);//however long you want
        $cookieId = uniqid();
        setcookie('cartCookie', $cookieId, $expire);
        $_SESSION["product"] = array();
        $_SESSION["quantity"] = 0;
        $_SESSION["product"] = array();
        $this->addCartCookie($cookieId);
    }

 }
    
    // Add product to cart
    public function addProduct($cart, $product, $quantity){
        $cartId = $cart->getId();
        $productId = $product->getId();
        $sql = "INSERT INTO cartline(Id_product,Id_cart, Product_cart_quantity) VALUES('$productId', '$cartId', '$quantity')";
        $result = mysqli_query($this->getConnection(), $sql);
        return $result;
        if($result){
            
            $this->getConnection()->close();
        }

    }

    public function getCartLine($id){
        $sql = "SELECT * FROM cartline INNER JOIN products on products.id=cartline.Id_product WHERE Id_Cart='$id'";
        $query = mysqli_query($this->getConnection(), $sql);
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        
       
        $cartLineList = array();
        foreach($result as $value){
            $product = new Product();
            $cartLine = new CartLine();
            $cartLine->setIdCartLine($value['idCartLine']);
            $cartLine->setIdCart($value['idCart']);
            $cartLine->setIdProduct($value['idProduct']);
            $cartLine->setProductCartQuantity($value['productCartQuantity']);
            $product->setId($value['id_produit']);
            $product->setName($value['nom_produit']);
            $product->setPrice($value['prix']);
            $product->setDescription($value['description']);
            $product->setDateOfExpiration($value["date_d'expiration"]);
            $product->setQuantity($value['quantite_stock']);
            $product->setCategory($value['categorie_produit']);
            $cartLine->setProduct($product);
            array_push($cartLineList, $cartLine);
        }
        return $cartLineList;
    }
    
    // pour ajouter session
    public function set($cart, $product, $quantity){
        $_SESSION["cart"] = $cart;
        array_push($_SESSION["product"], $product);
        if(!isset($_SESSION["quantity"])){
            $_SESSION["quantity"] = 0;
        }
        $_SESSION["quantity"] += $quantity; 

    }

      // afficher session

      public function getCartProducts($cartId){

        $sql = "SELECT * FROM cart_line INNER JOIN produit on cart_line.idCartLine = produit.id_produit WHERE idCart = $cartId";
        $query = mysqli_query($this->getConnection(), $sql);
        $result =  mysqli_fetch_all($query, MYSQLI_ASSOC);
        return $result;
        $product = new Product();
        $productsList = array();
        foreach ($result as $value_Data) {
            $product->setId($value_Data['id_produit']);
            $product->setName($value_Data['nom_produit']);
            $product->setPrice($value_Data['prix']);
            $product->setDescription($value_Data['description']);
            $product->setDateOfExpiration($value_Data["date_d'expiration"]);
            $product->setQuantity($value_Data['quantite_stock']);
            $product->setCategory($value_Data['categorie_produit']);
            array_push($productsList, $product);
        }
          return $productsList;
        // if(isset($_SESSION["product"])){
        //     return $_SESSION["product"];
        // }

      }

      public function getCartQuantity(){
          if(isset($_SESSION["quantity"])){
              return $_SESSION["quantity"];
          }
      }

          //supprimer session
    public function delete($id){
        if(isset($_SESSION["paniers"]["products"][$id])){
            unset($_SESSION["paniers"]["products"][$id]);
        }
    }

    
    // pour afficher  session 
    public function getProductCart($idCartLine){
        $sql = "SELECT * FROM cart_line INNER JOIN produit on cart_line.idProduct = produit.id_produit WHERE idCartLine = $idCartLine";
        $query = mysqli_query($this->getConnection(),$sql);
        $result = mysqli_fetch_assoc($query);

        $cartLine = new CartLine();
        $cartLine->setIdCartLine($result['idCartLine']);
        $cartLine->setIdCart($result['idCart']);
        $cartLine->setIdProduct($result['idProduct']);
        $cartLine->setProductCartQuantity($result['productCartQuantity']);
        
        $product = new Product();
        $product->setId($result['id_produit']);
        $product->setName($result['nom_produit']);
        $product->setPrice($result['prix']);
        $product->setDescription($result['description']);
        $product->setDateOfExpiration($result["date_d'expiration"]);
        $product->setQuantity($result['quantite_stock']);
        $product->setCategory($result['categorie_produit']);

        $cartLine->setProduct($product);

        return $cartLine;
    }

    // Edit  cart line
    public function editCartLine($idCartLine, $quantity){
        $sql = "UPDATE cart_line SET productCartQuantity = '$quantity' WHERE idCartLine=$idCartLine";
        mysqli_query($this->getConnection(), $sql);
        
    }

  

// afficher  les produits : page index
    public function afficher(){
        $SelctRow = 'SELECT *  FROM products';
        $query = mysqli_query($this->getConnection() ,$SelctRow);
        $produits_data = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $TableData = array();
        foreach ($produits_data as $value_Data) {
            $product = new Product();
            $product->setId($value_Data['id']);
            $product->setName($value_Data['Name']);
            $product->setPrice($value_Data['price']);
            $product->setDescription($value_Data['Description_product']);
            // $product->setQuantity($value_Data['quantite_stock']);
            $product->setCategory($value_Data['supply']);
            array_push($TableData, $product);
        }
          return $TableData;
 
        }
  
 
        
// afficher  les produits : page panier

        public function afficherProduit($id){
            $SelctRow = "SELECT * FROM products WHERE id =$id";
            $query = mysqli_query($this->getConnection() ,$SelctRow);
            $produits_data = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $product = new Product();

            
            foreach ($produits_data as $value_Data) {
                $product->setId($value_Data['id']);
                $product->setName($value_Data['Name']);
                $product->setPrice($value_Data['price']);
                $product->setDescription($value_Data['Description_product']);
                // $product->setQuantity($value_Data['quantite_stock']);
                $product->setCategory($value_Data['supply']);
               
            }
              return $product;
        }
      
 

        function compteur(){ 
        if(isset($_SESSION["paniers"]) != null){
                $compteur = count($_SESSION["paniers"]["products"]) ;
            
            }else {
                $compteur = 0;
            
            }
            return $compteur;
        }

        function addCartCookie($cookie){
            $sql = "INSERT INTO cart(Visitor_Reference) VALUES('$cookie')";
            mysqli_query($this->getConnection(), $sql);
        }

        function getCart($userRefe){
            $sql = "SELECT * from cart WHERE Visitor_Reference = '$userRefe'";
            $query = mysqli_query($this->getConnection(), $sql);
            $result = mysqli_fetch_assoc($query);

            
            $cart = new Cart();
            $cart->setId($result["id"]);
            $cart->setUserReference($result["Visitor_Reference"]);

            $cartLine = $this->getCartLine($cart->getId());
            $cart->setCartLineList($cartLine);
            return $cart;
        }
    }
