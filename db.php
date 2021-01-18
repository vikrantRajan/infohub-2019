<?php

header('Access-Control-Allow-Origin: *');
Class ConnectToDB {
    // connect to DB
    // static function is to call function elsewhere without creating an instance of the object/class
        var $connect;
        public function __construct($connect){
            $this->con = $connect;
        }
    
        static function con() {
            
            // $conDetails = parse_ini_file("/var/www/entguide/entguide.ini");
            $conDetails = parse_ini_file("../../../entguide/entguide.ini");
          
            $connect = mysqli_connect( $conDetails['server'], $conDetails['user'], $conDetails['pass'], $conDetails['db'] ); 
            
            if(!$connect)
            {die('ERROR connecting to DB'.mysqli_connect_error());}
            return $connect;
        }
    }


?>
