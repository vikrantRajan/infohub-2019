<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">


            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small><?php echo $_SESSION['user_name']; ?></small>
                    </h1>



                </div>
            </div>
            <!-- /.row -->

            <?php if($_SESSION['user_role'] == 'Admin') {
           ?>



            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                    
                                    $query = "SELECT * FROM posts";
                                    $select_all_posts = mysqli_query(ConnectToDB::con(), $query);
                                    $post_count = mysqli_num_rows($select_all_posts);
                                    echo "<div class='huge'>{$post_count}</div>";
                                    ?>


                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                    
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query(ConnectToDB::con(), $query);
                                    $comment_count = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>{$comment_count}</div>";
                                    ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                    
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query(ConnectToDB::con(), $query);
                                    $user_count = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>{$user_count}</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                    $query = "SELECT * FROM categories";
                                    $select_all_categories = mysqli_query(ConnectToDB::con(), $query);
                                    $categories_count = mysqli_num_rows($select_all_categories);
                                    echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php

            $query = "SELECT * FROM posts WHERE post_status = 'Draft'";
            $select_all_draft_posts = mysqli_query(ConnectToDB::con(), $query);
            $post_draft_count = mysqli_num_rows($select_all_draft_posts);

            $query = "SELECT * FROM posts WHERE post_status = 'Published'";
            $select_all_published_posts = mysqli_query(ConnectToDB::con(), $query);
            $post_published_count = mysqli_num_rows($select_all_published_posts);

            $query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
            $unapproved_comments = mysqli_query(ConnectToDB::con(), $query);
            $unapproved_comments_count = mysqli_num_rows($unapproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
            $select_all_subscribers = mysqli_query(ConnectToDB::con(), $query);
            $subscribers_count = mysqli_num_rows($select_all_subscribers);
            


            ?>

            <div class="row">
                <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php 
                        
                        $element_text = ['All Posts', 'Active Posts','Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                        $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comments_count, $user_count, $subscribers_count, $categories_count];
                        for($i =0;$i < 8; $i++) {

                            echo "['{$element_text[$i]}'" . " ," . "{$element_count[$i]}],";

                        }
                        ?>
                        // ['Posts', 1000],
                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

            </div>
            <?php
            } else {
                ?>

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 
                if(isset($_GET['p_id'])){
                    $other_post_id = $_GET['p_id'];
                // $the_post_author = $_GET['author'];
                }
                $the_post_author = $_SESSION['user_name'];
                $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
                $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
                    if(mysqli_fetch_assoc($selectAllPosts) == NULL) {
                        echo "<h3>You have not created a post yet! <a href='posts.php?source=add_post'>Add Post</a></h3>";
                    } else {
                $the_post_author = $_SESSION['user_name'];
                $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
                $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
                        
                while($row = mysqli_fetch_assoc($selectAllPosts)){
                    $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_status = $row['post_status'];
                $post_content = $row['post_content']; 
                ?>
                <!-- CLOSING PHP TAG TO DISPLAY 1 SET OF RESULTS IN THE FOLLOWING FORMAT -->
                <!-- First Blog Post -->
                <h1>All Posts By <?php echo $post_author ?></h1>
                <h2>
                    <a href="../post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <?php 
                    if($post_status == 'Published'){

                      echo "<h4 class='text-success bg-success'>Status: {$post_status}</h4>";
                    } else {
                        echo "<h4 class='text-danger bg-danger'>Status: {$post_status}</h4>";
                    }
                    ?>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="../imgs/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
                <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
                <?php } 
            }?>
            </div><!-- MARKS END OF COL-MD-8 ROW -->


            <?php
            }?>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>