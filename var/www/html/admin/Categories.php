<?php include "../../Includes/admin/header.php" ?>
<?php include "../../Includes/admin/EditPopup.php";?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "../../Includes/admin/Navigation.php" ?>

        <div id="page-wrapper" >

            <div class="container-fluid" style="background-color:rgba(0,0,0,0.005);">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>Author</small>
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
                                <th>Delete</th> 
                                <th>Update</th> 
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
                                      echo "<td><button id='del-btn' class='btn btn-danger' value='{$cat_id}' >Delete</button></td>";
                                      echo "<td><button id='update-btn' class='btn' value='{$cat_id}' >Update</button></td>";
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
