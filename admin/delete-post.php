
<?php
    include "header.php";
    include "config.php";
    
    $postid = mysqli_escape_string($conn,$_GET['post']);
    $sql = "SELECT * FROM post WHERE post_id = {$postid}";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    $sql1 = "SELECT * FROM post WHERE post_id = {$postid}";
    $result1 = mysqli_query($conn , $sql1) or die("select");
    $row1 = mysqli_fetch_assoc($result1);
    
    unlink("upload/".$row1['post_img']);
    while($row = mysqli_fetch_assoc($result)){
        $category = $row['category'];
        $sql2 = "UPDATE category SET post = post - 1 WHERE category_id = {$category};";
        $sql2 .= "DELETE FROM post WHERE post_id = {$postid};";
        $result2 = mysqli_multi_query($conn, $sql2) or die("Query Failed");
        if($result2){
            header("location: {$hostname}/admin/post.php");
        }
    }
?>