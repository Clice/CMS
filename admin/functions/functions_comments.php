<?php

function insert_comment() {
    global $connection;

    if (isset($_POST['create_comment'])) {
        $commentAuthor = $_POST['commentAuthor'];
        $commentEmail = $_POST['commentEmail'];
        $commentContent = $_POST['commentContent'];
        $commentPostId = $_POST['commentPostId'];

        if (!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent) && empty($commentPostId)) {
            add_comment_count($commentPostId);
            $query = "INSERT INTO comments(commentAuthor, commentEmail, commentContent, commentPostId, commentStatus, commentDate) ";
            $query .= "VALUES('$commentAuthor', '$commentEmail', '$commentContent', $commentPostId, 'Disapproved', now())";
            $create_comment_query = mysqli_query($connection, $query);
            confirmQuery($create_comment_query);
            echo "<div class='alert alert-success' role='alert'>Comment created successfully.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Fields cannot be empty.</div>";
        }
    }
}

function find_all_comments() {
    global $connection;
    $query = "SELECT * FROM comments";
    $select_comments = mysqli_query($connection, $query);
    confirmQuery($select_comments);

    while ($row = mysqli_fetch_assoc($select_comments)) {
        $commentId = $row['commentId'];
        $data = find_post($row['commentPostId']);
        $commentPostId = $data['postTitle'];
        $commentAuthor = $row['commentAuthor'];
        $commentContent = $row['commentContent'];
        $commentEmail = $row['commentEmail'];
        $commentStatus = $row['commentStatus'];
        $commentDate = $row['commentDate'];
        ?>
        <tr>
            <td><?php echo $commentId; ?></td>
            <td><?php echo $commentAuthor; ?></td>
            <td><?php echo $commentContent; ?></td>
            <td><?php echo $commentEmail; ?></td>
            <td><?php echo $commentStatus; ?></td>
            <td><a href="../../post.php?id=<?php echo $row['commentPostId']; ?>"><?php echo $commentPostId; ?></a></td>
            <td><?php echo $commentDate; ?></td>
            <td><a href="comments.php?source=view_all_comments&approve=<?php echo $commentId; ?>">Approve</a></td>
            <td><a href="comments.php?source=view_all_comments&disapprove=<?php echo $commentId; ?>">Disapprove</a></td>
            <td><a href="comments.php?source=view_all_comments&delete=<?php echo $commentId; ?>&id=<?php echo $row['commentPostId']; ?>">Delete</a></td>
        </tr>
        <?php
    }
}

function delete_comment() {
    global $connection;

    if (isset($_GET['delete'])) {
        $commentId = $_GET['delete'];
        $query = "DELETE FROM comments WHERE commentId = $commentId";
        $delete_query = mysqli_query($connection, $query);
        confirmQuery($delete_query);
        sub_comment_count($_GET['id']);
        header("Location: comments.php");
    }
}

function approve_comment() {
    global $connection;

    if (isset($_GET['approve'])) {
        $commentId = $_GET['approve'];
        $query = "UPDATE comments SET commentStatus = 'Approved' WHERE commentId = $commentId";
        $approve_query = mysqli_query($connection, $query);
        confirmQuery($approve_query);
        header("Location: comments.php");
    }
}

function disapprove_comment() {
    global $connection;

    if (isset($_GET['disapprove'])) {
        $commentId = $_GET['disapprove'];
        $query = "UPDATE comments SET commentStatus = 'Disapproved' WHERE commentId = $commentId";
        $disapprove_query = mysqli_query($connection, $query);
        confirmQuery($disapprove_query);
        header("Location: comments.php");
    }
}

function comments_list($postId) {
    global $connection;

    if (isset($postId)) {
        $query = "SELECT * FROM comments WHERE commentPostId = $postId AND commentStatus = 'Approved' ORDER BY commentId DESC";
        $select_comments_by_post_id = mysqli_query($connection, $query);
        confirmQuery($select_comments_by_post_id);

        while ($row = mysqli_fetch_assoc($select_comments_by_post_id)) {
            $commentAuthor = $row['commentAuthor'];
            $commentContent = $row['commentContent'];
            $commentDate = $row['commentDate'];
            ?>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $commentAuthor; ?>
                        <small><?php echo $commentDate; ?></small>
                    </h4>
                    <?php echo $commentContent; ?>
                </div>
            </div>
            <?php
        }
    }
}

function num_comments() {
    global $connection;
    $query = "SELECT * FROM comments";
    $select_all_comments = mysqli_query($connection, $query);
    confirmQuery($select_all_comments);
    $num_comments = mysqli_num_rows($select_all_comments);
    return $num_comments;
}

function num_approved_comments() {
    global $connection;
    $query = "SELECT * FROM comments WHERE commentStatus = 'Approved'";
    $select_all_approved_comments = mysqli_query($connection, $query);
    confirmQuery($select_all_approved_comments);
    $num_approved_comments = mysqli_num_rows($select_all_approved_comments);
    return $num_approved_comments;
}

function num_disapproved_comments() {
    global $connection;
    $query = "SELECT * FROM comments WHERE commentStatus = 'Disapproved'";
    $select_all_disapproved_comments = mysqli_query($connection, $query);
    confirmQuery($select_all_disapproved_comments);
    $num_disapproved_comments = mysqli_num_rows($select_all_disapproved_comments);
    return $num_disapproved_comments;
}