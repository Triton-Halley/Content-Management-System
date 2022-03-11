<?php

include_once '../../Includes/db.php';
//Get
if (isset($_GET['getcatname'])) {
  $catname = $_GET['getcatname'];
  $q = "SELECT * FROM categories WHERE cat_title = '{$catname}';";
  $ali = mysqli_query($connection, $q);
  if (!$ali) {
    die("Query Failed" . mysqli_error($connection));
  }
  $count = mysqli_num_rows($ali);

  if ($count === 0)
    echo "empty";

  else {

    $row = mysqli_fetch_assoc($ali);
    //header('Content-type: application/json; charset=UTF-8');
    echo json_encode($row);
  }
}
//Insert
if (isset($_POST['setcatname'])) {
  $catname = $_POST['setcatname'];
  $q = "INSERT INTO categories (cat_title)
              VALUES ('{$catname}');";

  $result = mysqli_query($connection, $q);

  if ($result) {
    echo GetDataFromDB($catname, $connection);
  } else {
    echo "";
  }
}

function GetDataFromDB($CatName, $conn)
{
  $query = "SELECT * FROM categories WHERE cat_title = '{$CatName}';";
  $query_result = mysqli_query($conn, $query);

  if ($query_result) return json_encode(mysqli_fetch_assoc($query_result));
  else return "";
}
//Delete Cat
if (isset($_GET['deleteCat'])) {
  $catID = $_GET['deleteCat'];
  $query = "DELETE FROM categories WHERE cat_id = '{$catID}' ;";

  $query_result = mysqli_query($connection, $query);

  if ($query_result) {
    echo ResetAutoIncrement($connection);
  } else {
    echo "falid";
  }
}
// Update Cat
if (isset($_POST['Catname']) && isset($_POST['CatId'])) {
  $cat = $_POST['Catname'];
  $catId = $_POST['CatId'];
  $query = "UPDATE categories SET cat_title = '{$cat}'
  WHERE cat_id = '{$catId}';";

  $result = mysqli_query($connection, $query);
  if ($result) {
    echo 'true';
  } else {
    echo 'false';
  }
}
function ResetAutoIncrement($conn)
{
  $query = "SELECT cat_id FROM categories ORDER BY cat_id DESC LIMIT 1 ;";
  $query_result = mysqli_query($conn, $query);

  if ($query_result) {
    $row = mysqli_fetch_array($query_result);
    writelog($row);
    if ($row != null) {
      $n = (int) $row['cat_id'] + 1;
      $query_result = alterColumn($n, $conn);
      if ($query_result) {
        echo "Succes";
      } else {
        echo "failed {$conn->error}";
      }
    } else {
      $query_result = alterColumn(0, $conn);
      if ($query_result) {
        echo "Succes";
      } else {
        echo "failed {$conn->error}";
      }
    }
  } else {
    echo "failed {$conn->error}";
  }
}


function alterColumn($num, $conn1)
{
  $query = "ALTER TABLE categories AUTO_INCREMENT = {$num};";
  $query_result = mysqli_query($conn1, $query);

  return $query_result;
}




function writelog($txt)
{
  $filename_log = "log.txt";
  if ($txt != null) {
    $txt['cat_id'] = $txt['cat_id'] + 1;
  } else {
    $txt = "null";
  }

  $handel = fopen($filename_log, 'w');
  if ($handel) {
    fwrite($handel, $txt);
  }
  fclose($handel);
}
