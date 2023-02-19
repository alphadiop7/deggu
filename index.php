<?php
    session_start();
    require './config.php';
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

</head>

<body>
    <header>
        <!-- place navbar here -->
        <?php include './layout/navbar.php' ?>
    </header>
    <main>
        <div class="container-fluid">
            <?php if (isset($_SESSION['auth'])): ?>
                <h3>Nu ngi lay nuyu <?php echo $_SESSION['auth']; ?> </h3>
            <?php else: ?>
                <h5 class="text-danger fw-bold">Lëkkaloo amul !</h5>
            <?php endif; ?>
        </div>
    </main>
    <?php include './layout/footer.php' ?>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>