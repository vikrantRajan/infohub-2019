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
            <h1 class="page-header">
                C14 HUB :)
                
            </h1>
            <p id="typed"></p>
         


            <?php 
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }
        
            if($page == "" || $page == 1) {
        
                $page_1 = 0;
            } else {
                $page_1 = ($page * 10) - 10;
            }
            $date = date('Y-m-d');
            $today = strtotime ( '+1 hour' , strtotime ( $date ) ) ;
            $today = date ( 'Y-m-d' , $today );
            $query = "SELECT * FROM posts ORDER BY post_date LIMIT $page_1, 10 ";
            $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
            
            while($row = mysqli_fetch_assoc($selectAllPosts)){
                $post_id = $row['post_id'];
               $post_title = $row['post_title'];
               $post_author = $row['post_author'];
              
               $post_date = $row['post_date'];
               $post_image = $row['post_image'];
               $post_content = substr($row['post_content'], 0,50); 
               $post_status = $row['post_status'];


               if($post_status !== 'Published' || $post_date < $today) {
                   // We will display nothing for no published

               } else {
             ?>
            <!-- CLOSING PHP TAG TO DISPLAY 1 SET OF RESULTS IN THE FOLLOWING FORMAT -->

                <hr>
            <!-- First Blog Post -->
            <h2>
                <a class="hover_effect" href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a class="hover_effect"
                    href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
            </p>
           
            <?php 
               
            
            
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
               
            }  else  if($post_date == $today)  {
                ?>
                <p class="alertText"><span class='glyphicon glyphicon-time'></span><?php echo $post_date; ?> Today</p> 
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
            } else if ($threeDaysBefore == $post_date) {
                ?>
                  <p class="warningText">In 3 Days </p>
                <?php
            } 
            
            ?>
            
            <!-- <hr> -->
            <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="imgs/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>">
            </a>
            <!-- <hr> -->
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary hover_effect mb-5" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>

            <!-- <hr> -->
            <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
            <?php } }?>
        </div><!-- MARKS END OF COL-MD-8 ROW -->

        <!-- Blog Sidebar Widgets Column -->
        
        <?php include("includes/sidebar.php"); ?>
    </div>
    <!-- MARKS END OF .row -->

    <hr>
<!-- TYPED.js -->
<script src="js/typed.js"></script>
<script src="js/homepage.js"></script>
    <?php include("includes/footer.php"); ?>
