    <?php 
        include "header.php"; 
    ?>
    <div id="admin-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="admin-heading">All Posts</h1>
                </div>
                <div class="col-md-4">
                    <a class="add-new" href="<?php echo $hostname ?>">CMS</a>
                    <a class="add-new" href="add-post.php">add post</a>
                </div>
                <div class="col-md-12">
                <?php
                        include "config.php";
                        
                        $limit = 3;
                        if(isset($_GET['post'])){
                            $page_no = $_GET['post'];
                            $offset = ($page_no - 1) * $limit;
                            if($_SESSION['user_role'] == 1){
                                $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category                        
                                LIMIT {$offset}, {$limit}";
                            }else{
                                $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category 
                                WHERE user.user_id = {$_SESSION['user_id']}                      
                                LIMIT {$offset}, {$limit}";
                            }
                        }else{
                            $page_no = 1;
                            if($_SESSION['user_role'] == 1){
                                $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category                        
                                LIMIT 0, {$limit}";
                            }else{
                                $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category 
                                WHERE user.user_id = {$_SESSION['user_id']}                       
                                LIMIT 0, {$limit}";
                            }
                        }
                        $result = mysqli_query($conn, $sql) or die();
                        
                        if(mysqli_num_rows($result) > 0){
                    ?>
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td class='id'><?php echo $row['post_id'] ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo date("d M,Y",strtotime($row['post_date'])) ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td class='edit'><a href='update-post.php?post=<?php echo $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-post.php?post=<?php echo $row['post_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <ul class='pagination admin-pagination'>
                        <?php
                        $sql1 = "SELECT * FROM post";
                        $result1 = mysqli_query($conn, $sql1);
                        $records = mysqli_num_rows($result1);
                        $pages = ceil($records / $limit);
                        
                        if($page_no > 1){
                            $page_prev = $page_no - 1;
                            echo '<li><a href="https://localhost/newscms/admin/post.php?post='.$page_prev.'">'.'Prev'.'</a></li>';
                        }
                        for($i=1; $i<= $pages; $i++){
                            if($page_no == $i){
                                $active = "class='active'";
                                $style = "style='background:#083f75;'";
                            }else{
                                $active = "class=''";
                                $style = "";
                            }
                            echo '<li '.$active.'><a '.$style.'href="https://localhost/newscms/admin/post.php?post='.$i.'">'.$i.'</a></li>';
                        }
                        if($page_no < $pages){
                            $page_next = $page_no + 1;
                            echo '<li><a href="https://localhost/newscms/admin/post.php?post='.$page_next.'">'.'Next'.'</a></li>';
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
