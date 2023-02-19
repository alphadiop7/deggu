<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "deggu_db";
    $conn = mysqli_connect($server, $user, $pass, $database);

    $app_name = "dëggu";
    $app_brand = "Jumtuwaayu dëggu";
    $web_url = "http://localhost/deggu/";
    $my_email = "email@gmail.com"; //votre email
    
    $smtp['host'] = "smtp.gmail.com";
    $smtp['user'] = "email@gmail.com"; //email qui envoie le message
    $smtp['pass'] = ""; // mot de passe
    $smtp['port'] = 465;
    
    if (!$conn) {
        die("<script>alert('Connection Failed.')</script>");
    }
?>