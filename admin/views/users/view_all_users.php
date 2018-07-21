<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php find_all_users(); ?>
    </tbody>
</table>

<?php
delete_user();
change_to_admin();
change_to_sub();
?>