<?php
// Getting my secure DB Connection 
include("DBentguide/db.php"); 
include("functions/functions.php");
// Running the Insert SQL statement
$sqlInsert = "INSERT INTO contact (
        strFirstName,
        strLastName,
        strEmail,
        nPhone,
        strMessage,
        utcDatems)  
    VALUES (
        '".$_POST['strFirstName']."',
        '".$_POST['strLastName']."',
        '".$_POST['strEmail']."',
        '".$_POST['nPhone']."',
        '".$_POST['strMessage']."',
        '".time()."')";


        // print_r($sqlInsert);
        // die;
        Pages::insertData($sqlInsert);
header("Location: contact.php?success=savedContactData");
?>
