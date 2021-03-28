
<?php
    include 'admin/config.php';
    $page_name = basename($_SERVER['PHP_SELF']);
    switch($page_name){
        case "index.php":
            $page_title = "News Site";
            break;
        case "category.php":
            if(isset($_GET['cid'])){

                $sql = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $page_title = "{$row['category_name']}";
            }else{
                $page_title = "Category ";
            }
            break;
        case "search.php":
            if(isset($_GET['search'])){
                $search_term = $_GET['search'];
                $sql = "SELECT * FROM post 
                        LEFT JOIN user ON user.user_id = post.author
                        LEFT JOIN category ON category.category_id = post.category  
                        WHERE title LIKE '%{$search_term}%' OR description LIKE '%{$search_term}%'  OR username LIKE '%{$search_term}%' OR first_name LIKE '%{$search_term}%' OR last_name LIKE '%{$search_term}%' OR category_name LIKE '%{$search_term}%'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $page_title = "Search: {$search_term}";
            }else{
                $search_term = "No Record Found";
                $page_title = "Search ";
            }
            break;
        case "single.php":
            if(isset($_GET['id'])){
                $sql = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $page_title = substr($row['title'],0,30);
            }
            break;
        case "author.php":
            if(isset($_GET['aid'])){
                $sql = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $page_title = "Author: ".substr($row['first_name'],0,30);
            }else{
                $page_title = "Author";
            }
            break;
        default:
            $page_title = "News Site";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mystyle.css">

</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <div class="bg-video">
            <video class="bg-video__content darkmode-ignore" autoplay loop muted>
                <source src="images/news.mp4" type="video/mp4">
            </video>
        </div>
        <!-- container -->
        <div class="container">
            <a href="index.php" id="logo"><img src="images/news.png"></a>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class='menu'>
                        <?php
                        
                        include "admin/config.php";
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql) or die("Query Failed in category loading in header.php");
                        while($row = mysqli_fetch_assoc($result)){
                            if($page_name == "category.php"){
                                if(isset($_GET['cid'])){
                                    if($row['category_id'] == $_GET['cid']){
                                        $active = "active";
                                    }else{
                                        $active = "";
                                    }
                                }else{
                                    if($row['category_id'] == 1){
                                        $active = "active";
                                    }else{
                                        $active = "";
                                    }
                                }
                            }else{
                                $active = "";
                            }
                    ?>
                        <li><a class="<?php echo $active ?>"
                                href='category.php?cid=<?php echo $row['category_id'] ?>&page=1'><?php echo $row['category_name'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-nav">
        <form action="filter.php" class="filter" method="get">
            <div class="filter-group">
                <span for="from">From</span>
                <input id="from" name="from" class="form-control" type="date" aria-label="With textarea"></input>
            </div>
            <div class="filter-group">
                <span for="to">To</span>
                <input id="to" name="to" class="form-control" type="date" aria-label="With textarea"></input>
            </div>
            <div class="filter-group">
                <input type="submit" value="Filter">
            </div>
        </form>
        <a href="/newscms/admin">Login</a>
    </nav>
    <!-- /Menu Bar -->