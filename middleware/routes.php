<?php

//the function for calling the actions on the controller
function call($controller, $action)
{

    //we call the action function on the controller
    $controller = new $controller($controller, $action);

    $controller->{$action}();
}

if (!empty($controller) && !empty($action)) {
    $ctr = $controller . "Controller";
    if (class_exists($ctr)) {
        if (method_exists($ctr, $action)) {
            call($ctr, $action);
        } else {
            header('Location: ' . ROOT_URL . '/view/page/404.php');
            exit();
        }
    } else {
        header('Location: ' . ROOT_URL . '/view/page/404.php');
        exit();
    }
}
