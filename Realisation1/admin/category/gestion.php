<?php
 include 'produit-categorie.php';
class Gestion{

    private $Connection = Null;

    private function getConnection(){
      
            // $this->Connection = mysqli_connect('localhost', 'test', 'test123', 'e-commerce');
            $this->Connection = mysqli_connect('localhost', 'superuser', 'p@ssword1', 'productiondb');        //    
         
       
        
        return $this->Connection;
        
    }
    
 

    
    public function afficher(){
        $SelctRow = 'SELECT * FROM products
         INNER JOIN category ON products.supply = category.id_category';
        $query = mysqli_query($this->getConnection() ,$SelctRow);
        $produits_data = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $TableData = array();
        foreach ( $produits_data as $value_Data) {
                  
                   
                   $produit = new Produit_Categorie();
                   $produit->setId_Produit($value_Data['id']);   
                   $produit->setPrix($value_Data['price']);   
                   $produit->setNom_Produit($value_Data['Name']);   
                   $produit->setDescription($value_Data['Description_product']);   
                //    $produit->setDate_dexpiration($value_Data["date_d'expiration"]);   
                   $produit->setCategorie_produit($value_Data["supply"]);   
                //    $produit->setQuantite_stock($value_Data["quantite_stock"]);   
                   $produit->setNom_Categorie($value_Data["Category_Name"]);   
                   array_push($TableData, $produit);
                   
                }
             
             
                   return $TableData;
    }
    //Afficher produit
    // public function AjouterProduit($produit){
        
    //    $idProduit = $produit->getId_Produit () ;   
    //    $Prix = $produit->getPrix();   
    //    $Nom_produit =  $produit->getNom_Produit();   
    //    $Description = $produit->getDescription();   
    //    $Date_dexpiration = $produit->getDate_dexpiration();   
    //    $Categorie_produit = $produit->getCategorie_produit();   
    //    $photo = $produit->getPhoto();    
    //     // requête SQL
    //     $insertRow="INSERT INTO products(`id_category`, `Name`, `price`, `Description_product`,  `category_product`,image_dir) 
    //                   VALUES('$idProduit', '$Nom_produit' ,'$Prix' , '$Description'  , '$Categorie_produit','$photo')";

    //     mysqli_query($this->getConnection(), $insertRow);
    // }




    // public function upload_photo($fileName, $tempname){

    //     $folder = '../img/'.$fileName;
    //     move_uploaded_file($tempname, $folder);
    // } 

    //afficher categorie
    public function afficherCategorie(){

            $SelctRow = 'SELECT * FROM category';                 
                   $query = mysqli_query($this->getConnection() ,$SelctRow);
                   $produits_data = mysqli_fetch_all($query, MYSQLI_ASSOC);
                   $TableData = array();
                   foreach ( $produits_data as $value_Data) {
                    $produit = new Produit_Categorie();
                    $produit->setId_Categorie($value_Data['id_category']);
                    $produit->setNom_Categorie($value_Data["Category_Name"]); 
                    array_push($TableData, $produit);
                }
                return $TableData;   
    }

    // afficher modification
    // public function afficherProduit($id){
    //     $SelctRow = "SELECT * FROM products                                                                                                            
    //     INNER JOIN category  ON products.category_product = category.id_category WHERE  products.id = '$id'  " ;
    //     $query = mysqli_query($this->getConnection() ,$SelctRow);
    //     $produits_data = mysqli_fetch_all($query, MYSQLI_ASSOC);
    //     $TableData = array();
    //     foreach ( $produits_data as $value_Data) {
                  
                   
    //                $produit = new Produit_Categorie();
    //                $produit->setId_Produit($value_Data['id']); 
    //                $produit->setNom_Produit($value_Data['Name']);   
    //                $produit->setPrix($value_Data['price']);                      
    //                $produit->setDescription($value_Data['Description_product']);   
    //             //    $produit->setDate_dexpiration($value_Data["date_d'expiration"]);   
    //                $produit->setCategorie_produit($value_Data["category_product"]);   
    //             //    $produit->setQuantite_stock($value_Data["quantite_stock"]); 
    //                $produit->setNom_Categorie($value_Data["Category_Name"]);  
    //                $produit->setPhoto($value_Data["image_dir"]);  
    //                array_push($TableData, $produit);
                   
    //             }
    //                return $TableData;
    // }

    // modifier

    // public function Modifier($produit){
    //     // Requête SQL


    //     $id = $produit->getId_Produit() ;   
    //     $Prix = $produit->getPrix();   
    //     $Nom_produit =  $produit->getNom_Produit();   
    //     $Description = $produit->getDescription();   
    //     $Date_dexpiration = $produit->getDate_dexpiration();   
    //     $Quantite_stock = $produit->getQuantite_stock();    
    //     $photo = $produit->getPhoto(); 

    //     $RowUpdate = "UPDATE products SET 
    //     Name='$Nom_produit',price = '$Prix', `Description_product`= '$Description' ,  image_dir='$photo' WHERE  id = $id" ;

    //     mysqli_query($this->getConnection(),$RowUpdate);
    // }
    // suprimmer
    public function Supprimer($id){
        $RowDelet = "DELETE FROM products WHERE id= '$id'";
        mysqli_query($this->getConnection(), $RowDelet);
    
    }
    // ajouter categorie

    public function ajouterCategorie($categorie){

         $Nom_categorie = $categorie->getNom_Categorie();    
         // requête SQL
         $insertRow="INSERT INTO category(`Category_Name`) 
                       VALUES('$Nom_categorie')";
 
         mysqli_query($this->getConnection(), $insertRow);
             
    }
    // suprimmer categorie
    public function SupprimerCategorie($id){
        $RowDelet = "DELETE FROM category WHERE id_category= '$id'";
        mysqli_query($this->getConnection(), $RowDelet);
    
    }

}