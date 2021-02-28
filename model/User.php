<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $level;
    public $promotion;
    public $created_at;

    // put the resultset of db into contructor to return to the controller
    public function __construct($id = "", $username = "", $level = "", $promotion = "", $created_at = "")
    {
        $this->id = $id;
        $this->username = $username;
        $this->level  = $level;
        $this->promotion  = $promotion;
        $this->created_at  = $created_at;
    }

    public static function register()
    {
        // Sanitize $_POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $password = md5($post['password']);

        if ($post['submit']) {

            // validate input before db operation
            if ($post['username'] == '' || $post['level'] == '' || $post['password'] == '') {
                Messages::setMsg('Please Fill In All Field', 'error');
                return;
            }

            try {

                $db = new DB();
                $conn = $db->Open();
                if ($conn) {

                    $query = "INSERT INTO users ( username, password, level, promotion ) VALUES (:username, :password, :level, :promotion) ";
                    $stmt  = $conn->prepare($query);
                    $stmt->bindValue(':username', $post['username']);
                    $stmt->bindValue(':password', $password);
                    $stmt->bindValue(':level', $post['level']);
                    $stmt->bindValue(':promotion', $post['promotion']);
                    $stmt->execute();
                    Messages::setMsg('Insert Successfully', 'success');
                } else {
                    // echo $conn;
                    Messages::setMsg('Incorrect Login', 'error');
                }
            } catch (PDOException $ex) {
                // echo $ex->getMessage();
                Messages::setMsg('Incorrect Login', 'error');
            }
        }
    }

    public static function login()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $result = [];

        $password = md5($post['password']);


        if ($post['submit']) {
            try {

                $db = new DB();
                $conn = $db->Open();
                if ($conn) {

                    $query = "SELECT * FROM users WHERE username=:username AND password=:password";
                    $stmt  = $conn->prepare($query);
                    $stmt->bindValue(':username', $post['username']);
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
                    } else {
                        Messages::setMsg('Incorrect Login', 'error');
                    }
                } else {
                    // echo $conn;
                    Messages::setMsg('Cannot connect to db', 'error');
                }
            } catch (PDOException $ex) {
                // echo $ex->getMessage();
                Messages::setMsg('Cannot connect to db', 'error');
            }
        } else {
            Messages::setMsg('Unauthrized access', 'error');
        }

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


        return $result;
    }

    public static function update()
    {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        if ($post['submit']) {
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
                    $stmt->bindValue(':username', $post["username"]);
                    $stmt->bindValue(':level', $post["level"]);
                    $stmt->bindValue(':promotion', $post["promotion"]);
                    $stmt->bindValue(':id', $post["id"]);
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
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($post['submit']) {
            try {

                $db = new DB();
                $conn = $db->Open();

                if ($conn) {
                    $sql = "delete from users " . "where id=:id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(':id', $post["id"]);
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
