<?php

Class Posts 
{
    public static function pager() {
        
        $post_query_count = "SELECT * FROM posts";
        $find_count = mysqli_query(ConnectToDB::con(), $post_query_count);
        $count = mysqli_num_rows($find_count);
        $count = ceil($count / 5);
        for($i =1; $i <= $count; $i++) {
            echo "<li><a href='posts.php?page={$i}'>{$i}</a></li>";
        }

}
    public static function showPosts() {
        
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

        $query = "SELECT * FROM posts  LIMIT $page_1, 5 ";
        $select_posts = mysqli_query(ConnectToDB::con(), $query);
        while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_views_count = $row['post_views_count'];
        echo "<tr>";
        ?>
<td><input class='checkBoxes' id='selectAllBoxes' type='checkbox' name='checkBoxArray[]'
        value='<?php echo $post_id; ?>'></td>
<?php
        if($post_status == 'Published') {

            echo "<td class='text-success bg-success'>{$post_id}</td>";
            echo "<td class='text-success bg-success'>{$post_author}</td>";
            echo "<td class='text-success bg-success'>{$post_title}</td>";
            $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
            $selectCategoriesID = mysqli_query(ConnectToDB::con(), $query);
                while($row = mysqli_fetch_assoc($selectCategoriesID)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<td class='text-success bg-success'>{$cat_title}</td>";
                }
            // echo "<td>{$post_category_id}</td>";
            echo "<td class='text-success bg-success'>{$post_status}</td>";
            echo "<td class='text-success bg-success'><img width='100' src='../imgs/{$post_image}' alt='Entguide'></td>";
            echo "<td class='text-success bg-success'>{$post_tags}</td>";
            echo "<td class='text-success bg-success'>{$post_comment_count}</td>";
            echo "<td class='text-success bg-success'>{$post_date}</td>";
            echo "<td class='text-success bg-success'><a onClick=\"javascript: return confirm('Are you sure you want to reset the view count for {$post_title}?');\" href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";  
            echo "<td class='text-success bg-success'><a href='../post.php?p_id={$post_id}'>View Post</a></td>"; 
            echo "<td class='text-success bg-success'><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";  
            echo "<td class='text-success bg-success'><a onClick=\"javascript: return  confirm('Are you sure you want to delete this?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";

        } else {

            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";
            $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
            $selectCategoriesID = mysqli_query(ConnectToDB::con(), $query);
                while($row = mysqli_fetch_assoc($selectCategoriesID)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<td>{$cat_title}</td>";
                }
            // echo "<td>{$post_category_id}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../imgs/{$post_image}' alt='Entguide'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";  
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset the view count for {$post_title}?');\" href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>"; 
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>"; 
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";  
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
        }
        echo "</tr>";
        } 
    }

    public static function bulkCheckPosts() 
    {
        
        if(isset($_POST['checkBoxArray']))
        {
            
            foreach($_POST['checkBoxArray'] as $postIdValue) 
            {
            $bulkOptions = $_POST['bulk_options'];

            switch($bulkOptions) {
                case 'reset';
                // $reset_post_id = $_GET['reset'];
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string(ConnectToDB::con(), $postIdValue) . " ";
                $reset_query = mysqli_query(ConnectToDB::con(), $query);
                QueryCheck::confirmQuery($reset_query);
                echo "<p class='text-success bg-success'>Post View Count Reset</p>";
                    break;

                case 'Published';
            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postIdValue} ";
            $update_published_status = mysqli_query(ConnectToDB::con(), $query);
            QueryCheck::confirmQuery($update_published_status);
            echo "<p class='text-success bg-success'>Post Published</p>";
                break;

                case 'Draft';
            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postIdValue} ";
            $update_draft_status = mysqli_query(ConnectToDB::con(), $query);
            QueryCheck::confirmQuery($update_draft_status);
            echo "<p class='text-success bg-success'>Post Updated</p>";
                break;

                case 'delete';
            $query = "DELETE FROM posts WHERE post_id = {$postIdValue} ";
            $delete_status = mysqli_query(ConnectToDB::con(), $query);
            QueryCheck::confirmQuery($delete_status);
            echo "<p class='text-success bg-success'>Post Deleted</p>";
                break;


            }
            }
            
        }
    }
    public static function resetPostViews() 
    {
         
        if(isset($_GET['reset']))
        {
        // $reset_post_id = $_GET['reset'];
        // $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string(ConnectToDb::con(), $reset_post_id) . " ";
        // $reset_query = mysqli_query(ConnectToDb::con(), $query);
        // print_r($reset_query);
        // die;
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string(ConnectToDB::con(), $postIdValue) . " ";
                $reset_query = mysqli_query(ConnectToDB::con(), $query);
                QueryCheck::confirmQuery($reset_query);
                echo "<p class='text-success bg-success'>Post View Count Reset</p>";
        header('location: posts.php');
        }
    }

    public static function deletePosts() 
    {
        
        if(isset($_GET['delete']))
        {
        $delete_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
        $delete_query = mysqli_query(ConnectToDB::con(), $query);
        header('location: posts.php');
        }
    }

    public static function updatePosts() 
    {
        
        
        if(isset($_GET['p_id'])){
            $edit_post_id = $_GET['p_id'];
        }
        $query = "SELECT * FROM posts WHERE post_id = $edit_post_id";
        $select_posts_id = mysqli_query(ConnectToDB::con(), $query);
        
        while($row = mysqli_fetch_assoc($select_posts_id)){
           
            $post_id = $row['post_id'];
           $post_author = $row['post_author'];
           $post_title = $row['post_title'];
           $post_category_id = $row['post_category_id'];
           $post_status = $row['post_status'];
           $post_image = $row['post_image'];
           $post_tags = $row['post_tags'];
           $post_content = $row['post_content'];
           $post_comment_count = $row['post_comment_count'];
           $post_date = $row['post_date'];
           $post_views_count = $row['post_views_count'];
           $fh = fopen($post_content,'r');
           $data = fread($fh,filesize($post_content));
           fclose($fh);
           $row['content'] = $data;
           $arrUpdatePosts = $row;
           
        }

        
        if(isset($_POST['update_post'])){
            $postPath = $post_content;
          $post_title = $_POST['post_title'];
          $post_category_id = $_POST['post_category'];
          $post_author = $_POST['post_author'];
          $post_status = $_POST['post_status'];
          $post_image = $_FILES['post_image']['name'];
          // temporary file name while its stored on browser before uploading
          $post_image_temp = $_FILES['post_image']['tmp_name'];
          $post_tags = $_POST['post_tags'];
          $post_views_count = $_POST['post_views_count'];
          $post_date = $_POST['post_date'];
          $post_content = mysqli_real_escape_string(ConnectToDB::con(), $_POST['post_content']);
          move_uploaded_file($post_image_temp, "../imgs/$post_image");
          // If the image field is empty then we check the database to see if there is an image and let the same image remain
          if(empty($post_image)){
              $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";
              $select_image = mysqli_query(ConnectToDB::con(), $query);
              while($row = mysqli_fetch_assoc($select_image)){
                  $post_image = $row['post_image'];
              }
          }
          $fileName = fopen($postPath, "w") or die("Unable to open file!");
          fwrite($fileName, $post_content);
            fclose($fileName);
        
            $query = "UPDATE posts SET ";
            $query .="post_title = '{$post_title}', ";
            $query .="post_category_id = '{$post_category_id}', ";
            $query .="post_views_count = '{$post_views_count}', ";
            $query .="post_date = '{$post_date}', ";
            $query .="post_author = '{$post_author}', ";
            $query .="post_status = '{$post_status}', ";
            $query .="post_tags = '{$post_tags}', ";
            $query .="post_content = '{$postPath}', ";
            $query .="post_image = '{$post_image}' ";
            $query .="WHERE post_id = {$edit_post_id} ";
        $update_post = mysqli_query(ConnectToDB::con(),$query);
        QueryCheck::confirmQuery($update_post);
        if($update_post){
             echo "<p class='text-success bg-success'>Post Updated: <a href='../post.php?p_id={$edit_post_id}'>View Post</a> Or <a href='posts.php'>Edit More Posts</a></p>";
        }
        }
        
        return $arrUpdatePosts;
        
    }

    
    
    public static function showPostStatus() {
        
        $query = "SELECT * FROM posts";
        
        $select_posts_id = mysqli_query(ConnectToDB::con(), $query);
        while($row = mysqli_fetch_assoc($select_posts_id)){
            $post_status = $row['post_status'];
            
        }
        if($post_status == 'Published') {
            echo "<option value='Draft'>Draft</option>";
        } else {
            echo "<option value='Published'>Published</option>";
        }
        


}

public static function createPosts() {

if(isset($_POST['create_post'])){

$post_title = $_POST['post_title'];
$post_category_id = $_POST['post_category'];
$post_author = $_POST['post_author'];
$post_status = $_POST['post_status'];
$post_image = $_FILES['post_image']['name'];
// temporary file name while its stored on browser before uploading
$post_image_temp = $_FILES['post_image']['tmp_name'];
$post_tags = $_POST['post_tags'];
$post_content =  mysqli_real_escape_string(ConnectToDB::con(), $_POST['post_content']); 
$post_date = $_POST['post_date'];;
$post_comment_count = 0;
$title = rand(0,10000)."_".$post_title;
$postFilePath = "../posts/".$title.".txt";
$fileName = fopen($postFilePath, "w") or die("Unable to open file!");
fwrite($fileName, $post_content);
  fclose($fileName);

move_uploaded_file($post_image_temp, "../imgs/$post_image");
$query = "INSERT INTO posts(
post_category_id,
post_title,
post_author,
post_date,
post_image,
post_content,
post_tags,
post_comment_count,
post_views_count,
post_status)";
$query .= "VALUES(
'{$post_category_id}',
'{$post_title}',
'{$post_author}',
now(),
'{$post_image}',
'{$postFilePath}',
'{$post_tags}',
'{$post_comment_count}',
0,
'{$post_status}')";

$postQuery = mysqli_query(ConnectToDB::con(), $query);
// echo($query);
// die;
QueryCheck::confirmQuery($postQuery);
$the_post_id = mysqli_insert_id(ConnectToDB::con());
echo "<p class='text-success bg-success'>Post Added: <a href='../post.php?p_id={$the_post_id}'>View Post</a> Or <a
        href='posts.php'>Edit More Posts</a></p>";


}
}
}


?>