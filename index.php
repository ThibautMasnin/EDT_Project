<?php
require_once(__DIR__ . "/view/page/app.php");
require_once(__DIR__ . "/view/page/header.php");
// create db for the first time
Createdb();
?>


<div class="container">
    <h2>This is home page</h2>
</div>

<?php
require_once(__DIR__ . "/view/page/footer.php");
?>