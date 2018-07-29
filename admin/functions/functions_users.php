<?php

function insert_user() {
    global $connection;

    if (isset($_POST['add_user'])) {
        $userFirstName = $_POST['userFirstName'];
        $userLastName = $_POST['userLastName'];
        $userEmail = $_POST['userEmail'];
        $userName = $_POST['userName'];
        $userPassword = $_POST['userPassword'];
        $userRole = $_POST['userRole'];

        if ($userRole !== 0) {
            $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 12));
            $query = "INSERT INTO users(userName, userPassword, userFirstName, userLastName, userEmail, userRole) ";
            $query .= "VALUES('$userName', '$userPassword', '$userFirstName', '$userLastName', '$userEmail', '$userRole')";
            $add_user_query = mysqli_query($connection, $query);
            confirmQuery($add_user_query);

            echo "<div class='alert alert-success' role='alert'>User Created: " .
                "<a href='users.php?source=view_all_users'>View All Users</a></div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Please, select a role for the user.</div>";
        }
    }
}

function update_user() {
    global $connection;
    $userPassword = "";

    if (isset($_POST['update_user'])) {
        $userId = $_POST['userId'];
        $userFirstName = $_POST['userFirstName'];
        $userLastName = $_POST['userLastName'];
        $userEmail = $_POST['userEmail'];
        $userName = $_POST['userName'];
        $userPassword = $_POST['userPassword'];
        $userRole = $_POST['userRole'];

        if ($userRole !== 0) {
            $hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 12));
            $query = "UPDATE users SET userName = '$userName', userPassword = '$hashedPassword', userFirstName = '$userFirstName', ";
            $query .= "userLastName = '$userLastName', userEmail = '$userEmail', userRole = '$userRole' ";
            $query .= "WHERE userId = $userId";
            $update_user_query = mysqli_query($connection, $query);
            confirmQuery($update_user_query);

            echo "<div class='alert alert-success' role='alert'>User Edited: " .
                "<a href='users.php?source=view_all_users'>View All Users</a></div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Please, select a role for the user.</div>";
        }
    }

    return $userPassword;
}

function find_all_users() {
    global $connection;
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
    confirmQuery($select_users);

    while ($row = mysqli_fetch_assoc($select_users)) {
        $userId = $row['userId'];
        $userName = $row['userName'];
        $userFirstName = $row['userFirstName'];
        $userLastName = $row['userLastName'];
        $userEmail = $row['userEmail'];
        $userRole = $row['userRole'];
        ?>
        <tr>
            <td><?php echo $userId; ?></td>
            <td><?php echo $userName; ?></td>
            <td><?php echo $userFirstName; ?></td>
            <td><?php echo $userLastName; ?></td>
            <td><?php echo $userEmail; ?></td>
            <td><?php echo $userRole; ?></td>
            <td><a href="users.php?source=view_all_users&change_to_admin=<?php echo $userId; ?>">Admin</a></td>
            <td><a href="users.php?source=view_all_users&change_to_sub=<?php echo $userId; ?>">Subscriber</a></td>
            <td><a href="users.php?source=edit_user&id=<?php echo $userId; ?>">Edit</a></td>
            <td><a href="users.php?source=view_all_users&delete=<?php echo $userId; ?>">Delete</a></td>
        </tr>
        <?php
    }
}

function find_user_by_id($userId) {
    global $connection;
    $query = "SELECT * FROM users WHERE userId = $userId";
    $select_user = mysqli_query($connection, $query);
    confirmQuery($select_user);

    while ($row = mysqli_fetch_assoc($select_user)) {
        $data['userId'] = $row['userId'];
        $data['userFirstName'] = $row['userFirstName'];
        $data['userLastName'] = $row['userLastName'];
        $data['userName'] = $row['userName'];
        $data['userRole'] = $row['userRole'];
        $data['userEmail'] = $row['userEmail'];
        $data['userPassword'] = $row['userPassword'];
    }

    return $data;
}

function update_profile() {
    global $connection;

    if (isset($_POST['update_profile'])) {
        $userId = $_POST['userId'];
        $userFirstName = $_POST['userFirstName'];
        $userLastName = $_POST['userLastName'];
        $userEmail = $_POST['userEmail'];
        $userName = $_POST['userName'];
        $userPassword = $_POST['userPassword'];

        if ((!empty($userId)) || (!empty($userFirstName)) || (!empty($userLastName)) || (!empty($userEmail)) ||
            (!empty($userName)) || (!empty($userPassword))) {
            $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 12));
            $query = "UPDATE users SET userName = '$userName', userPassword = '$userPassword', userFirstName = '$userFirstName', ";
            $query .= "userLastName = '$userLastName', userEmail = '$userEmail' ";
            $query .= "WHERE userId = $userId";
            $update_profile_query = mysqli_query($connection, $query);
            confirmQuery($update_profile_query);

            $_SESSION['userId'] = $userId;
            $_SESSION['userFirstName'] = $userFirstName;
            $_SESSION['userLastName'] = $userLastName;
            $_SESSION['userName'] = $userName;
            $_SESSION['userPassword'] = $userPassword;
            $_SESSION['userEmail'] = $userEmail;

            echo "<div class='alert alert-success' role='alert'>Profile edited successufully.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error editing the profile.</div>";
        }
    }
}

function delete_user() {
    global $connection;

    if (isset($_GET['delete'])) {
        if (isset($_SESSION['userRole'])) {
            $userId = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM users WHERE userId = $userId";
            $delete_query = mysqli_query($connection, $query);
            confirmQuery($delete_query);
            header("Location: users.php?source=view_all_users");
        }
    }
}

function change_to_admin() {
    global $connection;

    if (isset($_GET['change_to_admin'])) {
        $userId = $_GET['change_to_admin'];
        $query = "UPDATE users SET userRole = 'Admin' WHERE userId = $userId";
        $change_to_admin_query = mysqli_query($connection, $query);
        confirmQuery($change_to_admin_query);
        header("Location: users.php?source=view_all_users");
    }
}

function change_to_sub() {
    global $connection;

    if (isset($_GET['change_to_sub'])) {
        $userId = $_GET['change_to_sub'];
        $query = "UPDATE users SET userRole = 'Subscriber' WHERE userId = $userId";
        $change_to_sub_query = mysqli_query($connection, $query);
        confirmQuery($change_to_sub_query);
        header("Location: users.php?source=view_all_users");
    }
}

function num_users() {
    global $connection;
    $query = "SELECT * FROM users";
    $select_all_users = mysqli_query($connection, $query);
    confirmQuery($select_all_users);
    $num_users = mysqli_num_rows($select_all_users);
    return $num_users;
}

function num_admin_users() {
    global $connection;
    $query = "SELECT * FROM users WHERE userRole = 'Admin'";
    $select_all_admin_users = mysqli_query($connection, $query);
    confirmQuery($select_all_admin_users);
    $num_admin_users = mysqli_num_rows($select_all_admin_users);
    return $num_admin_users;
}

function num_subs_users() {
    global $connection;
    $query = "SELECT * FROM users WHERE userRole = 'Subscriber'";
    $select_all_subs_users = mysqli_query($connection, $query);
    confirmQuery($select_all_subs_users);
    $num_subs_users = mysqli_num_rows($select_all_subs_users);
    return $num_subs_users;
}

function select_users($postAuthorId) {
    global $connection;
    $query = "SELECT * FROM users WHERE userRole = 'Admin'";
    $select_users = mysqli_query($connection, $query);
    confirmQuery($select_users);

    while ($row = mysqli_fetch_assoc($select_users)) {
        $userId = $row['userId'];
        $userFirstName = $row['userFirstName'];
        $userLastName = $row['userLastName'];
        ?>
        <option value="<?php echo $userId; ?>" <?php if ($userId == $postAuthorId) { echo 'selected'; } ?>>
            <?php echo $userFirstName . " " . $userLastName; ?></option>
        <?php
    }
}