<?php
update_post();

if (isset($_GET['id'])) {
    $data = find_post($_GET['id']);
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="postId" value="<?php echo $data['postId']; ?>">
        <input type="hidden" name="postCommentCount" value="<?php echo $data['postCommentCount']; ?>">
        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="postTitle" value="<?php echo $data['postTitle']; ?>">
        </div>
        <div class="form-group">
            <label for="category">Post Category</label>
            <select class="form-control" name="postCategoryId" id="">
                <option value="0">Select</option>
                <?php select_categories($data['postCategoryId']); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="author">Post Author</label>
            <input type="text" class="form-control" name="postAuthor" value="<?php echo $data['postAuthor']; ?>">
        </div>
        <div class="form-group">
            <label for="post_status">Post Status</label>
            <select class="form-control" name="postStatus" id="">
                <option value="0">Select</option>
                <option value="Draft" <?php if ($data['postStatus'] == 'Draft') { echo 'selected'; }?>>Draft</option>
                <option value="Published" <?php if ($data['postStatus'] == 'Published') { echo 'selected'; }?>>Published</option>
            </select>
        </div>
        <div class="form-group">
            <label for="post_image">Post Image</label><br>
            <img src="../images/<?php echo $data['postImage']; ?>" alt="" width="100">
            <input type="file" name="postImage">
        </div>
        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input type="text" class="form-control" name="postTags" value="<?php echo $data['postTags']; ?>">
        </div>
        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" name="postContent" id="body" cols="30" rows="10"><?php echo $data['postContent']; ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
        </div>
    </form>
<?php } ?>