<?php 
    Class Categories extends QueryCheck
    {
        
        public static function insertCategories() {
            
            if(isset($_POST['submit'])) {
                $catTitle = $_POST['cat_title'];
        
                if($catTitle == "" || empty($catTitle)) {
                    echo "<h3>This Field Should Not Be Empty</h3>";
                } else {
                    $query = "INSERT INTO categories(cat_title) ";
                    $query .= "VALUE('{$catTitle}')";
                    $createCategory = mysqli_query(ConnectToDB::con(), $query);
        
                    if(!$createCategory) {
                        die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
                    }
                }
            }
        }
    
        public static function findAllCategories() {
            
            $query = "SELECT * FROM categories";
            $selectCategories = mysqli_query(ConnectToDB::con(), $query);
    
           while($row = mysqli_fetch_assoc($selectCategories)){
               $cat_id = $row['cat_id'];
               $cat_title = $row['cat_title'];
               echo "<tr>";
               echo "<td>{$cat_id}</td>";
               echo "<td>{$cat_title}</td>";
               echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    
               echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
               echo "</tr>";
           }   
    
        }
    
        public static function deleteCategories() {
            
            if(isset($_GET['delete'])){
                $catID = $_GET['delete'];
            $query = "DELETE FROM categories WHERE cat_id = {$catID}";
            $deleteQuery = mysqli_query(ConnectToDB::con(), $query);
            header("Location: categories.php");
            }
        }

        public static function editCategories() {
            // UPDATE AND INCLUDE QUERY
            
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                include "includes/update_categories.php";
            }  
        }

        public static function updateCategories() {
            
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
                $selectCategoriesID = mysqli_query(ConnectToDB::con(), $query);
                while($row = mysqli_fetch_assoc($selectCategoriesID)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    ?>
<input value="<?php if(isset($cat_title)){echo $cat_title;} ?> " type="text" class="form-control" name="cat_title">
<?php }   }?>

<?php
            if(isset($_POST['update_category'])){
                $catTitle = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title = '{$catTitle}' WHERE cat_id = {$cat_id} ";
                $updateQuery = mysqli_query(ConnectToDB::con(), $query);
                header("Location: categories.php");
                if(!$updateQuery){
                    die("QUERY FAILED" . mysqli_error(ConnectToDB::con()));
                }
            }
        }

        public static function checkCategoryStatus() {
            
            
            $query = "SELECT * FROM categories";
            $selectCategories = mysqli_query(ConnectToDB::con(), $query);
            QueryCheck::confirmQuery($selectCategories);
            return $selectCategories;
            
        }

    }

    

    
?>