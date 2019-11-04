<?php

Class GlobalFunctions {
    static function getData($sql)
    {
      
      //$con = ConnectToDB::con();
      //$result = mysqli_query($con, $sql);
      // give me a results object;
        
      return ConnectToDB::con()->query($sql);
    }
    
    
    static function insertData($sql)
    {
       $con = ConnectToDB::con();
       mysqli_query($con, $sql); // give me a results object
    }
    
    static function deleteData($table, $id)
{
    $con = ConnectToDB::con();
    mysqli_query($con, "DELETE FROM $table WHERE id='".$id."'");
}
    
    static function showTomorrowDate()
    {
      $time = mktime(0, 0, 0, date("m"), date("d")+1, date("Y")); //h, min, s, month
      return date('l jS \of F Y',$time)."<br>";
    }
    
    static function outputData($sql)
    {
      $data = array();
      $con = ConnectToDB::con();
      $result = mysqli_query($con, $sql);
      
      while($row = mysqli_fetch_assoc($result)) {
          $data[] = $row;
      }
    
      return $data;
    }
    static function showTableHeader($arrFields)
    {
        if(isset($_GET['sort'])) {
            $_GET['sort'] = $_GET['sort'];
        } else {
            $_GET['sort'] = '';
        }
        ?>
<div class="thead row">

    <?php
        
        foreach($arrFields as $fieldName)
        {            
            $active = ($fieldName == $_GET['sort'])?'active':'';?>
    <div class="chead <?=$active?>"><a href="?sort=<?=$fieldName?>"><?=$fieldName?></a></div>
    <?php 
        }?>


    <div class="chead">Delete</div>
</div>
<?php
}
static function showData($sql, $arrFields)
{
//   $result = getData($sql);
   $result = self::outputData($sql);
   // If I have contact details to view then do the following:
    if(!empty($result)){
        // For each contact (name,email,phone etc.) make one row & call it user
        foreach($result as $user)
        {
?>
<div class="trow row">
    <?php   // for each individual piece of data, make a cell in the table
            foreach($user as $fieldName => $fieldValue){
            // If my field name is NOT id then make a cell, otherwise dont
                if($fieldName != 'id'){
           // while looping over the array, if field = Date then format it using gmdate in the following order - 1 Jan 2019. Else print the next field in the array. ?>
    <div>
        <?=($fieldName=='utcDatems')?gmdate('d M Y', $fieldValue):$fieldValue;?>
    </div>
    <?php 
                }
            }
    ?>
    <div>
        <a href="delete.php?id=<?=$user["id"]?>">Delete</a>
    </div>
</div>
<?php
        }
   } else {
       echo '<h2>There are no records to show</h2>';
   }
   
}



}


?>