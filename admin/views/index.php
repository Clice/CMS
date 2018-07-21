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
                    Welcome to Admin Panel
                    <small><?php echo $_SESSION['userFirstName'] . " " . $_SESSION['userLastName']; ?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "../includes/admin_footer.php"; ?>