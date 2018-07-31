<?php
    // after pressing start
    session_start();

    // session_destroy();   
    if (isset($_POST['username']) && trim($_POST['username']) != '' && isset($_POST['testID'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['testID'] = $_POST['testID'];
    }

    if (isset($_SESSION['username']) && isset($_SESSION['testID'])) {
        $url = "survey";
        header('Location: ' . $url);
        exit();
    }
?>