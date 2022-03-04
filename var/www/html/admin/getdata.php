<?php 

if(isset($GET['getcatname'])){
    $catname = $GET['getcatname'];
    $q = "SELECT * FROM categories WHERE cat_title = '{$catname}';";
    $ali = mysqli_query($connection, $q);
    if(!$ali){
      die("Query Failed" . mysqli_error($connection));
    }
    $count = mysqli_num_rows($ali);

    if($count === 0)
      echo "empty"; 

      else{

        $row = mysqli_fetch_assoc($ali);
        //header('Content-type: application/json; charset=UTF-8');
        echo "test";
      }
  } 

