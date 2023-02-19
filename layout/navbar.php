<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php"><?= $app_brand ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['auth'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./register.php">S'inscrire</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['auth'] ?></a>
                        <div class="dropdown-menu dropdown-menu-end border-0 my-2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./profile.php">Profil</a>
                            <a class="dropdown-item" href="./logout.php">Se déconnecter</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>