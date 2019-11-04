<?php 
if($_SESSION['user_role'] == 'Admin') {
?>
<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Update Category</label>
        <?php Categories::updateCategories(); ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update">
    </div>
</form>
<?php
}
?>