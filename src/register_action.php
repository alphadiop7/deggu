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

    if (isset($_POST['submit'])) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $options = ['cost'=> 12];
        $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $token = md5(rand());
        
        if (empty ($_POST['username'])) {
            $error_username = 'Veuillez remplir ce champ';
        }
        elseif (empty ($_POST['email'])) {
            $error_email = 'Veuillez remplir ce champ';
        }
        elseif (empty ($_POST['password'])) {
            $error_password = 'Veuillez remplir ce champ';
        }
        else {
            $check_username = "SELECT * FROM  users WHERE username = '$username'";
            $result_username = mysqli_query($conn, $check_username);
            $check_email = "SELECT * FROM  users WHERE email = '$email'";
            $result_email = mysqli_query($conn, $check_email);
            
            if ($result_username->num_rows > 0) {
                $error_username_exist = "Oups ! Non d'utilisateur non valide";
            }
            elseif ($result_email->num_rows > 0) {
                $error_email_exist = "Oups ! Email existe déjà.";
            }
            else {
                $sql = "INSERT INTO users (username, email, password, token, created_at, updated_at) VALUES ('$username', '$email', '$password_hash', '$token', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_POST['username'] = "";
                    $_POST['email'] = "";
                    $_POST['password'] = "";
                    
                    $to = $email;
                    $subject = "Verification Email";
                    $message = "
                        <html>
                        <head>
                            <title>{$subject}</title>
                            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
                        </head>
                        <body>
                            <p><strong>Salut {$username},</strong></p>
                            <p>Merci pour l'inscription ! pour accéder à notre site Web. Cliquez sur le lien ci-dessous pour vérifier votre adresse e-mail.</p>
                            <a href='{$web_url}verify-email.php?token={$token}' class='btn btn-primary form-control'>Vérifier Email</a>
                            <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>
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
                        $mail->addAddress($email, $username);     //Add a recipient
      
                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = $subject;
                        $mail->Body    = $message;
      
                        $mail->send();
                        $success_send_email = "Nous avons envoyé un lien de vérification à adresse e-mail {$email}";
                    } catch (Exception $e) {
                        $error_fail = "Email non envoyé ! veuillez réessayer.";
                    }
                } else {
                    $error_fail ="Oups ! Quelque chose s'est mal passé.";
                }
            }
        }
    }
?>