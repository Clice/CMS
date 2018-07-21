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

            <?php
            $query = "SELECT * FROM posts WHERE postStatus = 'published'";

            $select_all_posts_query = mysqli_query($connection, $query);

            if ($select_all_posts_query->num_rows == 0) {
                ?>
                <h1 class="text-center">SORRY! NO POSTS.</h1>
                <?php
            }

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $postId = $row['postId'];
                $postTitle = $row['postTitle'];
                $postAuthor = $row['postAuthor'];
                $postUser = $row['postUser'];
                $postDate = $row['postDate'];
                $postImage = $row['postImage'];
                $postContent = substr($row['postContent'], 0, 100);
                $postTags = $row['postTags'];
                $postStatus = $row['postStatus'];
                $postCommentCount = $row['postCommentCount'];
                $postViewsCount = $row['postViewsCount'];
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?id=<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                <hr>
                <img class="img-responsive" src="admin/images/<?php echo $postImage; ?>" alt="">
                <hr>
                <p class="text-justify"><?php echo $postContent . "..."; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <?php } ?>
            <hr>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php"; ?>
