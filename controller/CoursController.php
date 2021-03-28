<?php

class CoursController extends Controller
{
    public function getAll()
    {
        $res = [];
        if ($_SESSION['user_data']['level'] <= PROF_ROLE) {
            $res = Cours::getAll();
        }

        return $res;
    }
}
