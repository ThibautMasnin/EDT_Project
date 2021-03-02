<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");

?>

<div>


    <h2>user informations</h2>
</div>

<?php


$result = new UserController('getOne');
$result = $result->getOne();
print_r($result);

?>



<?php
require_once(__DIR__ . "/../page/footer.php");
?>