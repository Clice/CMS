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
                    Comments
                    <small>Subheading</small>
                </h1>

                <?php include "comments/view_all_comments.php"; ?>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "../includes/admin_footer.php"; ?>