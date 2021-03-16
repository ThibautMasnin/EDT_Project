<?php

class DB
{

    protected $conn = null;

    public function open()
    {
        try {
            $this->conn = new PDO("sqlite:" . $_SERVER['DOCUMENT_ROOT'] . "/edt.db", 0666);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //   $this->conn->exec('PRAGMA foreign_keys = ON;');
            return $this->conn;
        } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    // public function getTables()
    // {
    //     $tables = [];
    //     try {
    //         $conn = $this->open();
    //         if ($conn) {
    //             $query = "SELECT * FROM sqlite_master where type='table'";
    //             $stmt  = $conn->prepare($query);
    //             $stmt->execute();
    //             $result = $stmt->fetchAll();
    //             foreach ($result as $val) {
    //                 $tables[] = $val["name"];
    //             }
    //         } else {
    //             // echo $conn;
    //         }
    //     } catch (PDOException $ex) {
    //         // echo $ex->getMessage();
    //     }
    //     return $tables;
    // }

    // public function getColunmns($table_name)
    // {
    //     $table_fields = [];
    //     try {
    //         $conn = $this->open();
    //         if ($conn) {
    //             $stmt  = $conn->prepare("pragma table_info(" . $table_name . ");");
    //             $stmt->execute();
    //             $result = $stmt->fetchAll();
    //             foreach ($result as $val) {
    //                 $table_fields[] = $val["name"];
    //             }

    //             return $table_fields;
    //         } else {
    //             return NUlL;
    //         }
    //     } catch (PDOException $ex) {
    //         return NULL;
    //     }
    // }



    public function close()
    {
        $this->conn = null;
    }
}

function createDb()
{
    try {
        $db = new DB();
        $conn = $db->open();
        if ($conn) {
            $sql = "

            CREATE TABLE IF NOT EXISTS `courstype` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP                
              );      
            ";
            $conn->query($sql);

            $sql = "

            CREATE TABLE IF NOT EXISTS `salle` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP                
              );      
            ";
            $conn->query($sql);
            $sql = "

            CREATE TABLE IF NOT EXISTS `department` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP                
              );      
            ";
            $conn->query($sql);

            $sql = "

            CREATE TABLE IF NOT EXISTS `role` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP                
              );      
            ";
            $conn->query($sql);

            $sql = "

            CREATE TABLE IF NOT EXISTS `promotion` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP                
              );      
            ";
            $conn->query($sql);

            $sql = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` INTEGER PRIMARY KEY,
                `username` TEXT,
                `password` TEXT,
                `level` INTEGER NOT NULL,
                `promotion` INTEGER null,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (level) REFERENCES role (id),
                FOREIGN KEY (promotion) REFERENCES promotion (id)
                );
            ";
            $conn->query($sql);


            $sql = "
              CREATE TABLE IF NOT EXISTS `cours` (
                `id` INTEGER PRIMARY KEY,
                `name` TEXT,
                `user_id` INTEGER null,
                `promo_id` INTEGER null,
                `depart_id` INTEGER null,
                FOREIGN KEY (user_id) REFERENCES users (id),   
                FOREIGN KEY (promo_id) REFERENCES promotion (id),  
                FOREIGN KEY (depart_id) REFERENCES department (id)
              );
            ";
            $conn->query($sql);

            $sql = "
            CREATE TABLE IF NOT EXISTS `seances` (
              `id` INTEGER PRIMARY KEY,
              `cours_id` integer null,
              `salle_id` integer null,
              `type_id` INTEGER null,
              `debut` TIMESTAMP NOT NULL,
              `fin` TIMESTAMP NOT NULL,
              FOREIGN KEY (cours_id) REFERENCES cours (id), 
              FOREIGN KEY (salle_id) REFERENCES salle (id), 
              FOREIGN KEY (type_id) REFERENCES type (id)              
            );
          ";
            $conn->query($sql);

            $password = password_hash('123456', PASSWORD_BCRYPT);

            $sql = "INSERT or ignore INTO users(id,username,password,level) VALUES (1,'admin','$password', 0)";
            $conn->query($sql);
        } else {
            echo $conn;
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
