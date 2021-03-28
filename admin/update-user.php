<?php 
    include "header.php";
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                    include "config.php";
                    ob_start();
                    $sql = "SELECT * FROM user WHERE user_id = {$_GET['id']}";
                    $result = mysqli_query($conn, $sql) or die("query failed");
                    
                    if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                  ?>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id'] ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name'] ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" value="<?php echo $row['last_name'] ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>"
                            placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role">
                            <?php 
                                $select = "selected";
                                if($row['role'] == 0){
                                    echo "<option {$select} value='0'>normal User</option>";
                                    echo "<option value='1'>Admin</option>";
                                }else{
                                    echo "<option value='0'>normal User</option>";
                                    echo "<option {$select} value='1'>Admin</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                </form>
                <?php }} ?>
                <!-- /Form -->
<?php
    if(isset($_POST['submit'])){
        $_id = mysqli_escape_string($conn, $_POST['user_id']);
        $_fname = mysqli_escape_string($conn, $_POST['fname']);
        $_lname = mysqli_escape_string($conn, $_POST['lname']);
        $_username = mysqli_escape_string($conn, $_POST['username']);
        $_role = mysqli_escape_string($conn, $_POST['role']); 
        
        $sql1 = "SELECT username FROM user WHERE username = '{$_username}'";
        $result1 = mysqli_query($conn, $sql1) or die("failed at confirming username");
        if(mysqli_num_rows($result1) > 0){
            echo "<p style='color:red;font-size:18px;'>Usernme already exists</p>";
        }else{
            $sql2 = "UPDATE user SET first_name = '{$_fname}', last_name = '{$_lname}', username = '{$_username}', role = '{$_role}' WHERE user_id = {$_id}";
            $result2 = mysqli_query($conn, $sql2);
            header("location: {$hostname}/admin/users.php");
        }
        ob_end_flush();
        mysqli_close($conn);
    }     
?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>