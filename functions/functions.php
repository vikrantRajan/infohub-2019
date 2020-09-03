<?php
Class Pages {

    public static function pager() {
        // global $connection;
        $post_query_count = "SELECT * FROM posts";
        $find_count = mysqli_query(ConnectToDB::con(), $post_query_count);
        $count = mysqli_num_rows($find_count);
        $count = ceil($count / 10);
        for($i =1; $i <= $count; $i++) {
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
    
    }

    public static function insertData($sql)
    {
       $con = ConnectToDB::con();
       mysqli_query($con, $sql); // give me a results object
    }
}





?>