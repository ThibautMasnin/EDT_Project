<?php
require_once(__DIR__ . "/view/page/app.php");
require_once(__DIR__ . "/view/page/header.php");

if (isset($_SESSION['is_logged_in'])) {
    header('Location: ' . ROOT_URL . "/view/user/planning.php");
    exit();
}
else { 
    header('Location: ' . ROOT_URL . "/view/user/login.php");
    exit();
}

require_once(__DIR__ . "/view/page/footer.php");
?>