<?php
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- Blog Post -->

            <!-- Title -->
            <?php
            if (isset($_GET['id'])) {
                $postId = $_GET['id'];

                $query = "SELECT * FROM posts WHERE postId = $postId";

                $select_post_by_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_post_by_id)) {
                    $postId = $row['postId'];
                    $postTitle = $row['postTitle'];
                    $postAuthor = $row['postAuthor'];
                    $postUser = $row['postUser'];
                    $postDate = $row['postDate'];
                    $postImage = $row['postImage'];
                    $postContent = $row['postContent'];
                    $postTags = $row['postTags'];
                    $postStatus = $row['postStatus'];
                    $postCommentCount = $row['postCommentCount'];
                    $postViewsCount = $row['postViewsCount'];
                    ?>
                    <h1><?php echo $postTitle; ?></h1>

                    <!-- Author -->
                    <p class="lead">
                        by <a href="#"><?php echo $postAuthor; ?></a>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>

                    <hr>

                    <!-- Preview Image -->
                    <img class="img-responsive" src="admin/images/<?php echo $postImage; ?>" alt="">

                    <hr>

                    <!-- Post Content -->
                    <p class="text-justify"><?php echo $postContent; ?></p>
                    <?php
                }
            }
            ?>
            <hr>

            <?php include "includes/comments.php"; ?>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>

    <hr>

    <?php include "includes/footer.php"; ?>
