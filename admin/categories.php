<?php
include "includes/admin_header.php";
?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php
include "includes/admin_navigation.php";

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WELCOME TO ADMIN
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">

                            <?php 
                            insert_categories();
                            
                            ?>


                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>

                            </form>

                            <?php //UPDATE AND INCLUDE QUERY 
                            if(isset($_GET['update'])){
                                $cat_id = escape($_GET['update']); 

                                include "includes/update_categories.php";
                                

                            }
                            ?>


                        </div><!-- Add Category Form -->

                        <div class="col-xs-6">

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 

                                     findAllcategories();
                                    ?>

                                    <?php 
                                    
                                    deleteAllcategories();
                                    
                                    ?>
                                    <!--<tr>
                                        
                                        <td>Basketball Category</td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                        <!--<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>-->
                    </div>
                </div>
                <!-- /.row -->

            </div>


            <!-- /.container-fluid -->

        </div>



        <!-- /#page-wrapper -->



<?php include "includes/admin_footer.php";?>
