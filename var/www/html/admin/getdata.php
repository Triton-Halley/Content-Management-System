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
        echo json_encode($row);
      }
}

if(isset($_POST['setcatname'])){
    $catname = $_POST['setcatname'];
    $q = "INSERT INTO categories (cat_title)
              VALUES ('{$catname}');";

    $result = mysqli_query($connection,$q);

    if($result){
      echo GetDataFromDB($catname,$connection);
    }else{
      echo "";
    }
}

function GetDataFromDB($CatName,$conn){
  $query = "SELECT * FROM categories WHERE cat_title = '{$CatName}';";
  $query_result = mysqli_query($conn,$query);

  if($query_result) return json_encode(mysqli_fetch_assoc($query_result));
  else return "";

}

if(isset($_GET['deleteCat'])){
  $catID = $_GET['deleteCat'];
  $query = "DELETE FROM categories WHERE cat_id = '{$catID}' ;" ;

  $query_result = mysqli_query($connection,$query);

  if($query_result){
    echo ResetAutoIncrement($connection);
  }else{
    echo "falid";
  }
}
function ResetAutoIncrement($conn){
  $query = "SELECT cat_id FROM categories ORDER BY cat_id DESC LIMIT 1 ;";
  $query_result = mysqli_query($conn,$query);

  if ($query_result) {
    $row = mysqli_fetch_array($query_result);
    $n = (int) $row['cat_id']+1;
    $query = "ALTER TABLE categories AUTO_INCREMENT = {$n};";
    $query_result = mysqli_query($conn,$query);
    if($query_result) {
      echo "Succes";
    }else{
      echo "failed {$conn->error}";
    }
  }else{
    echo "failed {$conn->error}";
  }

}