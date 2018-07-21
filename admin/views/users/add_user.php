<?php insert_user(); ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">First Name</label>
        <input type="text" class="form-control" name="userFirstName">
    </div>
    <div class="form-group">
        <label for="title">Last Name</label>
        <input type="text" class="form-control" name="userLastName">
    </div>
    <div class="form-group">
        <label for="title">Email</label>
        <input type="email" class="form-control" name="userEmail">
    </div>
    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="userName">
    </div>
    <div class="form-group">
        <label for="title">Password</label>
        <input type="password" class="form-control" name="userPassword">
    </div>
    <div class="form-group">
        <label for="title">Role</label>
        <select class="form-control" name="userRole" id="">
            <option value="0">Select</option>
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
</form>