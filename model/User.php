<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $level;
    public $promotion;
    public $created_at;



    public static function register()
    {




        if (isset($_POST['submit'])) {


            // validate input before db operation
            if ($_POST['username'] == '' || $_POST['level'] == '' || $_POST['password'] == '') {
                Messages::setMsg('Please Fill In All Field', 'error');
            } else {

                $password = md5($_POST['password']);

                try {

                    $db = new DB();
                    $conn = $db->Open();
                    if ($conn) {

                        $query = "INSERT INTO users ( username, password, level, promotion ) VALUES (:username, :password, :level, :promotion) ";
                        $stmt  = $conn->prepare($query);
                        $stmt->bindValue(':username', $_POST['username']);
                        $stmt->bindValue(':password', $password);
                        $stmt->bindValue(':level', $_POST['level']);
                        $stmt->bindValue(':promotion', $_POST['promotion']);
                        $stmt->execute();
                        Messages::setMsg('Insert Successfully', 'success');
                    } else {
                        // echo $conn;
                        Messages::setMsg('Cannot connect to db', 'error');
                    }
                } catch (PDOException $ex) {
                    // echo $ex->getMessage();
                    Messages::setMsg('SQL Exception', 'error');
                }
            }
        }
    }

    public static function login()
    {

        $result = [];


        if (isset($_POST['submit'])) {
            $password = md5($_POST['password']);

            try {

                $db = new DB();
                $conn = $db->Open();
                if ($conn) {

                    $query = "SELECT * FROM users WHERE username=:username AND password=:password";
                    $stmt  = $conn->prepare($query);
                    $stmt->bindValue(':username', $_POST['username']);
                    $stmt->bindValue(':password', $password);
                    $stmt->execute();
                    $result = $stmt->fetch();

                    if (!empty($result)) {
                        $_SESSION['is_logged_in'] = true;
                        $_SESSION['user_data'] = array(
                            "id"     => $result['id'],
                            "username"    => $result['username'],
                            "level"    => $result['level']
                        );
                        Messages::setMsg('Welcome back ' . $result['username'] . ' !', 'success');
                    } else {
                        Messages::setMsg('Incorrect Login', 'error');
                    }
                } else {
                    // echo $conn;
                    Messages::setMsg('Cannot connect to db', 'error');
                }
            } catch (PDOException $ex) {
                // echo $ex->getMessage();
                Messages::setMsg('SQL Exception', 'error');
            }
        }



        Utility::removeFields($result, ["id", "password", "created_at"]);

        return $result;
    }

    public static function getAll()
    {
        $result = "";
        try {

            $db = new DB();
            $conn = $db->Open();
            if ($conn) {

                $query = "SELECT *  FROM users";
                $result  = $conn->query($query)->fetchAll();
            } else {
                // echo $conn;
                Messages::setMsg('Cannot connect to db', 'error');
            }
        } catch (PDOException $ex) {
            // echo $ex->getMessage();
            Messages::setMsg('Cannot connect to db', 'error');
        }

        Utility::removeFields($result, ["password"]);

        return $result;
    }
    public static function getOne()
    {
        $result = "";
        $id = "";
        try {

            $db = new DB();
            $conn = $db->Open();
            if (isset($_SESSION["user_data"])) {
                $id = $_SESSION["user_data"]["id"];
            }
            if ($conn) {

                $query = "SELECT *  FROM users where id=" . $id;
                $result  = $conn->query($query)->fetch();
            } else {
                // echo $conn;
                Messages::setMsg('Cannot connect to db', 'error');
            }
        } catch (PDOException $ex) {
            // echo $ex->getMessage();
            Messages::setMsg('Cannot connect to db', 'error');
        }


        Utility::removeFields($result, ["id", "password"]);
        return $result;
    }

    public static function update()
    {


        if (isset($_POST['submit'])) {
            try {

                $db = new DB();
                $conn = $db->Open();

                if ($conn) {


                    $sql = "UPDATE users set "
                        . "username=:username,"
                        . "level=:level,"
                        . "promotion=:promotion"
                        . " where id=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':username', $_POST["username"]);
                    $stmt->bindValue(':level', $_POST["level"]);
                    $stmt->bindValue(':promotion', $_POST["promotion"]);
                    $stmt->bindValue(':id', $_POST["id"]);
                    $stmt->execute();


                    Messages::setMsg('Update Successfully', 'success');
                } else {
                    // echo $conn;
                    Messages::setMsg('Cannot connect to db', 'error');
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                Messages::setMsg('Cannot connect to db', 'error');
            }
        }
    }

    public static function delete()
    {


        if (isset($_POST['submit'])) {
            try {

                $db = new DB();
                $conn = $db->Open();

                if ($conn) {
                    $sql = "delete from users " . "where id=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':id', $_POST["id"]);
                    $stmt->execute();
                    Messages::setMsg('Update Successfully', 'success');
                } else {
                    // echo $conn;
                    Messages::setMsg('Cannot connect to db', 'error');
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
                Messages::setMsg('Cannot connect to db', 'error');
            }
        }
    }
}
