<?php

Class ConnectToDB {
    // connect to DB
    // static function is to call function elsewhere without creating an instance of the object/class
        var $connect;
        public function __construct($connect){
            $this->con = $connect;
        }
    
        static function con() {
            
<<<<<<< HEAD
            $conDetails = parse_ini_file("/var/www/entguide/entguide.ini");
=======
            // $conDetails = parse_ini_file("/var/www/entguide/entguide.ini");
            $conDetails = parse_ini_file("../../../entguide/entguide.ini");
>>>>>>> 15ab65f87f17bcc9d59e7e8c63a0a1ca6faf13cb
          
            $connect = mysqli_connect( $conDetails['server'], $conDetails['user'], $conDetails['pass'], $conDetails['db'] ); 
            
            if(!$connect)
            {die('ERROR connecting to DB'.mysqli_connect_error());}
            return $connect;
            // $oDb = new ConnectToDB($connect);
            // return $oDb;
        }
    }


?>
