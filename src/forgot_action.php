<?php
    require './config.php';

    session_start();
    if (isset($_SESSION['auth'])) {
        header("Location: http://localhost/deggu/");
        exit();
    }

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require './vendor/autoload.php';

    if (isset($_POST['forgot_password'])) {
        $email = htmlspecialchars($_POST['email']);
        $token = md5(rand());
        
        if (empty ($_POST['email'])) {
            $error_email = 'Veuillez remplir ce champ';
        } else {
            $sql = "SELECT * FROM  users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
                $sql = "UPDATE users SET token = '$token' WHERE email='$email'";
                $result_token = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $to = $email;
                $subject = htmlspecialchars("Réinitialisation mot de passe");
                $message = "
                    <html>
                        <head>
                            <title>{$subject}</title>
                        </head>
                        <body>
                            <p><strong>Salut $row[username],</strong></p>
                            <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe.</p>
                            <a href='{$web_url}reset-password.php?token={$token}' class='btn btn-primary form-control'>Réinitialisation mot de passe</a>
                        </body>
                    </html>
                ";
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
                    
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                     //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = $smtp['host'];                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = $smtp['user'];                     //SMTP username
                    $mail->Password   = $smtp['pass'];                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = $smtp['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
                    //Recipients
                    $mail->setFrom($my_email);
                    $mail->addAddress($email, $row['email']);     //Add a recipient
  
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $message;
  
                    $mail->send();
                    $success_send_email = "Nous avons envoyé un lien de réinitialisation à adresse e-mail {$email}";
                } catch (Exception $e) {
                    $error_fail = "Email non envoyé ! veuillez réessayer.";
                }
            } else {
                $error_fail = "Oups ! nous ne trouvons pas Email.";
            }
        }
    }
?>