<?php


if (!isset($_SESSION['is_logged_in'])) {

    Messages::setMsg('You have not logged in ', 'error');
    header('Location: ' . "/");
}
