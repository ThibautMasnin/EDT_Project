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

            CREATE TABLE IF NOT EXISTS `users` (
                `id` INTEGER PRIMARY KEY,
                `username` TEXT,
                `password` TEXT,
                `level` INTEGER NOT NULL,
                `promotion` INTEGER,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP                
              );      
            ";
            $conn->query($sql);

            $sql = "
              
              CREATE TABLE IF NOT EXISTS `cours` (
                `id` INTEGER PRIMARY KEY,
                `type` TEXT,
                `matiere` TEXT,
                `salle` INTEGER,
                `prof` user NOT NULL,
                `promo` Promotion,
                `debut` TIMESTAMP NOT NULL,
                `fin` TIMESTAMP NOT NULL              
              );
            ";
            $conn->query($sql);

            $sql = "INSERT or ignore INTO users(id,username,password,level) VALUES (1,'admin', 'e10adc3949ba59abbe56e057f20f883e', 0)";
            $conn->query($sql);
        } else {
            echo $conn;
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
