<<<<<<< HEAD
<?php 
// if (session_status() == PHP_SESSION_NONE) session_start(); 
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- LOGO -->
            <!-- <a href="./index.php">
            <img class="navbar-brand" src="imgs/Cdm_logo.png" alt="">
            CDM C14
            </a> -->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <li class='navigation_tags navLogoFX'><a href="./index.php">C14</a></li>
                <?php 
            $query = "SELECT * FROM categories";
            $selectAllCategories = mysqli_query(ConnectToDB::con(), $query);

            while($row = mysqli_fetch_assoc($selectAllCategories)){
               $cat_title = $row['cat_title'];
               $cat_id = $row['cat_id'];

               echo "<li class='navigation_tags'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
               

            }
           
            ?>


                <?php 
                
                
                if(isset($_SESSION['user_role'])) {
                    echo "<li class='navigation_tags'><a href='admin/index.php'>Admin</a></li>";
                    if(isset($_GET['p_id'])) {

                        $the_post_id = $_GET['p_id'];
                        
                        echo "<li class='navigation_tags'><a  href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                    }
                }
                
                
                ?>
                <!-- <li class='navigation_tags'><a href='http://projects.thecdm.ca/c14/admin/index.php'>Admin</a></li> -->
                <li class='navigation_tags'><a 
                        href='registration.php'>Register</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
=======
<?php 
// if (session_status() == PHP_SESSION_NONE) session_start(); 
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- LOGO -->
            <!-- <a href="./index.php">
            <img class="navbar-brand" src="imgs/Cdm_logo.png" alt="">
            CDM C14
            </a> -->
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            <li class='navigation_tags navLogoFX'><a href="./index.php">C14</a></li>
                <?php 
            $query = "SELECT * FROM categories";
            $selectAllCategories = mysqli_query(ConnectToDB::con(), $query);

            while($row = mysqli_fetch_assoc($selectAllCategories)){
               $cat_title = $row['cat_title'];
               $cat_id = $row['cat_id'];

               echo "<li class='navigation_tags'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
               

            }
           
            ?>


                <?php 
                
                
                if(isset($_SESSION['user_role'])) {
                    echo "<li class='navigation_tags'><a href='admin/index.php'>Admin</a></li>";
                    if(isset($_GET['p_id'])) {

                        $the_post_id = $_GET['p_id'];
                        
                        echo "<li class='navigation_tags'><a  href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                    }
                }
                
                
                ?>
                <li class='navigation_tags'><a href='http://projects.thecdm.ca/c14/admin/index.php'>Admin</a></li>
                <li class='navigation_tags'><a 
                        href='registration.php'>Register</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
>>>>>>> 15ab65f87f17bcc9d59e7e8c63a0a1ca6faf13cb
</nav>