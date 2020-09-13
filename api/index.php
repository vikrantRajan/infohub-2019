<?php include("../DBentguide/db.php"); 

function myTruncate($input, $numwords){
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
   // if($output != $input) $output .= $padding;
    return $output;
  }
 $query = "SELECT * FROM posts as p,categories as c where p.post_category_id=c.cat_id";
 $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
            
 while($row = mysqli_fetch_assoc($selectAllPosts)){
                $data['post_id'] = $row['post_id'];
                $postId = $data['post_id'];
                $comment = "SELECT count(*) as commentCount FROM comments where comment_post_id=$postId and comment_status='Approved'";
                $comments = mysqli_query(ConnectToDB::con(), $comment);
                while($row1 = mysqli_fetch_assoc($comments)){ 
                  $data['commentCount'] = $row1['commentCount'];
               }
               $data['title'] = $row['post_title'];
               $data['author'] = $row['post_author'];
               $data['catId'] = $row['cat_id'];
               $data['category'] = $row['cat_title'];
               $data['date'] = $row['post_date'];
               $data['image'] = $row['post_image'];
               $data['post_content'] = $row['post_content'];
               $data['post_status'] = $row['post_status'];
               $fh = fopen($data['post_content'],'r');
               $string = fread($fh,filesize($data['post_content']));
               fclose($fh);
               $blog = strip_tags($string);
               $str = myTruncate($blog,rand(30,50));
               $data['post'] = $str;
               $array['posts'][] = $data;
            }

            $catquery = "SELECT * FROM categories";
            $selectAllcat = mysqli_query(ConnectToDB::con(), $catquery);
                       
            while($catrow = mysqli_fetch_assoc($selectAllcat)){
                          $array['categories'][] = $catrow;
                       }
            print_r(json_encode($array));

            ?>
