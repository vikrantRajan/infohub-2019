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
// If the user clicks submit
if(isset($_POST['submit'])){
    // setting the words the user typed in the search bar to this variable
$search = $_POST['search'];
    // Checking for the posts tags on the posts table that match the search  
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
  // connect to the database and run the query
  $searchQuery = mysqli_query(ConnectToDB::con(), $query);
  // if for some reason the mysqli_query() fails then the error message displays
  if(!$searchQuery){
      echo 'no query';
      die("Failed Query" . mysqli_error(ConnectToDB::con()));
  }
  // counting the characters entered in the search bar and matching it with the database
  $count = mysqli_num_rows($searchQuery);
  // if nothing matches with the info in the database then there aren't any results to show 
  if($count == 0) {
      echo "<h1>NO RESULT</h1>";
  } else {
        // using the while loop to fetch an associative array from the query, then separating each row and looping over it untill all the data is pulled
        while($row = mysqli_fetch_assoc($searchQuery)){
           $post_title = $row['post_title'];
           $post_author = $row['post_author'];
          
           $post_date = $row['post_date'];
           $post_image = $row['post_image'];
           $post_content = $row['post_content']; 
          
         ?>
            <!-- CLOSING PHP TAG TO DISPLAY 1 SET OF RESULTS IN THE FOLLOWING FORMAT -->
           
            <!--  Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
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
           
            <img class="img-responsive" src="imgs/<?php echo $post_image; ?>" alt="">
            
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
            <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
            <?php } // Opening the php tag starts the loop again until here
            } // end of else statement
            } // end of $_POST['submit]

            ?>
        </div><!-- MARKS END OF COL-MD-8 ROW WHERE ALL DYNAMIC DATA IS STORED-->
        <!-- Blog Sidebar Widgets Column -->
        <?php include("includes/sidebar.php"); ?>
    </div>
    <!-- MARKS END OF .row -->

    <?php include("includes/footer.php"); ?>
