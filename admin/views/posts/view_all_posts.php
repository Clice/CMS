<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postValueId) {
        $bulkOptions = $_POST['bulkOptions'];

        switch ($bulkOptions) {
            case 'Published':
                update_status($bulkOptions, $postValueId);
                break;

            case 'Draft':
                update_status($bulkOptions, $postValueId);
                break;

            case 'delete':
                delete_post_table($postValueId);
                break;
        }
    }
}
?>

<form action="" method="post">
    <table class="table table-hover">
        <div class="col-xs-4" id="bulkOptionContainer">
            <select name="bulkOptions" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="Published">Pulished</option>
                <option value="Draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>

        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Publish</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php find_all_posts(); ?>
        </tbody>
    </table>
</form>

<?php
delete_post();
publish_post();
?>