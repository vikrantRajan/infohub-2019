<?php include("DBentguide/db.php"); ?>

<?php include("includes/header.php"); ?>
<!-- NAVIGATION -->
<?php include("includes/navigation.php"); ?>
<?php include("functions/functions.php"); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php 
        if(isset($_GET['category'])){
           $post_category_id = $_GET['category'];
        }
        // global $connection;
        $category_query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
        $get_category = mysqli_query(ConnectToDB::con(), $category_query);
        while($row = mysqli_fetch_assoc($get_category)){
            ?>
            <h1 class="page-header"><?php echo $row['cat_title']; ?></h1>
            <?php
        }

        $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'Published' ORDER BY post_date";
        $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);

            while($row = mysqli_fetch_assoc($selectAllPosts)){
                $post_id = $row['post_id'];
               $post_title = $row['post_title'];
               $post_author = $row['post_author'];
              
               $post_date = $row['post_date'];
               $post_image = $row['post_image'];
               $post_content = substr($row['post_content'], 0,200); 
              
             ?>
            <!-- CLOSING PHP TAG TO DISPLAY 1 SET OF RESULTS IN THE FOLLOWING FORMAT -->

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>
"><?php echo $post_author; ?></a>
            </p>
            <?php 
               
               $date = date('Y-m-d');
               $today = strtotime ( '+1 hour' , strtotime ( $date ) ) ;
               $today = date ( 'Y-m-d' , $today );
               $threeDaysBefore = strtotime ( '+3 day' , strtotime ( $today ) ) ;
               $threeDaysBefore = date("Y-m-d", $threeDaysBefore);
               $twoDaysBefore = strtotime ( '+2 day' , strtotime ( $today ) ) ;
               $twoDaysBefore = date("Y-m-d", $twoDaysBefore);
               $oneDayBefore = strtotime ( '+1 day' , strtotime ( $today ) ) ;
               $oneDayBefore = date("Y-m-d", $oneDayBefore);

               if($post_date > $today)  {
                   ?>
                   <p class="normalText"><span class='glyphicon glyphicon-time'></span><?php echo $post_date; ?></p> 
                   <?php
               } else  if($post_date < $today)  {
                   ?>
                   <p class="alertText"><span class='glyphicon glyphicon-time'></span><?php echo $post_date; ?> Past Due</p> 
                   <?php
                  
               } 
             
              
              
           if($oneDayBefore == $post_date) {
               ?>
               <p class="alertText">Tomorrow</p> 
               <?php
           } else if ($twoDaysBefore == $post_date) {
               ?>
               <p class="warningText">In 2 Days</p> 
               <?php
           }  else if ($threeDaysBefore == $post_date) {
            ?>
              <p class="warningText">In 3 Days </p>
            <?php
        } else  if($post_date == date('Y-m-d'))  {
            ?>
            <p class="alertText"><span class='glyphicon glyphicon-time'></span><?php echo $post_date; ?> Today</p> 
            <?php
           
        } 
           
          
               
               ?>
           
           
            <img class="img-responsive" src="imgs/<?php echo $post_image; ?>" alt="">
           
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary hover_effect" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
            <?php } ?>
        </div><!-- MARKS END OF COL-MD-8 ROW -->

        <!-- Blog Sidebar Widgets Column -->
        <?php include("includes/sidebar.php"); ?>
    </div>
    <!-- MARKS END OF .row -->



    <?php include("includes/footer.php"); ?>
