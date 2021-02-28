<?php

class UserController extends Controller
{
    public function login()
    {
        $res = User::login();
        $_SESSION["db_res"] = $res;

        if (!empty($res)) {
            $this->returnView('userInformation');
        }
    }
    public function register()
    {
        User::register();
    }

    public function logout()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if (isset($post["submit"])) {

            unset($_SESSION['is_logged_in']);
            unset($_SESSION['user_data']);
            session_destroy();
            // Redirect
            header('Location: ' . ROOT_URL);
            exit();
        }
    }

    public function getAll()
    {
        $res = User::getAll();
        $_SESSION["db_res"] = $res;

        $this->returnView('list');
    }

    public function getOne()
    {
        $res = User::getOne();
        $_SESSION["db_res"] = $res;

        $this->returnView('list');
    }

    public function update()
    {
        User::update();
    }
    public function delete()
    {
        User::delete();
    }
}
