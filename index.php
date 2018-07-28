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
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if (($page == "") || ($page == 1)) {
                $page_1 = 0;
            } else {
                $page_1 = (($page * 5) - 5);
            }

            $post_query_count = "SELECT * FROM posts WHERE postStatus = 'Published'";
            $find_count = mysqli_query($connection, $post_query_count);
            $count = mysqli_num_rows($find_count);
            $count = ceil($count/5);


            $query = "SELECT * FROM posts WHERE postStatus = 'Published' LIMIT $page_1,5";
            $select_all_posts_query = mysqli_query($connection, $query);

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
                    by <a href="author_post.php?author=<?php echo $postAuthor; ?>"><?php echo $postAuthor; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                <hr>
                <a href="post.php?id=<?php echo $postId; ?>"><img class="img-responsive" src="admin/images/<?php echo $postImage; ?>" alt=""></a>
                <hr>
                <p class="text-justify"><?php echo $postContent . "..."; ?></p>
                <a class="btn btn-primary" href="post.php?id=<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php } ?>
            <hr>

        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>

    <hr>
    <ul class="pager">
        <?php for ($i = 1; $i < $count; $i++) {
            if ($i == $page) { ?>
                <li><a class="active_link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } else { ?>
                <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php }
        }?>
    </ul>

    <?php include "includes/footer.php"; ?>
