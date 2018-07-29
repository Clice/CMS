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

                $view_query = "UPDATE posts SET postViewsCount = postViewsCount + 1 WHERE postId = $postId";
                $send_query = mysqli_query($connection, $view_query);
                confirmQuery($send_query);

                $query = "SELECT * FROM posts WHERE postId = $postId";

                $select_post_by_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_post_by_id)) {
                    $postId = $row['postId'];
                    $postTitle = $row['postTitle'];
                    $postAuthorId = $row['postAuthorId'];
                    $postUser = $row['postUser'];
                    $postDate = $row['postDate'];
                    $postImage = $row['postImage'];
                    $postContent = $row['postContent'];
                    $postTags = $row['postTags'];
                    $postStatus = $row['postStatus'];
                    $postCommentCount = $row['postCommentCount'];
                    $postViewsCount = $row['postViewsCount'];

                    $author_query = "SELECT * FROM users WHERE userId = '$postAuthorId'";
                    $select_authors = mysqli_query($connection, $author_query);

                    while ($row2 = mysqli_fetch_assoc($select_authors)) {
                        ?>
                        <h1><?php echo $postTitle; ?></h1>
                        <p class="lead">
                            by <?php echo $row2['userFirstName'] . " " . $row2['userLastName']; ?>
                        </p>
                        <hr>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                        <hr>
                        <img class="img-responsive" src="admin/images/<?php echo $postImage; ?>" alt="">
                        <hr>
                        <p class="text-justify"><?php echo $postContent; ?></p>
                        <?php
                    }
                }
            } else {
                header("Location: index.php");
            }
            ?>
            <hr>

            <?php include "includes/comments.php"; ?>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>

    <hr>

    <?php include "includes/footer.php"; ?>
