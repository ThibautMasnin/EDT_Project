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
            header('Location: ' . "/");
            exit();
        }
    }

    public function getAll($offset = null, $limit = null)
    {
        $res = [];
        if ($_SESSION['user_data']['level'] == ADMIN_ROLE) {
            $res = User::getAll($offset, $limit);
        }

        return $res;
    }

    public function getAllTeachers()
    {
        $res = [];
        if ($_SESSION['user_data']['level'] <= PROF_ROLE) {
            $res = User::getAllTeachers();
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

    public function formBuilder()
    {
        if ($_SESSION['user_data']['level'] <= PROF_ROLE) {
            $_SESSION['form_name'] = $_POST['tag'];
        }
    }

    public function crud()
    {
        if ($_SESSION['user_data']['level'] <= PROF_ROLE) {

            if (isset($_POST['create'])) {
                Utility::createData();
            }

            if (isset($_POST['update'])) {
                Utility::updateData();
            }

            if (isset($_POST['delete'])) {
                Utility::deleteData();
            }
        }
    }
}
