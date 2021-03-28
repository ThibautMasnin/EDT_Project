<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<div class="container">
    <div class="row">
        <h3>UTILISATEURS</h3>
    </div>
    <br />
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width: 100px;">Ajouter</button>
    <br /><br />
    <table class="table table-hover table-striped border">
        <thead class="bg-dark text-light">
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>first_name</th>
                <th>last_name</th>
                <th>Rang</th>
                <th>Promotion</th>
                <th>Departement</th>
                <th>Création</th>
                <th>Gestion</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php

            $result = new UserController('getAll');
            $result = $result->getAll();


            ?>
            <?php if (!empty($result)) : ?>
                <?php foreach ($result as $rec) : ?>
                    <?php $tmp_id = $rec['id']; ?>
                    <tr>
                        <?php foreach ($rec as $k => $val) : ?>
                            <td data-id="<?= $tmp_id ?>" db="<?= $val ?>">

                                <?php
                                if ($k == 'level') {
                                    echo ucfirst(ROLE_ARR[array_search($val, array_column(ROLE_ARR, 'id'))]['name']);
                                } else if ($k == 'promotion' and !empty($val)) {
                                    echo PROMO_ARR[array_search($val, array_column(PROMO_ARR, 'id'))]['name'];
                                } else if ($k == 'depart' and !empty($val)) {
                                    echo DEPART_ARR[array_search($val, array_column(DEPART_ARR, 'id'))]['name'];
                                } else {
                                    echo $val;
                                }

                                ?>
                            </td>
                        <?php endforeach; ?>
                        <td>
                            <div class="row">
                                <div class="col-md-4">

                                    <button class="btn btn-primary btnedit" data-id="<?= $tmp_id ?>" data-bs-toggle="modal" data-bs-target="#modifyModal">Modifier</button>

                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="controller" value="UserController">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $tmp_id ?>" />
                                        <button class="btn btn-danger" type="submit" name="submit" value="submit">Supprimer</button>
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
                    <input type="hidden" name="action" value="update">

                    <fieldset>
                        <table>
                            <tbody>
                                <tr>
                                    <td> <input type="hidden" class="input-update" name="id" /></td>
                                </tr>
                                <tr>
                                    <th>Identifiant : </th>
                                    <td><input type="text" class="input-update" name="username" /></td>
                                </tr>

                                <tr>
                                    <th>Prénom : </th>
                                    <td><input type="text" class="input-update" name="first_name" /></td>
                                </tr>
                                <tr>
                                    <th>Nom : </th>
                                    <td><input type="text" class="input-update" name="last_name" /></td>
                                </tr>
                                <tr>
                                    <th>Type :</th>
                                    <td>
                                        <select name="level" class="input-update">
                                            <?php foreach (ROLE_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Promotion (Only for students) :</th>
                                    <td>
                                        <select name="promotion" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (PROMO_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>

                                <tr>
                                    <th>Departement (Only for students) :</th>
                                    <td>
                                        <select name="depart" class="input-update">

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
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Save changes</button>
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
                    <input type="hidden" name="action" value="register">

                    <fieldset>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Identifiant : </th>
                                    <td><input type="text" name="username" value="<?= time() ?>" readonly /></td>
                                </tr>
                                <tr>
                                    <th>Mot de Passe : </th>
                                    <td><input type="text" name="password" value="<?= time() ?>" readonly /></td>
                                </tr>

                                <tr>
                                    <th>Prénom : </th>
                                    <td><input type="text" name="first_name" /></td>
                                </tr>
                                <tr>
                                    <th>Nom : </th>
                                    <td><input type="text" name="last_name" /></td>
                                </tr>
                                <tr>
                                    <th>Type :</th>
                                    <td>
                                        <select name="level">


                                            <?php foreach (ROLE_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>


                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Promotion (Only for students) :</th>
                                    <td>
                                        <select name="promotion">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (PROMO_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>

                                <tr>
                                    <th>Departement (Only for students) :</th>
                                    <td>
                                        <select name="depart">

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
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>