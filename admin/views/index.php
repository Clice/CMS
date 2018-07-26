<?php
include "../includes/admin_header.php";
include "../includes/admin_navigation.php";
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            ['Published Posts', <?php echo num_published_posts(); ?>],
            ['Draft Posts', <?php echo num_draft_posts(); ?>],
            ['Approved Comments',  <?php echo num_approved_comments(); ?>],
            ['Disapproved Comments',  <?php echo num_disapproved_comments(); ?>],
            ['Admin Users', <?php echo num_admin_users(); ?>],
            ['Subscribers Users', <?php echo num_subs_users(); ?>],
            ['Categories', <?php echo num_categories(); ?>],
        ]);

        var options = {
            title : '',
            vAxis: {title: 'Count'},
            hAxis: {title: 'Data'},
            seriesType: 'bars'
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

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
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo num_posts(); ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php?source=view_all_posts">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo num_comments(); ?></div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php?source=view_all_comments">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo num_users(); ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php?source=view_all_users">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo num_categories(); ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div id="chart_div" style="width: 100%; height: 500px;"></div>
            </div>
        </div>

    </div>


</div>
<!-- /#page-wrapper -->

<?php include "../includes/admin_footer.php"; ?>
