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
    <link rel="stylesheet" href="/view/asset/style.css?<?= time() ?>">
</head>

<body>
    <div class="container-fluid">

        <div class="row bg-dark">
            <div class="col-lg-2 navbar">
                <a class="navbar-brand" href="/" style="color: white;">
                    <img src="/view/asset/logo.png" width="30" height="30" alt="Logo">
                    Planning
                </a>
            </div>
            <div class="col-lg-8 navbar navbar-expand-lg bg-dark navbar-dark">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['is_logged_in'])) : ?>
                            <li class="nav-item px-1">
                                <a class="nav-link" href="/view/user/planning.php">Consultation</a>
                            </li>
                            <?php if ($_SESSION["user_data"]["level"] < ETU_ROLE) : ?>
                                <li class="nav-item px-1">
                                    <a class="nav-link" href="#">Modification</a>
                                </li>
                            <?php endif; ?>
                            <?php if ($_SESSION["user_data"]["level"] == ADMIN_ROLE) : ?>
                                <li class="nav-item px-1">
                                    <a class="nav-link" href="/view/user/list.php">Utilisateurs</a>
                                </li>
                                <li class="nav-item px-1">
                                    <a class="nav-link" href="#">Salles</a>
                                </li>
                                <li class="nav-item px-1">
                                    <a class="nav-link" href="#">Cours</a>
                                </li>
                                <li class="nav-item px-1">
                                    <a class="nav-link" href="#">Service ETD</a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item px-1">
                                <a class="nav-link" href="/view/user/userInformation.php">Profil</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <?php if (isset($_SESSION['is_logged_in'])) : ?>
                <div class="col-lg-2 navbar">
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="controller" value="UserController">
                        <input type="hidden" name="action" value="logout">
                        <button class="btn btn-outline-danger" type="submit" name="submit" value="submit">Deconnexion</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php Messages::display(); ?>
        </div>