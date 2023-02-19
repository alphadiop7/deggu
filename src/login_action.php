<?php
    require './config.php';

    session_start();
    if (isset($_SESSION['auth'])) {
        header("Location: http://localhost/deggu/");
        exit();
    }

    if (isset($_POST['submit'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        
        if (empty ($_POST['email'])) {
            $error_email = 'Veuillez remplir ce champ';
        } elseif (empty ($_POST['password'])) {
            $error_password = 'Veuillez remplir ce champ';
        } else {
            $sql = "SELECT * FROM  users WHERE email = '$email' AND email_verified_at is not null AND token is null";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($password = password_verify($password, $row['password'])) {
                        session_start();
                        $_SESSION['auth'] = $row['username'];
                        header("Location: http://localhost/deggu/");
                        exit();
                    } else {
                        $error_fail = "Oups ! Email ou le mot de passe est incorrect." ;
                    }
                }
            } else {
                $error_fail = "Oups ! Email ou le mot de passe est incorrect." ;
            }
        }
    }
?>