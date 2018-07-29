<?php

function confirmQuery($result) {
    global $connection;

    if (!$result) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
}

function escape ($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function get_rand_salt() {
    global $connection;
    $query = "SELECT userRandSalt FROM users";
    $select_rand_salt_query = mysqli_query($connection, $query);
    confirmQuery($select_rand_salt_query);
    $row = mysqli_fetch_array($select_rand_salt_query);
    $userRandSalt = $row['userRandSalt'];
    return $userRandSalt;
}

function num_users_online() {
    if (isset($_GET['online_users'])) {
        global $connection;
        if (!$connection) {
            session_start();
            include "../../includes/db.php";

            $userSession = session_id();
            $userTime = time();
            $timeOutInSeconds = 5;
            $timeOut = $userTime - $timeOutInSeconds;

            $query = "SELECT * FROM users_online WHERE userSession = '$userSession'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online (userSession, userTime) VALUES ('$userSession', '$userTime')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET userTime = '$userTime' WHERE userSession = '$userSession'");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE userTime > '$timeOut'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}

num_users_online();