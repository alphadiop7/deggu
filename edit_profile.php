<?php
    require './src/edit_profile_action.php'   
?>
<!doctype html>
<html lang="fr">

<head>
  <title><?= $app_name ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
    <header>
    <!-- place navbar here -->
    <?php require './layout/navbar.php' ?>
  </header>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Modification de profil</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <span class="form-text text-success" role="alert">
                                <strong> <?php if (isset($success_upload)) { echo $success_upload; } ?> </strong>
                            </span>
                            <div class="profile image d-flex flex-column justify-content-center align-items-center">
                                <?php
                                $sql = "SELECT * FROM users WHERE username='{$_SESSION['auth']}'";
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <input class="form-control mb-3" value="<?php echo $row['username'] ?>" disabled>
                                        <input class="form-control mb-3" value="<?php echo $row['email'] ?>" disabled>
                                        <textarea name="biographie" class="form-control mb-3" cols="30" rows="5" maxlength="100"><?php echo $row['bio'] ?></textarea>
                                        <input id="photo" type="file" name="uploadfile" placeholder="Photo de profil" class="form-control mb-3 <?php if (isset($error_fail) || ($error_extension)) { echo "is-invalid"; } ?>" name="photo" accept="image/*">
                                        <span class="invalid-feedback mb-0" role="alert">
                                          <strong> <?php if (isset($error_fail)) { echo $error_fail; } if (isset($error_extension)) { echo $error_extension; } ?> </strong>
                                        </span>
                                        <button type="submit" name="upload" class="form-control btn btn-primary mb-3">Modifier</button>
                                    <?php
                                    }
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Bootstrap JavaScript Libraries -->
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>

</html>