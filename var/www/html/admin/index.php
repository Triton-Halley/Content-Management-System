<?php include "../../Includes/admin/header.php" ?>
<?php include "../../Includes/admin/EditPopup.php"; ?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "../../Includes/admin/Navigation.php" ?>
    <div id="overlay"></div>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>


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
                    }


                    ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include '../../Includes/admin/footer.php' ?>