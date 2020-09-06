<?php

Class Users {
    public static function usersOnline() {
        
        
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query(ConnectToDB::con(), $query);
        $count = mysqli_num_rows($send_query);

        if($count == NULL) {
            mysqli_query(ConnectToDB::con(), "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

        } else {
            mysqli_query(ConnectToDB::con(), "UPDATE users_online SET time = '$time' WHERE session = '$session'");

        }
        $users_online_query = mysqli_query(ConnectToDB::con(), "SELECT * FROM users_online WHERE time > '$time_out'");
        return $count_user = mysqli_num_rows($users_online_query);

    } 

    public static function createUser() {
        
        if(isset($_POST['create_user'])){


        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_image = $_FILES['user_image']['name'];
        // temporary file name while its stored on browser before uploading
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
          
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query(ConnectToDB::con(), $query);
        if(!$select_randsalt_query) {
            die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
        }
        
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $hashed_password = crypt($user_password, $salt);
        
            move_uploaded_file($user_image_temp, "../imgs/$user_image");
        $query = "INSERT INTO users(
            user_firstname,
            user_lastname,
            user_role,
            username,
            user_email,
            user_image,
            user_password)";
        $query .= "VALUES(
            '{$user_firstname}',
            '{$user_lastname}',
            '{$user_role}',
            '{$username}',
            '{$user_email}',
            '{$user_image}',
            '{$hashed_password}')";    
        
            $createUserQuery = mysqli_query(ConnectToDB::con(), $query);
            //   echo($query);
            //   die;
            QueryCheck::confirmQuery($createUserQuery);
        
            echo "<p class='text-success'>User Created: <a href='users.php'>View Users</a></p>";
          
          }
    }

    public static function editUser() {
        
        if(isset($_GET['edit_user'])){
            $the_user_id = $_GET['edit_user'];
           $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                $select_users_query = mysqli_query(ConnectToDB::con(), $query);
                while($row = mysqli_fetch_assoc($select_users_query)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];   
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];                              
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    $user_role = $row['user_role'];
                    $userInfo = $row;
                }
                
        }
        
        if(isset($_POST['edit_user'])){
        
          
          $user_firstname = $_POST['user_firstname'];
          $user_lastname = $_POST['user_lastname'];
          $user_role = $_POST['user_role'];
          $user_image = $_FILES['user_image']['name'];
          // temporary file name while its stored on browser before uploading
          $user_image_temp = $_FILES['user_image']['tmp_name'];
          $username = $_POST['username'];
          $user_email = $_POST['user_email'];
        //   $user_password = $_POST['user_password'];
          $user_password = (isset($_POST['user_password']) ? $_POST['user_password'] : false);
        //   $post_date = date('d-m-y');
        //   $post_comment_count = 0;
          
          
            // move_uploaded_file($user_image_temp, "../imgs/$user_image");
          $query = "SELECT randSalt FROM users";
          $select_randsalt_query = mysqli_query(ConnectToDB::con(), $query);
          if(!$select_randsalt_query) {
              die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
          }
        
          $row = mysqli_fetch_array($select_randsalt_query);
          $salt = $row['randSalt'];
          $hashed_password = ($user_password) ? crypt($user_password, $salt) : false;
          
        
            $query = "UPDATE users SET ";
            $query .="user_firstname = '{$user_firstname}'";
            $query .=", user_lastname = '{$user_lastname}'";
            $query .=", user_role = '{$user_role}'";
            $query .=", user_image = '{$user_image}'";
            $query .=", username = '{$username}'";
            $query .=", user_email = '{$user_email}'";
            $query .= ($hashed_password) ? ", user_password = '{$hashed_password}' " : "";
            $query .=" WHERE user_id = {$the_user_id} "; 
        
            // echo $query;
            // die;
            $edit_user_query = mysqli_query(ConnectToDB::con(), $query);
            QueryCheck::confirmQuery($edit_user_query);
        
            header('location: users.php?success=updatedUserInfo');
        
        }
         return $userInfo; 
    }

    public static function userPage() {
        
        if(isset($_GET['success'])){
            $success = $_GET['success'];
        } else {
            $success = '';
        }

        switch($success) {
            case 'updatedUserInfo';
            echo "<h4 class='text-success'>Update Successful</h4>";
            break;
        }

        if(isset($_GET['source'])){
            $source = $_GET['source'];
        } else {
            $source = '';
        }

        switch($source) {

            case 'add_user';
            include "includes/add_user.php";
            break;

            case 'edit_user';
            include "includes/edit_user.php";
            break;


            default:
            // 
            include "includes/view_all_users.php";
            break;
        }
    }

    public static function updateProfile() {
        
        if(isset($_SESSION['user_name'])) {
            $username = $_SESSION['user_name'];
            $query = "SELECT * FROM users WHERE username = '{$username}'";
            $select_user_profile_query = mysqli_query(ConnectToDB::con(), $query);
            while($row = mysqli_fetch_array($select_user_profile_query)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];   
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];                              
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                $profileInfo = $row;
            }
        
        }
        if(isset($_POST['edit_user'])){
        
          
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $user_image = $_FILES['user_image']['name'];
            // temporary file name while its stored on browser before uploading
            $user_image_temp = $_FILES['user_image']['tmp_name'];
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
          //   $post_date = date('d-m-y');
          //   $post_comment_count = 0;
            
            
              // move_uploaded_file($user_image_temp, "../imgs/$user_image");
            
            
          
              $query = "UPDATE users SET ";
              $query .="user_firstname = '{$user_firstname}', ";
              $query .="user_lastname = '{$user_lastname}', ";
              $query .="user_role = '{$user_role}', ";
              $query .="user_image = '{$user_image}', ";
              $query .="username = '{$username}', ";
              $query .="user_email = '{$user_email}', ";
              $query .="user_password = '{$user_password}' ";
              $query .="WHERE username = '{$username}' ";
          
              $edit_user_query = mysqli_query(ConnectToDB::con(), $query);
              QueryCheck::confirmQuery($edit_user_query);
              header('location: users.php?success=updatedUserInfo');
          
          }
          return $profileInfo;
    } 

    public static function showAllUsers() {
        
        $query = "SELECT * FROM users";
        $select_users = mysqli_query(ConnectToDB::con(), $query);
        while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];   
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];                              
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";  
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>"; 
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        } 
    }

    public static function updateUser() {
        
        if(isset($_GET['delete'])){
            $the_user_id = $_GET['delete'];
        
            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_user_query = mysqli_query(ConnectToDB::con(), $query);
            
            // if($delete_query) {
            //     echo "<h2>The comment has been deleted</h2>";
            // }
            header("location: users.php");
        }
        
        if(isset($_GET['change_to_sub'])){
            $the_user_id = $_GET['change_to_sub'];
        
            $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id";
            $change_to_sub_query = mysqli_query(ConnectToDB::con(), $query);
            
            // if($approve_comment_query) {
            //     echo "<h2>The comment has been approved</h2>";
            // }
            header("location: users.php");
        }
        
        if(isset($_GET['change_to_admin'])){
            $the_user_id = $_GET['change_to_admin'];
        
            $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $the_user_id";
            $change_to_admin_query = mysqli_query(ConnectToDB::con(), $query);
            
            // if($approve_comment_query) {
            //     echo "<h2>The comment has been approved</h2>";
            // }
            header("location: users.php");
        }
    }
}

?>