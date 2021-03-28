<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <?php
                        include "admin/config.php";
                        $from = $_GET['from'];
                        $to = $_GET['to'];
                        $limit = 3;
                        if(isset($_GET['id'])){
                            $page_no = $_GET['id'];
                            $offset = ($page_no - 1) * $limit;
                            $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category 
                                WHERE post_date >= '{$from}' AND post_date <= '{$to}'       
                                LIMIT {$offset}, {$limit}";
                        }else{
                            $page_no = 1;
                            $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category 
                                WHERE post_date >= '{$from}' AND post_date <= '{$to}'       
                                LIMIT 0, {$limit}";
                        }
                        $result = mysqli_query($conn, $sql) or die();
                        
                        if(mysqli_num_rows($result) > 0){
                    ?>
                    <div class="post-container">
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
                                            <a href='category.php?cid=<?php echo $row['category_id'] ?>&page=1'><i class="fa fa-tags" aria-hidden="true"></i><?php echo $row['category_name'] ?></a>

                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['user_id'] ?>&page=1'><?php echo $row['username'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo date("d M,Y",strtotime($row['post_date'])) ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'],0,150)."...." ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <ul class='pagination admin-pagination'>
                            <?php
                                $sql1 = "SELECT * FROM post WHERE post_date >= '{$from}' AND post_date <= '{$to}'";
                                $result1 = mysqli_query($conn, $sql1);
                                $records = mysqli_num_rows($result1);
                                $pages = ceil($records / $limit);
                                
                                if($page_no > 1){
                                    $page_prev = $page_no - 1;
                                    echo '<li><a href="'.$hostname.'/filter.php?id='.$page_prev.'&from='.$from.'&to='.$to.'">'.'Prev'.'</a></li>';
                                }
                                for($i=1; $i<= $pages; $i++){
                                    if($page_no == $i){
                                        $active = "class='active'";
                                        $style = "style='background:#083f75;'";
                                    }else{
                                        $active = "class=''";
                                        $style = "";
                                    }
                                    echo '<li '.$active.'><a '.$style.'href="'.$hostname.'/filter.php?id='.$i.'&from='.$from.'&to='.$to.'">'.$i.'</a></li>';
                                }
                                if($page_no < $pages){
                                    $page_next = $page_no + 1;
                                    echo '<li><a href="'.$hostname.'/filter.php?id='.$page_next.'&from='.$from.'&to='.$to.'">'.'Next'.'</a></li>';
                                }
                                // <li class="active"><a>1</a></li>s
                            ?>
                        </ul>
                        <!-- <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul> -->
                    </div><!-- /post-container -->
                    

                    <?php
                        }else{
                            echo '<div class="alert alert-danger" role="alert">
                            No records found
                        </div>';
                        } 
                    ?>
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
