<?php Posts::createPosts(); ?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="post_title" required>
    </div>

    <div class="form-group">
        <select name="post_category" id="" required>
            <option value="">Select Category</option>
            <?php $selectCategories = Categories::checkCategoryStatus();
            
            while($row = mysqli_fetch_assoc($selectCategories)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                $category = ($arrUpdatePosts['post_category_id'] == $cat_id) ? 'selected' : '';
                echo "<option value='{$cat_id}' {$category}>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author (edit your profile to change your name)</label>

        <input value="<?php echo $_SESSION['user_name']; ?>" type="text" class="form-control" name="post_author"
            readonly >
    </div>
    <div class="form-group">
        <select name="post_status" id="" required>
            <option value="">Post Status</option>
            <option value='Draft'>Draft</option>
            <option value='Published'>Published</option>
        </select>
        <!-- <label for="title">Post Status</label>
        <input type="text" class="form-control" name="post_status" /> -->
    </div>
    <div class="form-group">
        <label for="title">Image (Please use images that are 1000px X 500px)</label>
        <input type="file" name="post_image" >
    </div>

    <div class="form-group">
        <label for="title">Search Engine Tags (used by the search engine to find)</label>
        <input type="text" class="form-control" name="post_tags" required >
    </div>
    
    <div class="form-group">
        <label for="title">When is it happening?</label>
        <input type="text" class="form-control" name="post_date" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" title="Please type the correct format YYYY-MM-DD" required >
    </div>

    <div class="form-group">
        <label for="post_category">What is it about?</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10" id="body" ></textarea>
    </div>


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post" >
    </div>
</form>