<?php require './src/forgot_action.php' ?>
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
                    <div class="card-header">Réinitialisation mot de passe</div>
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
                            <button type="submit" name="forgot_password" class="form-control btn btn-primary">Envoyer le lien de réinitialisation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($success_send_email)): ?>
            <div class="modal fade" id="sendmailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Réinitialisation mot de passe</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"><?php echo $success_send_email; ?></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
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