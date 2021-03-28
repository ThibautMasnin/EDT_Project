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
                `first_name` TEXT,
                `last_name` TEXT,
                `level` INTEGER NOT NULL,
                `promotion` INTEGER null,
                `depart` INTEGER null,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (level) REFERENCES role (id) on update cascade on delete set null
                FOREIGN KEY (promotion) REFERENCES promotion (id) on delete set null
                FOREIGN KEY (depart) REFERENCES department (id) on delete set null
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
                FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE set null,   
                FOREIGN KEY (promo_id) REFERENCES promotion (id) ON DELETE set null, 
                FOREIGN KEY (depart_id) REFERENCES department (id) ON DELETE set null
              );
            ";
      $conn->query($sql);

      $sql = "
            CREATE TABLE IF NOT EXISTS `seance` (
              `id` INTEGER PRIMARY KEY,
              `cours_id` integer null,
              `salle_id` integer null,
              `type_id` INTEGER null,
              `debut` TIMESTAMP NOT NULL,
              `fin` TIMESTAMP NOT NULL,
              FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE set null, 
              FOREIGN KEY (salle_id) REFERENCES salle (id), 
              FOREIGN KEY (type_id) REFERENCES type (id)              
            );
          ";
      $conn->query($sql);

      // dummy data 
      $sql = "INSERT or ignore INTO role(id,name) VALUES (1,'admin')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO role(id,name) VALUES (2,'enseignant')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO role(id,name) VALUES (3,'etudiant')";
      $conn->query($sql);

      $password = password_hash('123456', PASSWORD_BCRYPT);

      $sql = "INSERT or ignore INTO users(id,username,password,level) VALUES (1,'admin','$password', 1)";
      $conn->query($sql);


      $sql = "INSERT or ignore INTO promotion(id,name) VALUES (1,'L1')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO promotion(id,name) VALUES (2,'L2')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO promotion(id,name) VALUES (3,'L3')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO promotion(id,name) VALUES (4,'M1')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO promotion(id,name) VALUES (5,'M2')";
      $conn->query($sql);

      $sql = "INSERT or ignore INTO salle(id,name) VALUES (1,'A101')";
      $conn->query($sql);

      $sql = "INSERT or ignore INTO courstype(id,name) VALUES (1,'CM')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO courstype(id,name) VALUES (2,'TD')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO courstype(id,name) VALUES (3,'TP')";
      $conn->query($sql);


      $sql = "INSERT or ignore INTO department(id,name) VALUES (1,'Math')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO department(id,name) VALUES (2,'Info')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO department(id,name) VALUES (3,'SVT')";
      $conn->query($sql);
      $sql = "INSERT or ignore INTO department(id,name) VALUES (4,'Chimie')";
      $conn->query($sql);
    } else {
      echo $conn;
    }
  } catch (PDOException $ex) {
    echo $ex->getMessage();
  }
}
