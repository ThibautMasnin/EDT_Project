<?php

class UserController extends Controller
{
    public function login()
    {
        $res = User::login();
        if (!empty($res)) {
            $this->returnView('userInformation');
        }
    }

    public function register()
    {
        if ($_SESSION['user_data']['level'] == ADMIN_ROLE) {
            User::register();
        }
    }

    public function logout()
    {

        if (isset($_POST["submit"])) {

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
        $res = [];
        if ($_SESSION['user_data']['level'] == ADMIN_ROLE) {
            $res = User::getAll();
        }

        return $res;
    }

    public function getOne()
    {
        $res = [];
        if (isset($_SESSION['is_logged_in'])) {
            $res = User::getOne();
        }
        return $res;
    }

    public function update()
    {
        if ($_SESSION['user_data']['level'] == ADMIN_ROLE) {
            User::update();
        }
    }
    public function delete()
    {
        if ($_SESSION['user_data']['level'] == ADMIN_ROLE) {
            User::delete();
        }
    }
}
