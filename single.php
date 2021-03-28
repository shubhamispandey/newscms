<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <?php
                        include "admin/config.php";

                        $id = $_GET['id'];
                        if(isset($_GET['id'])){
                            $sql = "SELECT * FROM post 
                                LEFT JOIN user ON user.user_id = post.author
                                LEFT JOIN category ON category.category_id = post.category
                                WHERE post_id = {$id}";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                        
                    ?>
                    <div class="post-container">
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <div class="post-content single-post">
                            <h3><?php echo $row['title'] ?></h3>
                            <div class="post-information">
                                    <span>
                                        <a href='category.php?cid=<?php echo $row['category_id'] ?>&page=1'><i class="fa fa-tags" aria-hidden="true"></i><?php echo $row['category_name'] ?>
                                        </a>
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
                                <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/>
                                <p class="description">
                                    <?php echo $row['description'] ?>
                                </p>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                         }else{
                            echo "Post NOT fOUND";
                         }}else{
                             header("location: {$hostname}/index.php");
                         }
                    ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
