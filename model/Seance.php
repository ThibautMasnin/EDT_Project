<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
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

    private static $base_sql = "SELECT seance.*, 
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

                $query = self::$base_sql . " limit ?,? ";

                $stmt = $conn->prepare($query);
                if (isset($limit) && isset($offset)) {
                    $stmt->execute(array($offset, $limit));
                    $tmp = $stmt->fetchAll();

                    if (!empty($tmp)) {
                        $rep = [];
                        foreach ($tmp as $val) {
                            $rep[] = new Seance($val);
                        }
                    }

                    $query = "SELECT COUNT(id) as total FROM (SELECT * FROM seance)";
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
            //echo $ex->getMessage();
            Messages::setMsg('Cannot connect to db', 'error');
        }


        return $result;
    }


    public static function show($requirement)
    {
        $start = new DateTime(date('Ymd', time()));

        if (isset($_POST['year']) and isset($_POST['week'])) {

            $start->setISODate($_POST['year'], $_POST['week']);
        } else {

            // today
            $start->setISODate($start->format('o'), $start->format('W'));
        }
        $end = new DateTime('@' . $start->getTimestamp());
        $end->modify('+7 day');



        $result = "";
        try {

            $db = new DB();
            $conn = $db->Open();
            if ($conn) {

                $query = self::$base_sql . $requirement . " and debut >= '" . $start->format('Y-m-d H:i:s') . "' and fin <= '" . $end->format('Y-m-d H:i:s') . "'";

                $stmt = $conn->prepare($query);
                if (isset($_POST['salle_id'])) {
                    $stmt->execute([$_POST['salle_id']]);
                } else if (isset($_POST['user_id'])) {
                    $stmt->execute([$_POST['user_id']]);
                } else if (isset($_POST['form_depart']) and isset($_POST['form_promo'])) {
                    $stmt->execute([$_POST['form_promo'], $_POST['form_depart']]);
                }


                $result = $stmt->fetchAll();
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



    public static function multipleAdd()
    {

        if (isset($_POST['create'])) {



            unset($_POST['controller']);
            unset($_POST['action']);
            $weekday = [
                isset($_POST['weekday0']),
                isset($_POST['weekday1']),
                isset($_POST['weekday2']),
                isset($_POST['weekday3']),
                isset($_POST['weekday4']),
                isset($_POST['weekday5']),
                isset($_POST['weekday6'])
            ];
            // foreach ($weekday as $k => $val) {
            //     echo $k . ',' . $val . ' ';
            // }
            // die();

            // total weeks
            $times = $_POST['semaines'];
            unset($_POST['semaines']);

            if (isset($_POST['weekday0'])) unset($_POST['weekday0']);
            if (isset($_POST['weekday1'])) unset($_POST['weekday1']);
            if (isset($_POST['weekday2'])) unset($_POST['weekday2']);
            if (isset($_POST['weekday3'])) unset($_POST['weekday3']);
            if (isset($_POST['weekday4'])) unset($_POST['weekday4']);
            if (isset($_POST['weekday5'])) unset($_POST['weekday5']);
            if (isset($_POST['weekday6'])) unset($_POST['weekday6']);



            $now = new DateTime(date('Ymd', time()));
            $now->setISODate($now->format('o'), $now->format('W'));
            //  print_r($now->format('Y-m-d H:i:s'));

            $dd = $_POST['debut'];
            $ff = $_POST['fin'];


            for ($i = 0; $i < $times; $i++) {

                $num_week = clone $now;
                if ($i != 0) {
                    $ww = '+' . $i * 7 . ' day';

                    $num_week->modify($ww);
                }

                foreach ($weekday as $k => $val) {
                    if (!empty($val)) {
                        $tmp_d = clone $num_week;
                        $tmp_f = clone $num_week;
                        if ($k != 0) {
                            $add = '+' . $k . ' day';
                            $tmp_d->modify($add);
                            $tmp_f->modify($add);
                        }




                        $interval_d = new DateInterval('P0000-00-00T' . $dd . ':00');
                        $interval_f = new DateInterval('P0000-00-00T' . $ff . ':00');
                        $tmp_d->add($interval_d);
                        $tmp_f->add($interval_f);
                        $_POST['debut'] = $tmp_d->format('Y-m-d H:i:s');
                        $_POST['fin'] = $tmp_f->format('Y-m-d H:i:s');
                        // print_r($_POST);
                        // die();
                        Utility::createData();
                    }
                }
            }
        }
    }
}
