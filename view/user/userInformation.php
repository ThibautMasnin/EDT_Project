<?php

require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");

?>

<div>


    <h2>user informations</h2>
</div>

<?php




if (isset($_SESSION["db_res"])) {
    print_r($_SESSION["db_res"]);
} else {
    $result = new UserController('User', 'getOne');
    $result->getOne();
}
?>


<?php
require_once(__DIR__ . "/../page/footer.php");
?>