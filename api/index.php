<?php 
include("../DBentguide/db.php"); 
$configs = include("../DBentguide/config.php"); 

$canvasUrl = $configs['canvasUrl'];
$token = $configs['token'];
 $ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, $canvasUrl."/courses");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$token,"X-Requested-With : XMLHttpRequest"));

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $output contains the output string
$output = curl_exec($ch);

$result = (array) json_decode($output);

foreach($result as $element1) {
   if($element1 -> default_view != 'wiki' && $element1 -> id != 55848) {
   $id = $element1 -> id;
   $name = $element1 -> name;
   curl_setopt($ch, CURLOPT_URL, $canvasUrl."/courses/".$id."/assignments");
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '.$token,"X-Requested-With : XMLHttpRequest"));
   
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   //return the transfer as a string
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   // $output contains the output string
   $output1 = curl_exec($ch);
   
   $result1 = (array) json_decode($output1);
   // print_r(json_encode($result1));

   foreach($result1 as $assignment) {
      if($assignment -> due_at) {
   
         $today_dt = new DateTime();
         $datee = explode("T",$assignment -> due_at);
         $due_dt = new DateTime($datee[0]);
   if($due_dt > $today_dt) {
      $row['author'] = 'Canvas';
      $row['catId'] = '2';
      $row['category'] = $name;
      $row['image'] = 'assignment.png';
      // $row['post'] = $assignment -> description;
      $row['courseId'] = $assignment -> id;
      $row['post'] = 'Click to view the assignment in canvas';
      $row['title'] = $assignment -> name;
      $row['url'] = $assignment -> html_url;
      
      $row['commentCount'] = $assignment -> points_possible;
      // $duedtTime = rtrim($assignment -> due_at, 'Z');
      // $due_dt = str_replace("T"," ",$duedtTime);
      $row['due_dt'] = $due_dt;
      $array['posts'][] =  $row;
   } 
}else {
   $row['author'] = 'Canvas';
   $row['catId'] = '2';
   $row['category'] = $name;
   $row['image'] = 'assignment.png';
   $row['post'] = 'Click to view the assignment in canvas';
   $row['courseId'] = $assignment -> id;
   $row['title'] = $assignment -> name;
   $row['commentCount'] = $assignment -> points_possible;
   $row['due_dt'] = '';
   $row['url'] = $assignment -> html_url;
   $array['posts'][] =  $row;
}
}
}
}

function myTruncate($input, $numwords){
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
   // if($output != $input) $output .= $padding;
    return $output;
  }
 $query = "SELECT * FROM posts as p,categories as c where p.post_category_id=c.cat_id AND p.post_status='Published'";
 $selectAllPosts = mysqli_query(ConnectToDB::con(), $query);
            
 while($row = mysqli_fetch_assoc($selectAllPosts)){
                $data['post_id'] = $row['post_id'];
                $postId = $data['post_id'];
                $comment = "SELECT count(*) as commentCount FROM comments where comment_post_id=$postId and comment_status='Approved'";
                $comments = mysqli_query(ConnectToDB::con(), $comment);
                while($row1 = mysqli_fetch_assoc($comments)){ 
                  $data['commentCount'] = $row1['commentCount'];
               }
               $data['title'] = $row['post_title'];
               $data['author'] = $row['post_author'];
               $data['catId'] = $row['cat_id'];
               $data['category'] = $row['cat_title'];
               $data['date'] = $row['post_date'];
               $data['image'] = $row['post_image'];
               $data['post_content'] = $row['post_content'];
               $data['post_status'] = $row['post_status'];
               $fh = fopen($data['post_content'],'r');
               $string = fread($fh,filesize($data['post_content']));
               fclose($fh);
               $blog = strip_tags($string);
               $str = myTruncate($blog,rand(30,50));
               $data['post'] = $str;
               $array['posts'][] = $data;
            }

            $catquery = "SELECT * FROM categories";
            $selectAllcat = mysqli_query(ConnectToDB::con(), $catquery);
                       
            while($catrow = mysqli_fetch_assoc($selectAllcat)){
                          $array['categories'][] = $catrow;
                       }
            print_r(json_encode($array));

            ?>
