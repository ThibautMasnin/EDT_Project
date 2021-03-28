<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<div class="container">
    <div class="row">
        <h3>SEANCES</h3>
    </div>
    <br />
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width: 100px;">Ajouter</button>
    <br /><br />
    <table class="table table-hover table-striped border">
        <thead class="bg-dark text-light">
            <tr>
                <th>ID</th>
                <th>Nom de cours</th>
                <th>Salle</th>
                <th>Type de cours</th>
                <th>debut</th>
                <th>fin</th>
                <th>Nom d'enseignant</th>
                <th>Sujet</th>
                <th>Gestion</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php


            $result = new SeanceController('getAll');
            $result = $result->getAll();
            //  print_r($result);
            ?>
            <?php if (!empty($result)) : ?>
                <?php foreach ($result as $rec) : ?>
                    <?php $tmp_id = $rec->id; ?>
                    <tr>

                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->id ?>"> <?php echo $rec->id;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->cours_id ?>"> <?php echo $rec->cours;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->salle_id ?>"> <?php echo $rec->salle;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->type_id ?>"> <?php echo $rec->type;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->debut ?>"> <?php echo $rec->debut;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->fin ?>"> <?php echo $rec->fin;  ?> </td>
                        <td data-id="<?= $tmp_id ?>" db="<?= $rec->nom_enseignant ?>"> <?php echo $rec->nom_enseignant;  ?> </td>
                        <td> <?php echo $rec->promo . " " . $rec->depart;  ?> </td>


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


                                    <td>
                                        <select name="cours_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (COURS_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>

                                </tr>
                                <tr>
                                    <th>SALLE : </th>
                                    <td>
                                        <select name="salle_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (SALLE_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>TYPE :</th>
                                    <td>
                                        <select name="type_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (TYPE_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>DEBUT : </th>
                                    <td>
                                        <input type="datetime-local" name="debut" class="input-update">

                                    </td>
                                </tr>

                                <tr>
                                    <th>FIN : </th>
                                    <td>
                                        <input type="datetime-local" name="fin" class="input-update">

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" value="seance" class="btn btn-primary">Save changes</button>
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
                                    <td>
                                        <select name="cours_id" class="input-update">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (COURS_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>SALLE : </th>
                                    <td>
                                        <select name="salle_id">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (SALLE_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>TYPE :</th>
                                    <td>
                                        <select name="type_id">

                                            <option value=""> <?= "" ?></option>
                                            <?php foreach (TYPE_ARR as $val) : ?>

                                                <option value="<?= $val['id'] ?>"> <?= $val['name'] ?></option>

                                            <?php endforeach; ?>

                                        </select>

                                    </td>
                                </tr>
                                <tr>
                                    <th>DEBUT : </th>
                                    <td>
                                        <input type="datetime-local" name="debut">

                                    </td>
                                </tr>

                                <tr>
                                    <th>FIN : </th>
                                    <td>
                                        <input type="datetime-local" name="fin">

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </fieldset>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="create" value="seance" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>