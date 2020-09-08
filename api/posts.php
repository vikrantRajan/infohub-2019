<?php include("../DBentguide/db.php"); 

        if(isset($_GET['p_id'])){
            $other_post_id = $_GET['p_id'];
            $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$other_post_id}";
            $send_query = mysqli_query(ConnectToDB::con(), $view_query);

            if(!$send_query) {
                die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
            }
      
        $query = "SELECT * FROM posts as p,categories as ct WHERE p.post_id = $other_post_id and p.post_status='Published' and p.post_category_id=ct.cat_id";
        $selectAllPosts = mysqli_query(ConnectToDB::con(), $query); 
            while($row = mysqli_fetch_assoc($selectAllPosts)){
                $data['post_id'] = $row['post_id'];
                $data['title'] = $row['post_title'];
                $data['author'] = $row['post_author'];
                $data['catId'] = $row['cat_id'];
                $data['category'] = $row['cat_title'];
                  $data['date'] = $row['post_date'];
                $data['image'] = $row['post_image'];
                $data['post_content'] = $row['post_content'];
                $data['post_status'] = $row['post_status'];
                $data['commentCount'] = $row['post_comment_count'];
                $fh = fopen($data['post_content'],'r');
                $string = fread($fh,filesize($data['post_content']));
                $data['content'] = $string;
                fclose($fh);
            }

            $commentQuery = "SELECT * from comments where comment_post_id=$other_post_id and comment_status='Approved'";
            $comments = mysqli_query(ConnectToDB::con(), $commentQuery); 
            while($comment = mysqli_fetch_assoc($comments)){
                $data['comments'][] = $comment;
            }
            print_r(json_encode($data));
        }
             ?>