<?php
    session_start();
    if (!isset($_SESSION['auth'])) {
        header("Location: http://localhost/laaj/");
        exit();
    }
    include './config.php';
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
    <?php require './config.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Profil</div>
                    <div class="card-body">
                        <div class="profile image d-flex flex-column justify-content-center align-items-center">
                            <?php
                                $sql = "SELECT * FROM users WHERE username='{$_SESSION['auth']}'";
                                $result = mysqli_query($conn, $sql);
                                if ($result->num_rows > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <div class="css-after">
                                            <img src="./assets/image/avatars/<?php echo $row['profile'] ?>" class="img-fluid css-border">
                                        </div>
                                        <span class="name mt-3"><?php echo $row['username'] ?></span>
                                        <div class=" d-flex mt-2">
                                            <a href="./edit_profile.php" class="btn btn-primary">Editer le profil</a>
                                        </div>
                                        <div class="text mt-3">
                                            <span><?php echo $row['bio'] ?></span>
                                        </div>
                                        <div class=" px-2 rounded mt-4 date ">
                                            <span class="join">Membre depuis le <?php echo (new DateTime($row['created_at']))->format('d-m-Y') ?></span>
                                        </div> 
                                    <?php
                                    }
                                }
                            ?>
                        </div>
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