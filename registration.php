<?php include("DBentguide/db.php"); ?>
<?php  include "includes/header.php"; ?>

<?php
// print_r($_SERVER);
// die; 

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($username) && !empty($email) && !empty($password)){

        $username = mysqli_real_escape_string(ConnectToDB::con(), $username);
        $email = mysqli_real_escape_string(ConnectToDB::con(), $email);
        $password = mysqli_real_escape_string(ConnectToDB::con(), $password);
    
        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query(ConnectToDB::con(), $query);
        if(!$select_randsalt_query) {
            die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
        }
    
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];
        $password = crypt($password, $salt);
    
        $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}', '{$email}', '{$password}', 'Subscriber' )";
        $register_user_query = mysqli_query(ConnectToDB::con(), $query);
        if(!$register_user_query) {
            die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
        } else {
            echo "<h5 class='text-success text-center bg-success'>Registration has been submitted</h5>";
    
        }
    } else {
        echo "<h5 class='text-error text-center bg-error'>Fields Cannot Be Empty</h5>";

    }


    
}

 ?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="heading_registration">
                        <h1 class='page-header'>Registration</h1>
                        
                    </div>
                    <div class="form-wrap">
                      
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block"
                                value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>



