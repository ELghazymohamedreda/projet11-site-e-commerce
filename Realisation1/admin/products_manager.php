<?php
include "db.php"; 
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="#">Add Products <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="../admin/index.php">Dashboard</a>
    </div>
  </div>
</nav>
     <!-- add product form (New!!! - 14/04/2022) -->
      <div class="card card-body">
        <form action="add_product.php" method="POST">
          <div class="form-group">
            <input type="text" name="id" class=" col-xs-3 form-control" placeholder="id" autofocus>
          </div>
          <div class="form-group">
            <textarea name="Name" rows="2" class=" col-xs-3 form-control" placeholder="Product Name"></textarea>
          </div>
          <div class="form-group">
            <textarea name="Description_product" rows="2" class="form-control" placeholder="Descreption"></textarea>
          </div>
          <div class="form-group">
            <textarea name="price" rows="2" class="form-control" placeholder="Price"></textarea>
          </div>
          <div class="form-group">
            <textarea name="supply" rows="2" class="form-control" placeholder="Supply"></textarea>
          </div>
          <!-- Categories Select -->
          <select class="form-select" aria-label="Default select example" name="Assignment_Category">
            <option selected>Prodcut Categories</option>
            <option value="Facial Cleanser" >Facial Cleanser</option>
            <option value="Hand Cream" >Hand Cream</option>
            <option value="Toner">Toner</option>
            <option value="Moisturizer">Moisturizer</option>
          </select>
          <br> 
          <!-- Button -->
          <input type="submit" name="add_product" class="btn btn-success btn-block" value="Add Product!">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description_product</th>
            <th>supply</th>
            <th>Assignment_Category</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>

          <?php
          $query = "SELECT * FROM products";
          $result_tasks = mysqli_query($conn, $query);    
          while($row = mysqli_fetch_assoc($result_tasks)) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['price']; ?> dh</td>
            <td><?php echo $row['Description_product']; ?></td>
            <td><?php echo $row['supply'];?></td>
            <td><?php echo $row['Assignment_Category']; ?></td>


          </tr>
             <!-- <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fas fa-marker"></i>
              </a>  -->
              <!-- <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                <i class="far fa-trash-alt"></i>  -->
              </a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
<!-- add product form end -->

<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    By adn and cutie! © 2022 Copyright:
    <a class="text-dark" href="https://github.com/tba-adnan">github - shopping- ecommerce.</a>
  </div>
  <!-- Copyright -->
</footer>