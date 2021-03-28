<?php
    $user_id = $_GET['id'];
    include "config.php";

    $sql = "DELETE FROM user WHERE user_id = '{$user_id}'";
    $result = mysqli_query($conn, $sql);

    // mysqli_query($conn, "ALTER TABLE user DROP user_id");
    // mysqli_query($conn, "ALTER TABLE user AUTO_INCREMENT = 1");
    // mysqli_query($conn, "ALTER TABLE user ADD user_id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");

    if($result){
        header("location: {$hostname}/admin/users.php");
    }else{
        echo "<h1>Failed to Delete</h1>";
    }
?>