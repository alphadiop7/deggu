<?php
    require './config.php';

    session_start();
    if (!isset($_SESSION['auth'])) {
        header("Location: http://localhost/deggu/");
        exit();
    }

    if (isset($_POST['upload'])) {
        $filename = $_FILES['uploadfile']['name'];
        $tempname = $_FILES['uploadfile']['tmp_name'];
        $extension = pathinfo($_FILES['uploadfile']['name'], PATHINFO_EXTENSION);
        $folder = './assets/image/avatars/' . $filename;

        $biographie = htmlspecialchars($_POST['biographie']);
        //htmlspecialchars(addcslashes($_POST['biographie'], "'\r\n\\"), ENT_COMPAT);

        switch (isset($_POST['upload'])) {
            case !empty($filename) && !empty($biographie):
                if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif') {
                    $sql = "UPDATE users SET profile = '$filename', bio = '$biographie', updated_at = CURRENT_TIMESTAMP WHERE username='{$_SESSION['auth']}'";
                    $result = mysqli_query($conn, $sql);
                    if (move_uploaded_file($tempname, $folder)) {
                        $success_upload = "Mise à jour du profil réussie";
                        header("Location: profile.php");
                        exit();
                    } else {
                        $error_fail = "Profil ne peut pas être mis à jour" ;
                    }
                } else {
                    $error_extension = "Le fichier n'est pas une image";
                }
                break;
            case !empty($filename) && empty($biographie):
                if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif') {
                    $sql = "UPDATE users SET profile = '$filename', updated_at = CURRENT_TIMESTAMP WHERE username='{$_SESSION['auth']}'";
                    $result = mysqli_query($conn, $sql);
                    if (move_uploaded_file($tempname, $folder)) {
                        $success_upload = "Mise à jour du profil réussie";
                        header("Location: profile.php");
                        exit();
                    } else {
                        $error_fail = "Profil ne peut pas être mis à jour" ;
                    }
                } else {
                    $error_extension = "Le fichier n'est pas une image";
                }
                break;
            case empty($filename) && !empty($biographie):
                $sql = "UPDATE users SET bio = '$biographie', updated_at = CURRENT_TIMESTAMP WHERE username='{$_SESSION['auth']}'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $success_upload = "Mise à jour du profil réussie";
                    header("Location: profile.php");
                    exit();
                }
                else {
                    $error_fail = "Profil ne peut pas être mis à jour";
                }
                break;
            default:
                # code...
                break;
        }

    }
?>