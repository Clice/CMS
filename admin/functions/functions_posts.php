<?php

function insert_post() {
    global $connection;

    if (isset($_POST['create_post'])) {
        $postTitle = $_POST['postTitle'];
        $postAuthor = $_POST['postAuthor'];
        $postCategoryId = $_POST['postCategoryId'];
        $postStatus = $_POST['postStatus'];
        $postImage = $_FILES['postImage']['name'];
        $auxPostImage = $_FILES['postImage']['tmp_name'];
        $postTags = $_POST['postTags'];
        $postContent = $_POST['postContent'];
        $postCommentCount = 0;

        move_uploaded_file($auxPostImage, "../images/$postImage");
        $query = "INSERT INTO posts(postTitle, postAuthor, postCategoryId, postStatus, postImage, postTags, postContent, postDate, postCommentCount) ";
        $query .= "VALUES('$postTitle', '$postAuthor', $postCategoryId, '$postStatus', '$postImage', '$postTags', '$postContent', now(), $postCommentCount)";
        $create_post_query = mysqli_query($connection, $query);
        confirmQuery($create_post_query);
        $postId = mysqli_insert_id($connection);

        echo "<div class='alert alert-success' role='alert'>Post Created. <a href='../../post.php?id=$postId'>View Post</a> or <a href='posts.php?source=view_all_posts'>Edit More Posts.</a></div>";
    }
}

function update_post() {
    global $connection;

    if (isset($_POST['update_post'])) {
        $postId = $_POST['postId'];
        $postTitle = $_POST['postTitle'];
        $postAuthor = $_POST['postAuthor'];
        $postCategoryId = $_POST['postCategoryId'];
        $postStatus = $_POST['postStatus'];
        $postImage = $_FILES['postImage']['name'];
        $auxPostImage = $_FILES['postImage']['tmp_name'];
        $postTags = $_POST['postTags'];
        $postContent = $_POST['postContent'];
        $postCommentCount = $_POST['postCommentCount'];

        move_uploaded_file($auxPostImage, "../images/$postImage");
        $postImage = emptyImage($postImage, $postId);
        $query = "UPDATE posts SET postTitle = '$postTitle', postAuthor = '$postAuthor', postCategoryId = $postCategoryId, postStatus = '$postStatus', ";
        $query .= "postImage = '$postImage', postTags = '$postTags', postContent = '$postContent', postDate = now(), postCommentCount = $postCommentCount ";
        $query .= "WHERE postId = $postId";
        $update_post_query = mysqli_query($connection, $query);
        confirmQuery($update_post_query);

        echo "<div class='alert alert-success' role='alert'>Post Updated: <a href='../../post.php?id=$postId'>View Post</a> or <a href='posts.php?source=view_all_posts'>Edit More Posts.</a></div>";
    }
}

function find_all_posts() {
    global $connection;
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);
    confirmQuery($select_posts);

    while ($row = mysqli_fetch_assoc($select_posts)) {
        $postId = $row['postId'];
        $postAuthor = $row['postAuthor'];
        $postTitle = $row['postTitle'];
        $postCategoryId = find_category_by_id($row['postCategoryId']);
        $postStatus = $row['postStatus'];
        $postImage = $row['postImage'];
        $postTags = $row['postTags'];
        $postCommentCount = $row['postCommentCount'];
        $postDate = $row['postDate'];
        ?>
        <tr>
            <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $postId; ?>"></td>
            <td><?php echo $postId; ?></td>
            <td><?php echo $postAuthor; ?></td>
            <td><a href="../../post.php?id=<?php echo $postId;?>"><?php echo $postTitle; ?></a></td>
            <td><?php echo $postCategoryId; ?></td>
            <td><?php echo $postStatus; ?></td>
            <td><img src="../images/<?php echo $postImage; ?>" alt="image" width="100"></td>
            <td><?php echo $postTags; ?></td>
            <td><?php echo $postCommentCount; ?></td>
            <td><a href="posts.php?source=view_all_posts&publish=<?php echo $postId; ?>">Publish</a></td>
            <td><?php echo $postDate; ?></td>
            <td><a href="posts.php?source=edit_post&id=<?php echo $postId; ?>">Edit</a></td>
            <td><a href="posts.php?source=view_all_posts&delete=<?php echo $postId; ?>">Delete</a></td>
        </tr>
        <?php
    }
}

function find_post($postId) {
    global $connection;
    $query = "SELECT * FROM posts WHERE postId = $postId";
    $select_post = mysqli_query($connection, $query);
    confirmQuery($select_post);

    while ($row = mysqli_fetch_assoc($select_post)) {
        $data['postId'] = $row['postId'];
        $data['postAuthor'] = $row['postAuthor'];
        $data['postTitle'] = $row['postTitle'];
        $data['postCategoryId'] = $row['postCategoryId'];
        $data['postStatus'] = $row['postStatus'];
        $data['postImage'] = $row['postImage'];
        $data['postTags'] = $row['postTags'];
        $data['postContent'] = $row['postContent'];
        $data['postCommentCount'] = $row['postCommentCount'];
        $data['postDate'] = $row['postDate'];
    }

    return $data;
}

function delete_post() {
    global $connection;

    if (isset($_GET['delete'])) {
        $postId = $_GET['delete'];
        $query = "DELETE FROM posts WHERE postId = $postId";
        $delete_query = mysqli_query($connection, $query);
        confirmQuery($delete_query);
        header("Location: posts.php?source=view_all_posts");
    }
}

function publish_post() {
    global $connection;

    if (isset($_GET['publish'])) {
        $postId = $_GET['publish'];
        echo $postId;
        $query = "UPDATE posts SET postStatus = 'Published' ";
        $query .= "WHERE postId = $postId";
        $publish_post = mysqli_query($connection, $query);
        confirmQuery($publish_post);
        header("Location: posts.php?source=view_all_posts");
    }
}

function add_comment_count($postId) {
    global $connection;
    $query = "UPDATE posts SET postCommentCount = postCommentCount + 1 ";
    $query .= "WHERE postId = $postId";
    $add_comment_count = mysqli_query($connection, $query);
    confirmQuery($add_comment_count);
}

function sub_comment_count($postId) {
    global $connection;
    $query = "UPDATE posts SET postCommentCount = postCommentCount - 1 ";
    $query .= "WHERE postId = $postId";
    $sub_comment_count = mysqli_query($connection, $query);
    confirmQuery($sub_comment_count);
}

function emptyImage($postImage, $postId) {
    if (empty($postImage)) {
        global $connection;
        $query = "SELECT * FROM posts WHERE postId = $postId";
        $select_image = mysqli_query($connection, $query);
        confirmQuery($select_image);

        while ($row = mysqli_fetch_array($select_image)) {
            $postImage = $row['postImage'];
        }
    }
    return $postImage;
}

function num_posts() {
    global $connection;
    $query = "SELECT * FROM posts";
    $select_all_posts = mysqli_query($connection, $query);
    confirmQuery($select_all_posts);
    $num_posts = mysqli_num_rows($select_all_posts);
    return $num_posts;
}

function num_published_posts() {
    global $connection;
    $query = "SELECT * FROM posts WHERE postStatus = 'Published'";
    $select_all_published_posts = mysqli_query($connection, $query);
    confirmQuery($select_all_published_posts);
    $num_published_posts = mysqli_num_rows($select_all_published_posts);
    return $num_published_posts;
}

function num_draft_posts() {
    global $connection;
    $query = "SELECT * FROM posts WHERE postStatus = 'Draft'";
    $select_all_draft_posts = mysqli_query($connection, $query);
    confirmQuery($select_all_draft_posts);
    $num_draft_posts = mysqli_num_rows($select_all_draft_posts);
    return $num_draft_posts;
}

function update_status($bulkOptions, $postId) {
    global $connection;
    $query = "UPDATE posts SET postStatus = '$bulkOptions' WHERE postId = $postId";
    $update_status = mysqli_query($connection, $query);
    confirmQuery($update_status);
}

function delete_post_table($postId) {
    global $connection;
    $query = "DELETE FROM posts WHERE postId = $postId";
    $delete_query = mysqli_query($connection, $query);
    confirmQuery($delete_query);
}