<?php

class CoursController extends Controller
{
    public function getAll($offset = null, $limit = null)
    {
        $res = [];
        if ($_SESSION['user_data']['level'] <= PROF_ROLE) {
            $res = Cours::getAll($offset, $limit);
        }

        return $res;
    }
}
