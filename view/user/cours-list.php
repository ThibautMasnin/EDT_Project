<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<div class="container">
    <div class="row">
        <h3>COURS</h3>
    </div>
    <br />
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width: 100px;">Ajouter</button>
    <br /><br />
    <table class="table table-hover table-striped border">
        <thead class="bg-dark text-light">
            <tr>
                <th>ID</th>
                <th>Nom de cours</th>
                <th>Nom d'enseignant</th>
                <th>Promotion</th>
                <th>Departement</th>
                <th>Gestion</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php

            //   $result = Utility::getAll("cours");

            $result = new CoursController('getAll');
            $result = $result->getAll();
            ?>
            <?php if (!empty($result)) : ?>
                <?php foreach ($result as $rec) : ?>
                    <?php $tmp_id = $rec->id; ?>
                    <tr>

                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->id ?>"> <?php echo $rec->id;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->name ?>"> <?php echo $rec->name;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->user_id ?>"> <?php echo $rec->nom_enseignant;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->promo_id ?>"> <?php echo $rec->promo;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->depart_id ?>"> <?php echo $rec->depart;  ?> </td>

                        <td>
                            <div class="row">
                                <div class="col-md-4">

                                    <button class="btn btn-primary btnedit" data-id="<?= $tmp_id ?>" data-bs-toggle="modal" data-bs-target="#modifyModal">Modifier</button>

                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="controller" value="UserController">
                                        <input type="hidden" name="action" value="crud">
                                        <input type="hidden" name="id" value="<?= $tmp_id ?>" />
                                        <button class="btn btn-danger" type="submit" name="delete" value="cours">Supprimer</button>
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

                                <tr>
                                    <th>Nom du Cours : </th>
                                    <td><input type="text" name="name" class="input-update" /></td>
                                </tr>
                                <tr>
                                    <th>Enseignant : </th>
                                    <?php
                                    $teachers = new UserController('getAllTeachers');
                                    $teachers = $teachers->getAllTeachers();
                                    ?>

                                    <td>
                                        <select name="user_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach ($teachers as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['first_name'] . " " . $val['last_name']  ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Promotion :</th>
                                    <td>
                                        <select name="promo_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (PROMO_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Departement :</th>
                                    <td>
                                        <select name="depart_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (DEPART_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" value="cours" class="btn btn-primary">Save changes</button>
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

                                <tr>
                                    <th>Nom du Cours : </th>
                                    <td><input type="text" name="name" /></td>
                                </tr>
                                <tr>
                                    <th>Enseignant : </th>
                                    <td>
                                        <select name="user_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach ($teachers as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['first_name'] . " " . $val['last_name']  ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Promotion :</th>
                                    <td>
                                        <select name="promo_id">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (PROMO_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Departement :</th>
                                    <td>
                                        <select name="depart_id">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (DEPART_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="create" value="cours" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>