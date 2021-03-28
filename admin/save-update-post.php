
<?php
    include "header.php";
    include "config.php";
    if(isset($_FILES['new-image'])){
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_tmp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $tmp = explode('.',$file_name);
        $file_ext = strtolower(end($tmp));
        $extensions = array("jpeg","jpg","png");
        
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
            echo "<a href='{$hostname}/admin/post.php' class='btn btn-outline-danger'>Try again</a>";
            die();
        }
    }
    $postid = mysqli_escape_string($conn,$_POST['post_id']);
    $title = mysqli_escape_string($conn,$_POST['post_title']);
    $description = mysqli_escape_string($conn,$_POST['postdesc']);
    $category = mysqli_escape_string($conn,$_POST['category']);

    $sql1 = "UPDATE post SET title = '{$title}', description = '{$description}', category = {$category}, post_img = '{$file_name}' WHERE post_id = {$postid};";
    $sql1 .= "UPDATE category SET post = post + 1 WHERE category_id = {$category};";
    $sql1 .= "UPDATE category SET post = post - 1 WHERE category_id = {$_SESSION['prev_categ']};";
    $result = mysqli_multi_query($conn, $sql1) or die("Query Failed");
    if($result){
        header("location: {$hostname}/admin/post.php");
    }

?>