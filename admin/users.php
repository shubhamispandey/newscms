<?php
    include "header.php";
    include "config.php";
    mysqli_query($conn, "ALTER TABLE user DROP user_id");
    mysqli_query($conn, "ALTER TABLE user AUTO_INCREMENT = 1");
    mysqli_query($conn, "ALTER TABLE user ADD user_id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST");
    
    if($_SESSION['user_role'] == 0){
        header("location: {$hostname}/admin/post.php");
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <?php
                    include "config.php";
                    
                    $limit = 10;
                    if(isset($_GET['page'])){
                        $page_no = $_GET['page'];
                        $offset = ($page_no - 1) * $limit;
                        $sql = "SELECT * FROM user LIMIT {$offset}, {$limit}";
                    }else{
                        $page_no = 1;
                        $sql = "SELECT * FROM user LIMIT 0 , {$limit}";
                    }
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0){
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td class='id'><?php echo $row['user_id'] ?></td>
                            <td><?php echo $row['first_name'] ." ". $row['last_name'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php 
                                        if($row['role'] == 0){
                                            echo 'Normal';
                                        }else{
                                            echo 'Admin';
                                        };
                                    ?></td>
                            <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"]; ?>'><i
                                        class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-user.php?id=<?php echo $row["user_id"]; ?>'><i
                                        class='fa fa-trash-o'></i></a></td>
                                    </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <!-- ------------------------------ PAGINATION ------------------------------ -->
                <ul class='pagination admin-pagination'>
                    <?php
                    $sql1 = "SELECT * FROM user";
                    $result1 = mysqli_query($conn, $sql1);
                    $records = mysqli_num_rows($result1);
                    $pages = ceil($records / $limit);
                    
                    if($page_no > 1){
                        $page_prev = $page_no - 1;
                        echo '<li><a href="https://localhost/newscms/admin/users.php?page='.$page_prev.'">'.'Prev'.'</a></li>';
                    }
                    for($i=1; $i<= $pages; $i++){
                        if($page_no == $i){
                            $active = "class='active'";
                            $style = "style='background:#083f75;'";
                        }else{
                            $active = "class=''";
                            $style = "";
                        }
                        echo '<li '.$active.'><a '.$style.'href="https://localhost/newscms/admin/users.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    if($page_no < $pages){
                        $page_next = $page_no + 1;
                        echo '<li><a href="https://localhost/newscms/admin/users.php?page='.$page_next.'">'.'Next'.'</a></li>';
                    }
                    // <li class="active"><a>1</a></li>s
                    ?>
                </ul>

                <?php
                    }else{
                        echo '<div class="alert alert-danger" role="alert">
                        No records found
                      </div>';
                    } 
                ?>

            </div>
        </div>
    </div>
</div>
<!-- PHP code to save password using md5 -->
<?php
    /* $sq = "SELECT * FROM user";
    $resul = mysqli_query($conn , $sq);
    while($row = mysqli_fetch_assoc($resul)){
        $pass = $row['password'];
        $newpass = md5($pass);
        mysqli_query($conn, "UPDATE user SET password = '{$newpass}' WHERE password = '{$pass}'");
    } */
?>
<?php include "footer.php"; ?>