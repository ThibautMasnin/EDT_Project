<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");

?>

<?php


$result = new UserController('getOne');
$result = $result->getOne();

?>
<div class="tab-content ml-1" id="myTabContent">
    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
        <hr/>
        <?php foreach ($result as $k => $val) : ?>
            <div class="row">
                <div class="col-sm-3 col-md-2 col-5">
                    <label style="font-weight:bold;"> <?= strtoupper($k) ?></label>
                </div>
                <div class="col-md-8 col-6">
                    <?= $val ?>
                </div>
            </div>
            <hr/>
        <?php endforeach; ?>


    </div>
</div>




<?php
require_once(__DIR__ . "/../page/footer.php");
?>