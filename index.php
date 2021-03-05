<?php
require_once(__DIR__ . "/view/page/app.php");


if (isset($_SESSION['is_logged_in'])) {
    header('Location: '  . "/view/user/planning.php");
    exit();
} else {
    header('Location: '  . "/view/user/login.php");
    exit();
}

require_once(__DIR__ . "/view/page/header.php");

require_once(__DIR__ . "/view/page/footer.php");
