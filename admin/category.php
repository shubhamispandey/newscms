<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
            <?php
                    include "config.php";
                    
                    $limit = 3;
                    if(isset($_GET['category'])){
                        $page_no = $_GET['category'];
                        $offset = ($page_no - 1) * $limit;
                        $sql = "SELECT * FROM category                      
                                LIMIT {$offset}, {$limit}";
                    }else{
                        $page_no = 1;
                        $sql = "SELECT * FROM category                        
                            LIMIT 0, {$limit}";
                    }
                    $result = mysqli_query($conn, $sql) or die();
                    
                    if(mysqli_num_rows($result) > 0){
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td class='id'><?php echo $row['category_id'] ?></td>
                            <td><?php echo $row['category_name'] ?></td>
                            <td><?php echo $row['post'] ?></td>
                            <td class='edit'><a href='update-category.php'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php
                    $sql1 = "SELECT * FROM category";
                    $result1 = mysqli_query($conn, $sql1);
                    $records = mysqli_num_rows($result1);
                    $pages = ceil($records / $limit);
                    
                    if($page_no > 1){
                        $page_prev = $page_no - 1;
                        echo '<li><a href="'.$hostname.'/admin/category.php?category='.$page_prev.'">'.'Prev'.'</a></li>';
                    }
                    for($i=1; $i<= $pages; $i++){
                        if($page_no == $i){
                            $active = "class='active'";
                            $style = "style='background:#083f75;'";
                        }else{
                            $active = "class=''";
                            $style = "";
                        }
                        echo '<li '.$active.'><a '.$style.'href="'.$hostname.'/admin/category.php?category='.$i.'">'.$i.'</a></li>';
                    }
                    if($page_no < $pages){
                        $page_next = $page_no + 1;
                        echo '<li><a href="'.$hostname.'/admin/category.php?category='.$page_next.'">'.'Next'.'</a></li>';
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
<?php include "footer.php"; ?>
