<?php

class SeanceController extends Controller
{
    public function getAll($offset = null, $limit = null)
    {
        $res = [];
        if (isset($_SESSION['is_logged_in'])) {
            $res = Seance::getAll($offset, $limit);
        }

        return $res;
    }

    public function show()
    {


        $res = [];
        if (isset($_SESSION['is_logged_in'])) {

            if (isset($_POST['seance_by'])) {
                $_SESSION['seance_by']['id'] = $_POST['seance_by'];
            }

            if (isset($_POST['form_promo']) and isset($_POST['form_depart']) and  $_SESSION['seance_by']['id'] == 1) {

                $_SESSION['seance_by']['content'] = [$_POST['form_promo'], $_POST['form_depart']];

                $tmp = " where promo_id = ? and depart_id = ? ";
                $res = Seance::show($tmp);
            } else if (isset($_POST['user_id']) and  $_SESSION['seance_by']['id'] == 2) {

                $_SESSION['seance_by']['content'] = [$_POST['user_id']];

                $tmp = " where user_id = ? ";
                $res = Seance::show($tmp);
            } else if (isset($_POST['salle_id']) and  $_SESSION['seance_by']['id'] == 3) {

                $_SESSION['seance_by']['content'] = [$_POST['salle_id']];

                $tmp = " where salle_id = ? ";
                $res = Seance::show($tmp);
            }
        }



        $_SESSION["calendar"] = $res;
    }


    public function multipleAdd()
    {
        if ($_SESSION['user_data']['level'] <= PROF_ROLE) {

            Seance::multipleAdd();
        }
    }
}
