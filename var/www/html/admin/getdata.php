<?php
include_once '../../Includes/db.php';
if(isset($_GET['getcatname'])){
    $catname = $_GET['getcatname'];
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

if(isset($_POST['setcatname'])){
    $catname = $_POST['setcatname'];
    $q = "INSERT INTO categories (cat_title)
              VALUES ('{$catname}');";

    mysqli_query($connection,$q);
}