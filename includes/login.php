<?php

include "db.php";
session_start();
include "../admin/functions/general_functions.php";

if (isset($_POST['login'])) {
    $userName = $_POST['userName'];
    $userPassword = $_POST['userPassword'];

    $userName = mysqli_real_escape_string($connection, $userName);
    $userPassword = mysqli_real_escape_string($connection, $userPassword);

    $query = "SELECT * FROM users WHERE userName = '$userName' AND userPassword = '$userPassword'";
    $select_user_query = mysqli_query($connection, $query);
    confirmQuery($select_user_query);

    while ($row = mysqli_fetch_array($select_user_query)) {
        $dbUserId = $row['userId'];
        $dbUserFirstName = $row['userFirstName'];
        $dbUserLastName = $row['userLastName'];
        $dbUserName = $row['userName'];
        $dbUserPassword = $row['userPassword'];
        $dbUserEmail = $row['userEmail'];
        $dbUserRole = $row['userRole'];
    }

    if (($userName === $dbUserName) && ($userPassword === $dbUserPassword)) {
        $_SESSION['userId'] = $dbUserId;
        $_SESSION['userFirstName'] = $dbUserFirstName;
        $_SESSION['userLastName'] = $dbUserLastName;
        $_SESSION['userName'] = $dbUserName;
        $_SESSION['userPassword'] = $dbUserPassword;
        $_SESSION['userEmail'] = $dbUserEmail;
        $_SESSION['userRole'] = $dbUserRole;

        header("Location: ../admin/views");
    } else {
        header("Location: ../index.php");
    }
}