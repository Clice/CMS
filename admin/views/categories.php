<?php
include "../includes/admin_header.php";
include "../includes/admin_navigation.php";
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Categories
                    <small>Subheading</small>
                </h1>

                <div class="col-xs-6">

                    <?php insert_category(); ?>

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="categoryTitle">Add Category</label>
                            <input type="text" class="form-control" name="addCategoryTitle">                			
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Add Categoty">
                        </div>
                    </form>  

                    <?php update_category(); ?>
                </div>

                <div class="col-xs-6">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            find_all_categories();
                            delete_category();
                            ?>
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

<?php include "../includes/admin_footer.php"; ?>