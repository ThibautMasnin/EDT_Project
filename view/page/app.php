<?php
//our entry into the web application

//all the requests will pass through this file

// server should keep session data for AT LEAST 1 hour
ini_set('session.gc_maxlifetime', 3600);

// each client should remember their session id for EXACTLY 1 hour

session_set_cookie_params(3600, null, null, false, true);

session_start();


//load db
require_once(__DIR__ . "/../../db.php");
require_once(__DIR__ . "/../../config.php");

// create db for the first time
Createdb();
