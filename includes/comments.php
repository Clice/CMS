<?php insert_comment(); ?>

<div class="well">
    <h4>Leave a Comment:</h4>
    <form action="" method="post" role="form">
        <input type="hidden" name="commentPostId" value="<?php echo $_GET['id']; ?>">
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="commentAuthor">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="commentEmail">
        </div>
        <div class="form-group">
            <label for="comment">Your Comment</label>
            <textarea class="form-control" rows="3" name="commentContent"></textarea>
        </div>
        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->

<?php comments_list($_GET['id']); ?>