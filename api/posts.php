<?php include("../DBentguide/db.php"); 

        if(isset($_GET['p_id'])){
            $other_post_id = $_GET['p_id'];
            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$other_post_id}";
            $send_query = mysqli_query(ConnectToDB::con(), $view_query);

            if(!$send_query) {
                die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
            }
      
        $query = "SELECT * FROM posts as p,comments as c WHERE p.post_id = $other_post_id and c.comment_post_id=$other_post_id and p.post_status='Published'";
        $selectAllPosts = mysqli_query(ConnectToDB::con(), $query); 
            while($row = mysqli_fetch_assoc($selectAllPosts)){
               $post_title = $row['post_title'];
               $post_author = $row['post_author'];
               $post_date = $row['post_date'];
               $post_image = $row['post_image'];
               $post_content = $row['post_content']; 
            }
        }
             ?>