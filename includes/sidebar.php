<div class="col-md-4 sidebar_padding">

<ul class="pagination">
            <?php Pages::pager();  ?>
        </ul>
    <!-- Blog Search Well -->
    <div class="well bg-dark">
        <h4>Search</h4>
        <form action="search.php" method="post" >
            <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="eg. 'homework', 'events', 'workshops'">
                <span class="input-group-btn">

                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
            <!-- /.input-group -->
        </form> <!-- SEARCH FORM -->
    </div>


    <!-- LOGIN FORM -->
    <div class="well bg-dark">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input placeholder="Enter Username" name="username" type="text" class="form-control">

            </div>
            <!-- /.input-group -->
            <div class="input-group">
                <input placeholder="Enter Password" name="password" type="password" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button></span>
            </div>
            <!-- /.input-group -->
        </form> <!-- LOGIN FORM -->
    </div>




    <!-- Blog Categories Well -->
    <div class="well bg-dark">

        <?php 
                $query = "SELECT * FROM categories";
                $selectSideBarCategories = mysqli_query(ConnectToDB::con(), $query);
                ?>
        <h4>What, When, Where</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                    while($row = mysqli_fetch_assoc($selectSideBarCategories)){
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";

                    }
                    ?>
                </ul>
            </div>



            <!-- /.col-lg-6 -->

        </div>
        <!-- /.row -->
    </div>
    <!-- /.well -->

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>