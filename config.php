<?php
require_once(__DIR__ . "/classes/Utility.php");

$allRoles = Utility::getAll('role');
$allPromo = Utility::getAll('promotion');
$allDepart = Utility::getAll('department');
$allSalle = Utility::getAll('salle');
$allType = Utility::getAll('courstype');
$allCours = Utility::getAll('cours');




define("ADMIN_ROLE", $allRoles[0]['id']);
define("PROF_ROLE", $allRoles[1]['id']);
define("ETU_ROLE", $allRoles[2]['id']);



define("ROLE_ARR", $allRoles);
define("PROMO_ARR", $allPromo);
define("DEPART_ARR", $allDepart);
define("SALLE_ARR", $allSalle);
define("TYPE_ARR", $allType);
define("COURS_ARR", $allCours);
