<table class="table table-hover">
    <thead>
        <tr>
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

<?php
delete_post();
publish_post();
?>