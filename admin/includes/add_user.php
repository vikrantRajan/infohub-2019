<?php 
if($_SESSION['user_role'] == 'Admin') {
?>
<?php Users::createUser(); ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="user_firstname" />
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" />
    </div>
    <div class="form-group">
        <select name="user_role" id="">
            <option value="Subscriber">Select Options</option>
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>


    <div class="form-group">
        <label for="title">User Image</label>
        <input type="file" name="user_image" />
    </div>

    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username" />
    </div>

    <div class="form-group">
        <label for="post_category">Email</label>
        <input type="email" class="form-control" name="user_email" />
    </div>

    <div class="form-group">
        <label for="post_category">Password</label>
        <input type="password" class="form-control" name="user_password" />
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User" />
    </div>
</form>
<?php
}
?>