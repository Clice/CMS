<?php

session_start();
$_SESSION['userFirstName'] = null;
$_SESSION['userLastName'] = null;
$_SESSION['userName'] = null;
$_SESSION['userPassword'] = null;
$_SESSION['userRole'] = null;

header("Location: ../");