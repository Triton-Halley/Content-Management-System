<?php include '../Includes/db.php' ?>
<!-- Header -->
<?php include '../Includes/main/header.php'?>
<!-- Navigation -->
<?php include '../Includes/main/Navigation.php'?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php

                    if(isset($_POST['submit'])){

                        $Search = htmlspecialchars($_POST['search']);

                        echo $Search ;
                        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$Search%'";
                        $search_query = mysqli_query($connection, $query);

                        if(!$search_query){

                            die("Query Failed" . mysqli_error($connection));
                        }
                        $count = mysqli_num_rows($search_query);

                        if($count == 0){
                            echo "<h1>No Result</h1>";
                        }
                        else {

                            while($row = mysqli_fetch_assoc($search_query)) {
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];

                                ?>

                                  <h1 class="page-header">
                                            Page Heading
                                            <small>Secondary Text</small>
                                        </h1>

                                        <!-- First Blog Post -->
                                        <h2>
                                            <a href="#"><?php echo $post_title ?></a>
                                        </h2>
                                        <p class="lead">
                                            by <a href="index.php"><?php echo $post_author ?></a>
                                        </p>
                                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                                        <hr>
                                        <img class="img-responsive" src="Uploads/<?php echo $post_image;?>" alt="">
                                        <hr>
                                        <p><?php echo $post_content ?></p>
                                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                        <hr>


                           <?php }


                                    }



                                    }


                        ?>












                                    </div>



                                    <!-- Blog Sidebar Widgets Column -->


                                    <?php include "../Includes/main/Sidebar.php";?>


                                </div>
                                <!-- /.row -->

                                <hr>



                        <?php include "../Includes/main/footer.php";?>
