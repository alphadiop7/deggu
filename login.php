<?php require './src/login_action.php' ?>
<!doctype html>
<html lang="fr">

<head>
    <title><?= $app_name ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">

</head>

<body>
    <header>
        <!-- place navbar here -->
        <?php include 'layout/navbar.php' ?>
    </header>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <span class="form-text text-danger" role="alert">
                                <strong> <?php if (isset($error_fail)) { echo $error_fail; } ?> </strong>
                            </span>
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input id="email" type="email" placeholder="Adresse e-mail" class="form-control <?php if (isset($error_email)) { echo "is-invalid"; } ?>" name="email" value="<?php if (isset($email)) { echo $email; } ?>" autocomplete="email" aria-describedby="email">
                                <span class="invalid-feedback" role="alert">
                                    <strong> <?php if (isset($error_email)) { echo $error_email; } ?> </strong>
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input id="password" type="password" placeholder="Mot de passe" class="form-control <?php if (isset($error_password)) { echo "is-invalid"; } ?>" name="password">
                                <span class="invalid-feedback" role="alert">
                                    <strong> <?php if (isset($error_password)) { echo $error_password; } ?> </strong>
                                </span>
                            </div>
                            <div class="mb-3 text-end"><a href="./forgot-password.php">mot de passe oublié ?</a></div>
                            <button type="submit" name="submit" class="form-control btn btn-primary">Se connecter</button>
                            <a href="./register.php" class="text-form">s'inscrire</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <!-- place footer here -->
</footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#sendmailModal").modal('show');
    });
  </script>
</body>

</html>