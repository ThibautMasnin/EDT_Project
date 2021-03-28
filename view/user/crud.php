<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
require_once(__DIR__ . "/../../middleware/adminOnly.php");
?>

<div class="container">
    <div class="row">
        <h3><?= strtoupper($tag) ?></h3>
    </div>
    <br />
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width: 100px;">Ajouter</button>
    <br /><br />


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
            <?php
            $result = Utility::getAll($tag);
            ?>
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
                <h5 class="modal-title">Edit</h5>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" value="<?= $tag ?>" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add</h5>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="create" value="<?= $tag ?>" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>