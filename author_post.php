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
        if(isset($_GET['p_id'])){
            $other_post_id = $_GET['p_id'];
            $the_post_author = $_GET['author'];
        }
        echo "<h1 class='page-header'>All Posts By {$the_post_author}</h1>";
        $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
        $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
            while($row = mysqli_fetch_assoc($selectAllPosts)){
                $post_id = $row['post_id'];
               $post_title = $row['post_title'];
               $post_author = $row['post_author'];
               $post_date = $row['post_date'];
               $post_image = $row['post_image'];
               $post_content = $row['post_content']; 
               $post_status = $row['post_status'];
                if($post_status != 'Published') {

                } else {

               

             ?>
            <!-- CLOSING PHP TAG TO DISPLAY 1 SET OF RESULTS IN THE FOLLOWING FORMAT -->
            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
            </h2>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
           
            <img class="img-responsive" src="imgs/<?php echo $post_image; ?>" alt="">
         
            <p><?php echo $post_content ?></p>
            <hr>
            <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
            <?php }  }?>
        </div><!-- MARKS END OF COL-MD-8 ROW -->

        <!-- Blog Sidebar Widgets Column -->
        <?php include("includes/sidebar.php"); ?>
    </div>
    <!-- MARKS END OF .row -->

    <hr>

    <?php include("includes/footer.php"); ?>
