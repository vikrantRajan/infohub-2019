<?php include "includes/admin_header.php" ?>
<?php
include("classes/RunSQL.php");
?>
<link rel="stylesheet" href="css/viewcontact.css">
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
    <?php include("includes/admin_navigation.php") ?>
    <div id="table">
        <!--    <a href="countryForm.php" class="btn">Add Record..</a>-->
        <div id="cooltable">
            <?php
    $arrFields = array(
      "strFirstName", 
      "strLastName", 
      "strEmail", 
      "nPhone",
      "strMessage",
      "utcDatems");
    GlobalFunctions::showTableHeader($arrFields);
      
    $sortTable = !empty($_GET['sort'])?$_GET['sort']:'utcDatems';
    $sql  = "SELECT * FROM contact ORDER BY ".$sortTable;
    GlobalFunctions::showData($sql, $arrFields);
    

    ?>

        </div>
    </div>
</div>
<?php include "includes/admin_footer.php" ?>