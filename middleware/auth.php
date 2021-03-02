<?php
require_once(__DIR__ . "/../classes/Messages.php");

if (!isset($_SESSION['is_logged_in'])) {
    Messages::setMsg('You have not logged in ', 'error');
    Messages::display();
    exit();
}
