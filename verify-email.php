<?php
    require './config.php';
    session_start();
    if (isset($_GET["token"])) {
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username FROM users WHERE token='{$_GET['token']}'"));
        $_SESSION['auth'] = $row['username'];
        header("Location: http://localhost/deggu/");
        $sql= "UPDATE users SET email_verified_at = CURRENT_TIMESTAMP, token = null, updated_at = CURRENT_TIMESTAMP WHERE token='{$_GET['token']}'";
        $result = mysqli_query($conn, $sql);
        exit();
    } else {
        header("Location: http://localhost/deggu/");
        exit();
    }
?>