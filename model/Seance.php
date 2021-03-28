<?php

class Seance
{
    public $id;
    public $cours_id;
    public $cours;
    public $type_id;
    public $type;
    public $salle_id;
    public $salle;
    public $debut;
    public $fin;

    public $user_id;
    public $nom_enseignant;
    public $promo;
    public $depart;


    public function __construct($arr)
    {

        $this->id = $arr['id'];
        $this->cours_id = $arr['cours_id'];
        $this->cours = $arr["cours"];
        $this->user_id = $arr['user_id'];
        $this->nom_enseignant = $arr['first_name'] . " " . $arr['last_name'];
        $this->promo_id = $arr['promo_id'];
        $this->promo = $arr["promo"];
        $this->depart_id = $arr['depart_id'];
        $this->depart = $arr["depart"];
        $this->salle_id = $arr["salle_id"];
        $this->salle = $arr['salle'];
        $this->debut = $arr['debut'];
        $this->fin = $arr['fin'];

        $this->type_id = $arr['type_id'];
        $this->type = $arr['type'];
    }



    public static function getAll()
    {
        $result = "";
        try {

            $db = new DB();
            $conn = $db->Open();
            if ($conn) {

                $query = "SELECT seance.*, 
                cours.name as cours,
                users.id as user_id,
                users.first_name,
                users.last_name,
                salle.name as salle,courstype.name as type,
                department.id as depart_id,
                department.name as depart,
                promotion.id as promo_id,
                promotion.name as promo
                FROM seance 
                left join salle on seance.salle_id=salle.id 
                left join cours on seance.cours_id =cours.id
                left join users on cours.user_id=users.id 
                left join promotion on cours.promo_id=promotion.id 
                left join department on cours.depart_id=department.id
                left join courstype on seance.type_id=courstype.id 
                ";
                $result  = $conn->query($query)->fetchAll();
            } else {
                // echo $conn;
                Messages::setMsg('Cannot connect to db', 'error');
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            Messages::setMsg('Cannot connect to db', 'error');
        }

        if (!empty($result)) {
            $rep = [];
            foreach ($result as $val) {
                $rep[] = new Seance($val);
            }

            return $rep;
        }


        return $result;
    }

    public static function show()
    {
        $result = "";
        try {

            $db = new DB();
            $conn = $db->Open();
            if ($conn) {

                $query = "SELECT seance.*, 
                cours.name as cours,
                users.id as user_id,
                users.first_name,
                users.last_name,
                salle.name as salle,courstype.name as type,
                department.id as depart_id,
                department.name as depart,
                promotion.id as promo_id,
                promotion.name as promo
                FROM seance 
                left join salle on seance.salle_id=salle.id 
                left join cours on seance.cours_id =cours.id
                left join users on cours.user_id=users.id 
                left join promotion on cours.promo_id=promotion.id 
                left join department on cours.depart_id=department.id
                left join courstype on seance.type_id=courstype.id 
                ";
                $result  = $conn->query($query)->fetchAll();
            } else {
                // echo $conn;
                Messages::setMsg('Cannot connect to db', 'error');
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            Messages::setMsg('Cannot connect to db', 'error');
        }

        if (!empty($result)) {
            $rep = [];
            foreach ($result as $val) {
                $rep[] = new Seance($val);
            }

            return $rep;
        }
        return $result;
    }
}
