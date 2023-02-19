<?php require './src/reset_action.php' ?>
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
    </header>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Confirmation mot de passe</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <span class="form-text text-danger" role="alert">
                                <strong> <?php if (isset($errormsg)) { echo $errormsg; } ?> </strong>
                            </span>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input id="password" type="password" placeholder="Mot de passe" class="form-control <?php if (isset($error_password)) { echo "is-invalid"; } ?>" name="password">
                                <span class="invalid-feedback" role="alert">
                                    <strong> <?php if (isset($error_password)) { echo $error_password; } ?> </strong>
                                </span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Confirmez le mot de passe</label>
                                <input id="password" type="password" placeholder="Mot de passe" class="form-control <?php if (isset($error_cpassword) || ($error_password_matched)) { echo "is-invalid"; }  ?>" name="cpassword">
                                <span class="invalid-feedback" role="alert">
                                    <strong> <?php if (isset($error_cpassword)) { echo $error_cpassword; } if (isset($error_password_matched)) { echo $error_password_matched; } ?> </strong>
                                </span>
                            </div>
                            <button type="submit" name="reset_password" class="form-control btn btn-primary">Confirmez le mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($success_reset)): ?>
            <div class="modal fade" id="sendmailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modification mot de passe</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"><?php echo $success_reset; ?></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
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