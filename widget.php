<div class="well bg-dark">
    <h4>Upcoming Events</h4>
    <?php
    $query = "SELECT * FROM posts ORDER BY post_date";
    $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);

        while($row = mysqli_fetch_assoc($selectAllPosts)){
            $post_id = $row['post_id'];
           $post_title = $row['post_title'];
           $post_author = $row['post_author'];
          
           $post_date = $row['post_date'];
           $post_image = $row['post_image'];
           $post_content = substr($row['post_content'], 0,200); 
           $post_status = $row['post_status'];


           if($post_status !== 'Published') {
               // We will display nothing for no published

           } else {
     
               
               $date = date('Y-m-d');
               $today = strtotime ( '+1 hour' , strtotime ( $date ) ) ;
               $today = date ( 'Y-m-d' , $today );
               $threeDaysBefore = strtotime ( '+3 day' , strtotime ( $today ) ) ;
               $threeDaysBefore = date("Y-m-d", $threeDaysBefore);
               $twoDaysBefore = strtotime ( '+2 day' , strtotime ( $today ) ) ;
               $twoDaysBefore = date("Y-m-d", $twoDaysBefore);
               $oneDayBefore = strtotime ( '+1 day' , strtotime ( $today ) ) ;
               $oneDayBefore = date("Y-m-d", $oneDayBefore);

                if($today < $post_date)  {
                ?>
                <p class="normalText">
         <a class="hover_effect normalText" href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
         <span class='glyphicon glyphicon-time normalText'></span><?php echo $post_date; ?>
     </p>
                <?php
               
            } 
               if($oneDayBefore == $post_date) {
               ?>
                <p class="alertText">
            <a class="hover_effect alertText" href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?> </a>Tomorrow
            
        </p>
               
               <?php
           } else if ($twoDaysBefore == $post_date) {
               ?>
                 <p class="warningText">
            <a class="hover_effect warningText" href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?>  </a>In 2 Days
           
        </p>
               <?php
           } else if ($threeDaysBefore == $post_date) {
            ?>
              <p class="warningText">
         <a class="hover_effect warningText" href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?>  </a>In 3 Days
        
     </p>
            <?php
        }  else  if($post_date == date('Y-m-d'))  {
            ?>
             <p class="alertText">
            <a class="hover_effect alertText" href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            <span class='glyphicon glyphicon-time'></span><?php echo $post_date; ?> Today
        </p>
    
            <?php
           
        } else {
            
        }
           
          
               
               ?>
           
        <!-- MARKS END OF CONTENT THAT WILL BE LOOPED OVER -->
        <?php } }?>
   
</div>