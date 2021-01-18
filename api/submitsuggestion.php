<?php include("../DBentguide/db.php"); 
$post = json_decode(file_get_contents('php://input'), true);
    $content = $post['content'];
    echo $content;
    $query = "INSERT INTO suggestions (content,posteddate)";
    $query .= "VALUES('{$content}',now())";
    $create_comment_query = mysqli_query(ConnectToDB::con(), $query);

        if(!$create_comment_query){
            die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
        }
        else {
            echo 1;
        }
    
    
?>
