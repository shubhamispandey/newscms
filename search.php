<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
            <?php
                    include "admin/config.php";

                    $limit = 2;

                    
                    if(isset($_GET['search'])){
                        $search_term = $_GET['search'];
                        $page_no = $_GET['page'];
                        $offset = ($page_no - 1) * $limit;
                        $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category  
                                WHERE title LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'  OR username LIKE '%{$search_term}%' OR first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR category_name LIKE '%{$search_term}%'
                                LIMIT {$offset}, {$limit}";
                        $sql1 = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category  
                                WHERE title LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'  OR username LIKE '%{$search_term}%' OR first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR category_name LIKE '%{$search_term}%'";
                    }else{
                        $page_no = 1;
                        $sql = "SELECT * FROM post 
                            LEFT JOIN user ON user.user_id = post.author
                            LEFT JOIN category ON category.category_id = post.category  
                            WHERE title LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'  OR username LIKE '%{$search_term}%' OR first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR category_name LIKE '%{$search_term}%'                 
                            LIMIT 0, {$limit}";
                        $sql1 = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category  
                                WHERE title LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'  OR username LIKE '%{$search_term}%' OR first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'";
                    }
                    
                    $result = mysqli_query($conn, $sql) or die("query failed");
                    $result1 = mysqli_query($conn, $sql1) or die("query failed");
                    $row1 = mysqli_fetch_assoc($result1);
                    
                    if(mysqli_num_rows($result) > 0){
                               
                ?>
                <div class="post-container">
                    <h2 class="page-heading">Search : <?php echo $search_term ?></h2>

                    <?php while($row = mysqli_fetch_assoc($result)){ ?>

                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title'] ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category_id'] ?>&page=1'><?php echo $row['category_name'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row['user_id'] ?>&page=1'><?php echo $row['username'] ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date'] ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,150) ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>

                    <ul class='pagination'>
                        <?php
                            $sql1 = "SELECT * FROM post 
                            LEFT JOIN user ON user.user_id = post.author
                            LEFT JOIN category ON category.category_id = post.category  
                            WHERE title LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'  OR username LIKE '%{$search_term}%' OR first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR category_name LIKE '%{$search_term}%'";
                            $result1 = mysqli_query($conn, $sql1);
                            $records = mysqli_num_rows($result1);
                            $pages = ceil($records / $limit);
                            
                            if($page_no > 1){
                                $page_prev = $page_no - 1;
                                echo '<li><a href="https://localhost/cms/search.php?page='.$page_prev.'&search='.$search_term.'">'.'Prev'.'</a></li>';
                            }
                            for($i=1; $i<= $pages; $i++){
                                if($page_no == $i){
                                    $active = "class='active'";
                                    $style = "style='background:#083f75;'";
                                }else{
                                    $active = "class=''";
                                    $style = "";
                                }
                                echo '<li '.$active.'><a '.$style.'href="https://localhost/cms/search.php?page='.$i.'&search='.$search_term.'">'.$i.'</a></li>';
                            }
                            if($page_no < $pages){
                                $page_next = $page_no + 1;
                                echo '<li><a href="https://localhost/cms/search.php?page='.$page_next.'&search='.$search_term.'">'.'Next'.'</a></li>';
                            }
                            // <li class="active"><a>1</a></li>s
                        ?>
                    </ul>
                </div><!-- /post-container -->
                <?php
                        }else{
                            echo '<div class="alert alert-danger" role="alert">No records found </div>';
                        }
                ?>
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
