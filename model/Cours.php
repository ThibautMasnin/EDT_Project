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



    public static function getAll($offset = null, $limit = null)
    {


        if ($limit < 0) {
            Messages::setMsg("wrong limit", "error");
            return;
        }
        if ($offset < 0) {
            Messages::setMsg("wrong offset", "error");
            return;
        }
        $result = '';
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
                limit ?,?
                ";

                $stmt  = $conn->prepare($query);
                if (isset($limit) && isset($offset)) {
                    $stmt->execute(array($offset, $limit));
                    $tmp = $stmt->fetchAll();

                    if (!empty($tmp)) {
                        $rep = [];
                        foreach ($tmp as $val) {
                            $rep[] = new Cours($val);
                        }
                    }

                    $query = "SELECT COUNT(id) as total FROM (SELECT * FROM cours)";
                    $stmt  = $conn->prepare($query);
                    $stmt->execute();
                    $total = $stmt->fetch();
                    $result = [];
                    $result["res"] = $rep;
                    $result["total"] = $total;
                }
            } else {
                // echo $conn;
                Messages::setMsg('Cannot connect to db', 'error');
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            Messages::setMsg('Cannot connect to db', 'error');
        }


        return $result;
    }
}
