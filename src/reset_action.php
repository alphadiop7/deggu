<?php
    require './config.php';

    session_start();
    if (isset($_SESSION['auth'])) {
        header("Location: http://localhost/deggu/");
        exit();
    }

    if (isset($_POST['reset_password'])) {
        $password = htmlspecialchars($_POST['password']);
        $cpassword = htmlspecialchars($_POST['cpassword']);
        $options = ['cost'=> 12];
        $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
        
        if (empty ($_POST['password'])) {
            $error_password = 'Veuillez remplir ce champ';
        }
        elseif (empty ($_POST['cpassword'])) {
            $error_cpassword = 'Veuillez remplir ce champ';
        }
        else {
            if ($password === $cpassword) {
                $sql = "UPDATE users SET password = '$password_hash', token = null, updated_at = CURRENT_TIMESTAMP WHERE token='{$_GET["token"]}'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success_reset = "Votre mot de passe a été bien modifié avec succès";
                    $sql = "SELECT * FROM  users WHERE password = '$password_hash' AND email_verified_at is not null";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            session_start();
                            $_SESSION['auth'] = $row['username'];
                            header("Location: http://localhost/deggu/");
                            exit();
                        }
                    } else {
                        echo "Veuillez essayer à nouveau !";
                    }
                } else {
                    echo "Veuillez essayer à nouveau !";
                }
                
            } else {
                $error_password_matched = "Les mots de passe ne correspondent pas !";
            }
        }
    }
?>