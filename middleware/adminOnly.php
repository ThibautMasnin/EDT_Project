<?php

if ($_SESSION['user_data']['level'] != ADMIN_ROLE) {
    Messages::setMsg('You are not admin ', 'error');
    header('Location: ' . "/");
}
