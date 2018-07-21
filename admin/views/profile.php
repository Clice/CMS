<?php
include "../includes/admin_header.php";
include "../includes/admin_navigation.php";

$data = find_user_by_id($_SESSION['userId']);

update_profile();
?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Profile
                        <small>Subheading</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="userId" value="<?php echo $data['userId']; ?>">
                        <div class="form-group">
                            <label for="title">First Name</label>
                            <input type="text" class="form-control" name="userFirstName" value="<?php echo $data['userFirstName']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Last Name</label>
                            <input type="text" class="form-control" name="userLastName" value="<?php echo $data['userLastName']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email" class="form-control" name="userEmail" value="<?php echo $data['userEmail']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Username</label>
                            <input type="text" class="form-control" name="userName" value="<?php echo $data['userName']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Password</label>
                            <input type="password" class="form-control" name="userPassword" value="<?php echo $data['userPassword']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="title">Role</label>
                            <select class="form-control" name="userRole" id="">
                                <option value="0">Select</option>
                                <option value="Admin" <?php if ($data['userRole'] == "Admin") { echo 'selected'; } ?>>Admin</option>
                                <option value="Subscriber" <?php if ($data['userRole'] == "Subscriber") { echo 'selected'; } ?>>Subscriber</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include "../includes/admin_footer.php"; ?>