<?php 
if($_SESSION['user_role'] == 'Admin') {
    ?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php Users::showAllUsers();?>
    </tbody>
</table>
<?php Users::updateUser(); ?>
<?php
}
?>