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
    <div class="container">

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
                            <?php if ($_SESSION["user_data"]["level"] < ETU_ROLE) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/teacherPlanning.php">Teacher Planning</a>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/userInformation.php">Profile</a>
                                </li>
                                <?php if ($_SESSION["user_data"]["level"] == ADMIN_ROLE) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo ROOT_URL ?>/view/user/list.php">List</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="controller" value="UserController">
                                        <input type="hidden" name="action" value="logout">
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
        <div class="row">
            <?php Messages::display(); ?>
        </div>