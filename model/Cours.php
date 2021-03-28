<?php

class Cours
{
    public $id;
    public $name;
    public $nom_enseignant;
    public $user_id;
    public $promo_id;
    public $depart_id;
    public $promo;
    public $depart;


    public function __construct($arr)
    {

        $this->id = $arr['id'];
        $this->name = $arr['name'];
        $this->user_id = $arr['user_id'];
        $this->promo_id = $arr['promo_id'];
        $this->depart_id = $arr['depart_id'];
        $this->nom_enseignant = $arr['first_name'] . " " . $arr['last_name'];
        $this->promo = $arr["promo"];
        $this->depart = $arr["depart"];
    }



    public static function getAll()
    {
        $result = "";
        try {

            $db = new DB();
            $conn = $db->Open();
            if ($conn) {

                $query = "SELECT cours.*,
                users.first_name,users.last_name,
                promotion.name as promo,department.name as depart
                FROM cours 
                left join users on cours.user_id=users.id 
                left join promotion on cours.promo_id=promotion.id 
                left join department on cours.depart_id=department.id 
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
                $rep[] = new Cours($val);
            }

            return $rep;
        }

        return $result;
    }
}
