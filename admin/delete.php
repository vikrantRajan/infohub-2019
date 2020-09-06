<?php
include("../includes/db.php");
include("classes/RunSQL.php");

GlobalFunctions::deleteData("contact", $_GET["id"]);
header("location: viewcontact.php");
?>