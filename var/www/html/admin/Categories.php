 <?php include "../../Includes/admin/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "../../Includes/admin/Navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php 
                              echo "asdasd";
                            ?>
                            <small>Author</smal l>
                        </h1>
                          <div class="col-xs-6">
                            <form class="" action="" method="post">
                              <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input id ="cat-name" class="form-control" type="text" name="cat_title" required>
                              </div>
                              <div class="form-group">
                                <input id="add-cat" class="btn btn-primary" value="Add Category">
                              </div>
                            </form>
                          </div>
                          <div class="col-xs-6">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Category Title</th> 
                              </tr>
                            </thead>
                            <tbody id="tablebody">
                              
                                <?php 
                        
                                  $query = "SELECT * FROM categories";
                                  $select_all_categories_query = mysqli_query($connection, $query);

                                  while($row = mysqli_fetch_assoc($select_all_categories_query))
                                  {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    ?>
                                    <tr>
                                      <?php
                                      echo "<td>{$cat_id}</td>";
                                      echo "<td>{$cat_title}</td>";
                                      ?>
                                    </tr>  
                                  <?php } ?>              
                                
                              
                            </tbody> 
                          </table>
                          </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include '../../Includes/admin/footer.php' ?>

        <?php 
        
            if(isset($_POST['setcatname'])){
              $catname = $_POST['setcatname'];
              $q = "INSERT INTO categories (cat_title)
              VALUES ('{$catname}');";

              mysqli_query($connection,$q);
            }

            if(isset($_POST['getcatname'])){
              $catname = $_POST['getcatname'];
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
                  echo $row;
                }
            } 

        
        ?>