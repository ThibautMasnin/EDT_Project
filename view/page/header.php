<?php
//our entry into the web application

//all the requests will pass through this file

//load db
require_once(__DIR__ . "/../../db.php");
require_once(__DIR__ . "/../../config.php");
//require_once(__DIR__ . "/../../classes/Messages.php");

//load all model and controller classes
foreach (glob(__DIR__ . "/../../classes/*.php") as $file) {
    require_once $file;
}
foreach (glob(__DIR__ . "/../../controller/*.php") as $file) {
    require_once $file;
}
foreach (glob(__DIR__ . "/../../model/*.php") as $file) {
    require_once $file;
}
// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour

session_set_cookie_params(3600, null, null, false, true);

session_start();


//$controller and $action passed from url for every forms
if (isset($_GET["controller"]) && isset($_GET["action"])) {
    $controller = $_GET["controller"];
    $action = $_GET["action"];
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

<body class="container">
    <div class="container">
        <div class="row">
            <?php Messages::display(); ?>
        </div>

    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo ROOT_URL ?>">Emploi du temps</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo ROOT_URL ?>">Home</a>
                    </li>

                    <?php if (isset($_SESSION['is_logged_in'])) : ?>
                        <?php if ($_SESSION["user_data"]["level"] < 2) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/teacherPlanning.php">Teacher Planning</a>

                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/list.php?controller=User&action=getAll">List</a>
                            </li>
                            <li class="nav-item">
                                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?controller=User&action=logout">
                                    <button class="btn btn-outline-success" type="submit" name="submit" value="submit">Log out</button>
                                </form>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/login.php">Login</a>
                            </li>
                        <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>