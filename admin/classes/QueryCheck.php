<?php
Class QueryCheck {
    public static function confirmQuery($result) {
        if(!$result) {
            
            die("Query Failed") . mysqli_error(ConnectToDB::con());
        }
        
    }

}

?>