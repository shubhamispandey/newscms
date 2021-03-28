<?php 
    include "header.php"; 
    include "config.php";

    $sql5 = "SELECT * FROM post 
            LEFT JOIN user ON user.user_id = post.author
            LEFT JOIN category ON category.category_id = post.category  
            WHERE post_id = {$_GET['post']}";
    // $sql5 = "SELECT * FROM post WHERE post_id = {$_GET['post']}";
    $result5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($result5);
    if($_SESSION['user_role'] == 0){
        if($row5['user_id'] != $_SESSION['user_id']){
            header("location: {$hostname}/admin");
        }
    }
    
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php
            // session_start();
            $_SESSION['update_id'] = $_GET['post'];
            $sql = "SELECT * FROM post 
                    LEFT JOIN user ON user.user_id = post.author
                    LEFT JOIN category ON category.category_id = post.category 
                    WHERE post.post_id = {$_SESSION['update_id']}";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                while($rows = mysqli_fetch_assoc($result)){
                    $_SESSION['prev_categ'] = $rows['category'];
        ?>
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $rows['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $rows['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $rows['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <option disabled selected> Select Category</option>
                    <?php
                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn , $sql1) or die("query failed :". mysqli_connect_error());
                        while($row = mysqli_fetch_assoc($result1)){
                            if($rows['category'] == $row['category_id']){
                                $select = "selected";
                            }else{
                                $select = "";
                            }
                            echo "<option {$select} value='{$row['category_id']}'> {$row['category_name']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $rows['post_img'] ?>" height="150px">
                <input type="hidden" name="old-image" value="">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php 
        }}else{
            echo "<div class='alert alert-danger'>No Data Found!</div>";
        }
        
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>


<?php include "footer.php"; ?>
