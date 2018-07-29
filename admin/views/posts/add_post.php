<?php insert_post(); ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="postTitle">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select class="form-control" name="postCategoryId" id="">
            <option value="0">Select</option>
            <?php select_categories(0); ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <select class="form-control" name="postAuthorId" id="">
            <option value="0">Select</option>
            <?php select_users(0);?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select class="form-control" name="postStatus" id="">
            <option value="0">Select</option>
            <option value="Draft">Draft</option>
            <option value="Published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="postImage">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="postTags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="postContent" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>