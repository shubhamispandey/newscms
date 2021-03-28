<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
                    <?php
                        include "config.php";
                        if(isset($_POST['save'])){
                            $categname = mysqli_escape_string($conn,$_POST['cat']);

                            mysqli_query($conn, "ALTER TABLE category DROP category_id");
                            mysqli_query($conn, "ALTER TABLE category AUTO_INCREMENT = 1");
                            mysqli_query($conn, "ALTER TABLE category ADD category_id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");

                            $sql = "INSERT INTO category (category_name,post) VALUES ('{$categname}', 0)";
                            $result = mysqli_query($conn, $sql) or die("Query Failed");
                            if($result){
                                header("location: {$hostname}/admin/category.php");
                            }
                        }   

                    ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
