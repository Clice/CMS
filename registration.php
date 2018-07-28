<?php
include "includes/db.php";
include "includes/header.php";
include "includes/navigation.php";

if (isset($_POST['submit'])) {
    $userName = $_POST['username'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    if ((!empty($userName)) && (!empty($userEmail)) && ($userPassword)) {
        $userName = mysqli_real_escape_string($connection, $userName);
        $userEmail = mysqli_real_escape_string($connection, $userEmail);
        $userPassword = mysqli_real_escape_string($connection, $userPassword);
        $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "INSERT INTO users (userName, userPassword, userEmail, userRole) ";
        $query .= "VALUES ('$userName', '$userPassword', '$userEmail', 'Subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        confirmQuery($register_user_query);

        $message = "<div class='alert alert-success' role='alert'>Your registration has been submitted.</div>";
    } else {
        $message = "<div class='alert alert-danger' role='alert'>Fields cannot be empty.</div>";
    }
} else {
    $message = "";
}
?>

    <div class="container">

        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                            <?php echo $message; ?>
                            <h1>Register</h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username" class="sr-only">username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>

<?php include "includes/footer.php";?>