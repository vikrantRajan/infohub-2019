<?php include("DBentguide/db.php"); ?>

<?php include("includes/header.php"); ?>
<!-- NAVIGATION -->
<?php include("includes/navigation.php"); ?>
<?php include("functions/functions.php"); ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8 post_content">

            <?php 
        if(isset($_GET['p_id'])){
            $other_post_id = $_GET['p_id'];
            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$other_post_id}";
            $send_query = mysqli_query(ConnectToDB::con(), $view_query);

            if(!$send_query) {
                die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
            }
      
        $query = "SELECT * FROM posts WHERE post_id = $other_post_id";
        $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
            while($row = mysqli_fetch_assoc($selectAllPosts)){
               $post_title = $row['post_title'];
               $post_author = $row['post_author'];
               $post_date = $row['post_date'];
               $post_image = $row['post_image'];
               $post_content = $row['post_content']; 
             ?>
            <!-- CLOSING PHP TAG TO DISPLAY 1 SET OF RESULTS IN THE FOLLOWING FORMAT -->

            <!-- <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1> -->
            <?php
                if(isset($_POST['create_comment'])) {
                    $other_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];


                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES($other_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved',now())";
                    $create_comment_query = mysqli_query(ConnectToDB::con(), $query);
                        if(!$create_comment_query){
                            die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
                        }
                        else {
                            echo "<h5 class='text-success'>Thank you for leaving a comment! Upon approval the content will be displayed on our website.</h5>";
                        }
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    $query .= "WHERE post_id = $other_post_id ";
                    $update_comment_count = mysqli_query(ConnectToDB::con(), $query);
                    } else {
                        echo "<script>alert('Fields Cannot Be Empty')</script>";
                    }
                    
                    
                }

                

            }
            ?>
            <!-- First Blog Post -->
            <h2 class="page-header">
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a class="hover_effect"
                    href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $other_post_id; ?>"><?php echo $post_author; ?></a>
            </p>
            <?php 
               
               $date = date('Y-m-d');
               $today = strtotime ( '+1 hour' , strtotime ( $date ) ) ;
               $today = date ( 'Y-m-d' , $today );
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
           }  else  if($post_date == $today)  {
            ?>
            <p class="alertText"><span class='glyphicon glyphicon-time'></span><?php echo $post_date; ?> Today</p> 
            <?php
           
        } 
           
          
               
               ?>
           
            <img class="img-responsive" src="imgs/<?php echo $post_image; ?>" alt="">
           
            <p><?php echo $post_content ?></p>
            <hr>
            <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
            <?php } ?>


            <!-- Blog Comments -->



            <!-- Comments Form -->
         
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <input value="" class="form-control" name="comment_author" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <input value="xyz@gmail.com" class="form-control" type="hidden"
                            name="comment_email" readonly>
                    </div>
                    <div class="form-group">

                        <textarea name="comment_content" class="form-control" rows="3" placeholder="Comment..." required></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>


            <hr>

            <!-- Posted Comments -->
            <?php
                $query = "SELECT * FROM comments WHERE comment_post_id = {$other_post_id} ";
                $query .= "AND comment_status = 'Approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query(ConnectToDB::con(), $query);
                if(!$select_comment_query) {
                    die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
                }
                while ($row = mysqli_fetch_assoc($select_comment_query)) {
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    ?>
            <!-- Comment  -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment_author; ?>
                        <small><?php echo $comment_date; ?></small>
                    </h4>
                    <?php echo $comment_content; ?>
                </div>
            </div>

            <?php } ?>





        </div><!-- MARKS END OF COL-MD-8 ROW -->

        <!-- Blog Sidebar Widgets Column -->
        <?php include("includes/sidebar.php"); ?>
    </div>
    <!-- MARKS END OF .row -->

    <hr>

    <?php include("includes/footer.php"); ?>