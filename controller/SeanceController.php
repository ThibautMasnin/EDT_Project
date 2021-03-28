<?php

class SeanceController extends Controller
{
    public function getAll()
    {
        $res = [];
        if (isset($_SESSION['is_logged_in'])) {
            $res = Seance::getAll();
        }

        return $res;
    }

    public function show()
    {

        $res = [];
        if (isset($_SESSION['is_logged_in'])) {
            $res = Seance::show();
        }

        return $res;
    }
}
