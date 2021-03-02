<?php



//$controller and $action passed from hidden input for every forms
// to specify what controller and what method it will use

// sanitize $_POST
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if (isset($_POST["controller"]) && isset($_POST["action"])) {
    $controller = $_POST["controller"];
    $action = $_POST["action"];
} else {
    //default: index.php
    $controller = "";
    $action = "";
}



// load up the routing code, that will execute the action on the controller
require_once(__DIR__ . "/../../middleware/routes.php");




?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Emploi du temps</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>/view/asset/style.css?<?= time() ?>">
</head>

<body>
    <div class="container-fluid bg-dark">

    <div class="row">
            <div class="col-lg-2 navbar navbar-dark">
                <a class="navbar-brand" href="<?php echo ROOT_URL ?>" style="color: white;">
                    <img src="<?php echo ROOT_URL ?>/view/asset/logo.png" width="30" height="30" alt="Logo">
                    Planning
                </a>
            </div>
            <nav class="col-lg-8 navbar navbar-expand-lg bg-dark navbar-dark">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['is_logged_in'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/planning.php">Consultation</a>
                            </li>
                            <?php if ($_SESSION["user_data"]["level"] < ETU_ROLE) : ?>                     
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Modification</a>
                                </li>     
                            <?php endif; ?>
                            <?php if ($_SESSION["user_data"]["level"] == ADMIN_ROLE) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/list.php">Utilisateurs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Salles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Cours</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Service ETD</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/userInformation.php">Profil</a>
                            </li>
                            <li class="nav-item">
                                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="controller" value="UserController">
                                    <input type="hidden" name="action" value="logout">
                                    <button class="btn btn-outline-danger" type="submit" name="submit" value="submit">Deconnexion</button>
                                </form>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            <?php Messages::display(); ?>
        </div>
    </div>