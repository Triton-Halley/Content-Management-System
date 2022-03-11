<?php

$source = '';
if (isset($_GET['source'])) {
    $source = $_GET['source'];
}

switch ($source) {

    case 'view-post';
        include "../../Includes/admin/view_all_posts.php";
        break;

    case 'add-post';
        include "../../Includes/admin/addPost.php";
        break;

    default;
        include "./index.php";
        break;
}
