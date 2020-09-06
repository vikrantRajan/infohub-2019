<?php
Class Comments {
    public static function pager() {
        
        $comment_query_count = "SELECT * FROM comments";
        $find_count = mysqli_query(ConnectToDB::con(), $comment_query_count);
        $count = mysqli_num_rows($find_count);
        $count = ceil($count / 5);
        for($i =1; $i <= $count; $i++) {
            echo "<li><a href='comments.php?page={$i}'>{$i}</a></li>";
        }

}
    public static function showComments() {
        
        

        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = "";
        }
    
        if($page == "" || $page == 1) {
    
            $page_1 = 0;
        } else {
            $page_1 = ($page * 5) - 5;
        }

        $query = "SELECT * FROM comments LIMIT $page_1, 5 ";
        $select_comments = mysqli_query(ConnectToDB::con(), $query);
        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author= $row['comment_author'];   
            $comment_content = $row['comment_content'];                             
            $comment_email = $row['comment_email'];
            $comment_status = $row['comment_status'];
            $comment_date = $row['comment_date'];
            echo "<tr>";
            if($comment_status == 'Approved') {
                echo "<td class='text-success bg-success'>{$comment_id}</td>";
                echo "<td class='text-success bg-success'>{$comment_author}</td>";
                echo "<td class='text-success bg-success'>{$comment_content}</td>";
                echo "<td class='text-success bg-success'>{$comment_email}</td>";
                echo "<td class='text-success bg-success'>{$comment_status}</td>";
    
                $query = "SELECT * from posts WHERE post_id = $comment_post_id";
                $select_post_id_query = mysqli_query(ConnectToDB::con(),$query);
                while($row = mysqli_fetch_assoc($select_post_id_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    echo "<td class='text-success bg-success'><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
                echo "<td class='text-success bg-success'>{$comment_date}</td>";
                echo "<td class='text-success bg-success'><a href='comments.php?approve=$comment_id'>Approve</a></td>";  
                echo "<td class='text-success bg-success'><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                echo "<td class='text-success bg-success'><a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='comments.php?delete=$comment_id'>Delete</a></td>";
                echo "</tr>";

            } else {

                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";
    
                $query = "SELECT * from posts WHERE post_id = $comment_post_id";
                $select_post_id_query = mysqli_query(ConnectToDB::con(),$query);
                while($row = mysqli_fetch_assoc($select_post_id_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
                echo "<td>{$comment_date}</td>";
                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";  
                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='comments.php?delete=$comment_id'>Delete</a></td>";
            }
            echo "</tr>";
        } 
        if(isset($_GET['approve'])){
            echo "<p class='text-success bg-success'>Comment Has Been Approved</p>";

        } else if(isset($_GET['unapprove'])){
            echo "<p class='text-danger bg-danger'>Comment Has Been Unapproved</p>";

        }
    }

    public static function updateComments() {
        
        if(isset($_GET['delete'])){
            $the_comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
            $delete_query = mysqli_query(ConnectToDB::con(), $query);
            
            if($delete_query) {
                echo "<h2>The comment has been deleted</h2>";
            }
            // header("location: comments.php");
        }
        
        if(isset($_GET['unapprove'])){
            $the_comment_id = $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id";
            $unapprove_comment_query = mysqli_query(ConnectToDB::con(), $query);
            // header("location: comments.php");
          
        }
        
        if(isset($_GET['approve'])){
            $the_comment_id = $_GET['approve'];
            $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
            $approve_comment_query = mysqli_query(ConnectToDB::con(), $query);
            // header("location: comments.php");
            
        }
        
        
    }
}

?>