<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
require_once(__DIR__ . "/../../middleware/adminOnly.php");




$offset = 0;
$limit = 3;

if (!empty($_POST["limit"])) {
    $limit = $_POST["limit"];
    $_SESSION["limit"] = $limit;
} else if (isset($_SESSION["limit"])) {
    $limit = $_SESSION["limit"];
}



if (isset($_POST["previous"]) || isset($_POST["next"])) {

    $total_pages = ceil(Utility::getMax($tag)["total"] / $limit);


    if (isset($_POST["previous"])) {
        $current = $_POST["current"] - 1;
    } elseif (isset($_POST["next"])) {
        $current = $_POST["current"] + 1;
    }

    if ($current == 1) {
        $offset = 0;
    } else {
        $offset = ($current - 1) * $limit;
    }



    $res = Utility::getAll($tag, $offset, $limit);
    $result = $res["res"];
} else {

    $res = Utility::getAll($tag, $offset, $limit);
    if (!empty($res)) {
        $result = $res["res"];
        $total_pages = ceil($res["total"]["total"] / $limit);
        $current = 1;
    }
}



?>

<div class="container">
    <div class="row">
        <h3><?= strtoupper($tag) ?></h3>
    </div>
    <br />



    <div class="row">

        <div class="col-2">

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width: 100px;">Ajouter</button>

        </div>
        <div class="col-4">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="col input-group mb-3">

                    <input name="limit" type="number" min="1" class="form-control" placeholder="<?= isset($_SESSION["limit"]) ? $_SESSION["limit"] : 3 ?> rangs par page">
                    <button type="submit" class="btn btn-info" type="button">Rafraichir</button>
                </div>
        </div>
        <div class="col-6">
            <input type="hidden" name="max" value="<?= $total_pages ?>" />
            <ul class="col pagination justify-content-end">
                <li class="page-item <?= $current <= 1 ? "disabled" : "" ?>">
                    <input type="submit" name="previous" value="Previous" class="page-link" />
                </li>
                <input type="hidden" name="current" value="<?= $current ?>" />
                <li class="page-item"><a class="page-link" href="#"><?= $current ?></a></li>
                <li class="page-item <?= $current == $total_pages ? "disabled" : "" ?>">
                    <input type="submit" name="next" value="Next" class="page-link" />
                </li>
            </ul>
        </div>

        </form>

    </div>



    <table class="table table-hover table-striped border">

        <thead class="bg-dark text-light">
            <tr>
                <?php

                foreach ($table_form as $val) {
                    echo "<th>" . strtoupper($tag) . "_" . strtoupper($val) . "</th>";
                }
                ?>
                <th>Gestion</th>

            </tr>
        </thead>
        <tbody id="tbody">

            <?php if (!empty($result)) : ?>
                <?php foreach ($result as $rec) : ?>
                    <?php $tmp_id = $rec['id']; ?>
                    <tr>
                        <?php foreach ($rec as $val) : ?>
                            <td data-id="<?= $tmp_id ?>" db="<?= $val ?>">
                                <?php echo $val; ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <div class="row">
                                <div class="col-md-4">

                                    <button class="btn btn-primary btnedit" data-id="<?= $tmp_id ?>" data-bs-toggle="modal" data-bs-target="#modifyModal" style="width: 100px;">Modifier</button>

                                </div>
                                <div class="col-md-4">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="controller" value="UserController">
                                        <input type="hidden" name="action" value="crud">
                                        <input type="hidden" name="id" value="<?= $tmp_id ?>" />
                                        <button class="btn btn-danger" type="submit" name="delete" value="<?= $tag ?>" style="width: 100px;">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="modifyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier</h5>
            </div>
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="modal-body">
                    <input type="hidden" name="controller" value="UserController">
                    <input type="hidden" name="action" value="crud">

                    <fieldset>
                        <table>
                            <tbody>
                                <tr>
                                    <td> <input type="hidden" class="input-update" name="id" /></td>
                                </tr>
                                <?php foreach ($table_form as $val) : ?>
                                    <?php if ($val != "id" and $val != "created_at") : ?>
                                        <tr>
                                            <th><?= strtoupper($val) ?> :</th>
                                            <td><input type="text" class="input-update" name="<?= $val ?>" /></td>
                                        </tr>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="update" value="<?= $tag ?>" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter</h5>
            </div>
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="modal-body">
                    <input type="hidden" name="controller" value="UserController">
                    <input type="hidden" name="action" value="crud">

                    <fieldset>
                        <table>
                            <tbody>
                                <fieldset>
                                    <table>
                                        <tbody>

                                            <?php foreach ($table_form as $val) : ?>
                                                <?php if ($val != "id" and $val != "created_at") : ?>
                                                    <tr>
                                                        <th><?= strtoupper($val) ?> :</th>
                                                        <td><input type="text" class="input-update" name="<?= $val ?>" /></td>
                                                    </tr>
                                                <?php endif; ?>

                                            <?php endforeach; ?>

                                        </tbody>
                                    </table>
                                </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" name="create" value="<?= $tag ?>" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>