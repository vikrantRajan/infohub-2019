<?php include("../DBentguide/db.php"); 
$post = json_decode(file_get_contents('php://input'), true);
    $other_post_id = $post['p_id'];
    $comment_author = $post['author'];
    $comment_email = $post['email'];
    $comment_content = $post['comment'];

    
    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
    $query .= "WHERE post_id = $other_post_id ";
    $update_comment_count = mysqli_query(ConnectToDB::con(), $query);

    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
    $query .= "VALUES($other_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved',now())";
    $create_comment_query = mysqli_query(ConnectToDB::con(), $query);
        if(!$create_comment_query){
            echo 0;
        }
        else {
            echo 1;
        }
    
    
?>
