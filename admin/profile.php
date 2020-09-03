<?php include "includes/admin_header.php" ?>
<?php
$row = Users::updateProfile();

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];   
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];                              
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

?>


<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Profile</h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">First Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_firstname; ?>"
                                name="user_firstname" />
                        </div>
                        <div class="form-group">
                            <label for="title">Last Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_lastname; ?>"
                                name="user_lastname" />
                        </div>
                        <?php if($_SESSION['user_role'] == 'Admin') {
                        ?>

                        <div class="form-group">
                            <select name="user_role" id="" value="<?php echo $user_role; ?>">
                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php
                                if($user_role == 'Admin') {
                                echo "<option value='Subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='Admin'>Admin</option>";
                                }
                            ?>
                                <!-- <option value="admin">Admin</option>
                                <option value="subscriber">Subscriber</option> -->
                            </select>
                        </div>


                        <?php
                            }?>


                        <div class="form-group">
                            <label for="title">User Image</label>
                            <input type="file" name="user_image" value="<?php echo $user_image; ?>" />
                        </div>

                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                        </div>

                        <div class=" form-group">
                            <label for="post_category">Email</label>
                            <input type="email" class="form-control" name="user_email"
                                value="<?php echo $user_email; ?>" />
                        </div>

                        <span id="editPassword">
                            <button class="btn btn-success" style="margin: 0 0 20px 0" onClick=addInput();>Change
                                Password</button>
                        </span>

                        <div class=" form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include("includes/admin_footer.php"); ?>