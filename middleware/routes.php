<?php



//var_dump($_POST);
if (!empty($controller) && !empty($action)) {
    if (class_exists($controller)) {
        if (method_exists($controller, $action)) {
            call($controller, $action);
        } else {
            Messages::setMsg("Not found", "error");
            header('Location: ' . '/view/page/404.php');
            exit();
        }
    } else {
        Messages::setMsg("Not found", "error");
        header('Location: '  . '/view/page/404.php');
        exit();
    }
}




//the function for calling the actions on the controller
function call($controller, $action)
{

    //we call the action function on the controller
    $controller = new $controller($action);

    $controller->{$action}();
}
