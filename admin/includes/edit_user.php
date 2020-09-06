<?php
$editUser = Users::editUser();

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" value="<?php echo $editUser['user_firstname']; ?>"
            name="user_firstname" />
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $editUser['user_lastname']; ?>"
            name="user_lastname" />
    </div>
    <div class="form-group">
        <select name="user_role" id="" value="<?php echo $editUser['user_role']; ?>">
            <option value="<?php echo $editUser['user_role']; ?>"><?php echo $editUser['user_role']; ?></option>
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


    <div class="form-group">
        <label for="title">User Image</label>
        <input type="file" name="user_image" value="<?php echo $editUser['user_image']; ?>" />
    </div>

    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $editUser['username']; ?>" />
    </div>

    <div class=" form-group">
        <label for="post_category">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $editUser['user_email']; ?>" />
    </div>

    <span id="editPassword">
        <button class="btn btn-success" style="margin: 0 0 20px 0" onClick=addInput();>Change Password</button>
    </span>
    <div class=" form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User" />
    </div>
</form>