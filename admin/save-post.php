<?php
    include "config.php";
    session_start();
    if(!isset($_SESSION['username'])){
        header("location: {$hostname}/admin");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <a href="post.php"><img class="logo" src="images/news.jpg"></a>
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-lg-3">
                        <a href="logout.php" class="admin-logout" >Hello, <?php echo $_SESSION['username'] ?> logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>

<?php
    
    include "config.php";
    if(isset($_FILES['fileToUpload'])){
        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_tmp = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $tmp = explode('.',$file_name);
        $file_ext = strtolower(end($tmp));
        $extensions = array("jpeg","jpg","png","webp");
        
        $errors = array();
        if(in_array($file_ext,$extensions) === false){
            $errors[0] = "This extension is not allowed";
            echo "<div class='alert alert-danger'>{$errors[0]}</div>";
        }
        if($file_size > 2097152){
            $errors[1] = "The file size is more than 2mb";
            echo "<div class='alert alert-danger'>{$errors[1]}</div>";
        }
        if(empty($errors)){
            move_uploaded_file($file_tmp,"upload/{$file_name}");
        }else{
            echo "<a href='{$hostname}/admin/add-post.php' class='btn btn-outline-danger'>Try again</a>";
            die();
        }
    }

    mysqli_query($conn, "ALTER TABLE post DROP post_id");
    mysqli_query($conn, "ALTER TABLE post AUTO_INCREMENT = 1");
    mysqli_query($conn, "ALTER TABLE post ADD post_id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");

    // session_start();
    $title = mysqli_escape_string($conn,$_POST['post_title']);
    $description = mysqli_escape_string($conn,$_POST['postdesc']);
    $category = mysqli_escape_string($conn,$_POST['category']);
    $date = date("Y-m-d");
    $author = $_SESSION['user_id'];

    $sql = "INSERT INTO post ( title, description, category, post_date, author, post_img)
            VALUES ( '{$title}', '{$description}', '{$category}', '{$date}', '{$author}', '{$file_name}' );";
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";
    $result = mysqli_multi_query($conn, $sql) or die("Query Failed");
    if($result){
        header("location: {$hostname}/admin/post.php");
    }

?>
