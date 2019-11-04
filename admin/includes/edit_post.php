<?php

$arrUpdatePosts = Posts::updatePosts();

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $arrUpdatePosts['post_title']; ?>" type="text" class="form-control"
            name="post_title" required/>
    </div>


    <div class="form-group">
        <select name="post_category" id="" required>
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
        <label for="title">Post Author</label>
        <input value="<?php echo $arrUpdatePosts['post_author']; ?>" type="text" class="form-control"
            name="post_author" required/>
    </div>
    <div class="form-group">
        <select name="post_status" id="" required>
            <option value='<?php echo $arrUpdatePosts['post_status']; ?>'><?php echo $arrUpdatePosts['post_status']; ?> 
            </option>
            <?php 
            // Posts::showPostStatus(); 
            if($arrUpdatePosts['post_status'] == 'Published') {
                echo "<option value='Draft'>Draft</option>";
            } else {
                echo "<option value='Published'>Published</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
    <label for="title">Please use images that are 1000px X 500px</label>

        <img width="100" src="../imgs/<?php echo $arrUpdatePosts['post_image']; ?>">
        <input type="file" name="post_image" >
    </div>

    <div class="form-group">
        <label for="title">Search Engine Tags</label>
        <input value="<?php echo $arrUpdatePosts['post_tags']; ?>" type="text" class="form-control" name="post_tags" required/>
    </div>

    <div class="form-group">
        <label for="title">Post View Count</label>
        <input value="<?php echo $arrUpdatePosts['post_views_count']; ?>" type="text" class="form-control"
            name="post_views_count" readonly />
        <a onClick="javascript: return confirm('Are you sure you want to reset the views for <?=$arrUpdatePosts['post_title']?>?');"
            href='posts.php?reset=<?php echo $arrUpdatePosts['post_id']; ?>'>Reset Views Count</a>
    </div>

    <div class="form-group">
        <label for="title">When is it happening?</label>
        <input type="text" class="form-control" name="post_date" value="<?php echo $arrUpdatePosts['post_date']; ?>" placeholder="YYYY-MM-DD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" title="Please type the correct format YYYY-MM-DD" required >
    </div>

    <div class="form-group">
        <label for="post_category">Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"
            id="body" required><?php echo $arrUpdatePosts['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post" />
    </div>
</form>