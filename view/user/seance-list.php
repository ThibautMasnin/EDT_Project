<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");






$offset = 0;
$limit = 3;



if (!empty($_POST["limit"])) {
    $limit = $_POST["limit"];
    $_SESSION["limit"] = $limit;
} else if (isset($_SESSION["limit"])) {
    $limit = $_SESSION["limit"];
}



if (isset($_POST["previous"]) || isset($_POST["next"])) {

    $total_pages = ceil(Utility::getMax('seance')["total"] / $limit);


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

    $res =  new SeanceController('getAll');
    $res = $res->getAll($offset, $limit);
    $result = $res["res"];
} else {

    $res =  new SeanceController('getAll');
    $res = $res->getAll($offset, $limit);

    if (!empty($res)) {
        $result = $res["res"];
        $total_pages = ceil($res["total"]["total"] / $limit);
        $current = 1;
    }
}



?>

<div class="container">
    <div class="row">
        <h3>SEANCES</h3>
    </div>
    <br />


    <div class="row">

        <div class="col-2">

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width: 100px;">Ajouter</button>

        </div>
        <div class="col-2">

            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPlusModal" style="width: 100px;">Repetition</button>

        </div>
        <div class="col-4">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="col input-group mb-3">

                    <input name="limit" type="number" min="1" class="form-control" placeholder="<?= isset($_SESSION["limit"]) ? $_SESSION["limit"] : 3 ?> rangs par page">
                    <button type="submit" class="btn btn-info" type="button">Rafraichir</button>
                </div>
        </div>
        <div class="col-4">
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
                                        <button class="btn btn-danger" type="submit" name="delete" value="seance">Supprimer</button>
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
                                        <input type="datetime-local" step="1800" name="debut" class="input-update">

                                    </td>
                                </tr>

                                <tr>
                                    <th>FIN : </th>
                                    <td>
                                        <input type="datetime-local" step="1800" name="fin" class="input-update">

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
                                        <input type="datetime-local" step="1800" name="debut">

                                    </td>
                                </tr>

                                <tr>
                                    <th>FIN : </th>
                                    <td>
                                        <input type="datetime-local" step="1800" name="fin">

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



<div class="modal fade" id="addPlusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Repeat</h5>
            </div>
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="modal-body">
                    <input type="hidden" name="controller" value="SeanceController">
                    <input type="hidden" name="action" value="multipleAdd">

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
                                        <input type="time" step="1800" name="debut">

                                    </td>
                                </tr>

                                <tr>
                                    <th>FIN : </th>
                                    <td>
                                        <input type="time" step="1800" name="fin">

                                    </td>
                                </tr>

                                <tr>
                                    <th>Chaque</th>
                                    <td>
                                        <input type="checkbox" name="weekday0" value="0" checked>
                                        <label for="weekday">Lundi</label>
                                        <input type="checkbox" name="weekday1" value="1">
                                        <label for="weekday">Mardi</label>
                                        <input type="checkbox" name="weekday2" value="2">
                                        <label for="weekday">Mercredi</label>
                                        <input type="checkbox" name="weekday3" value="3">
                                        <label for="weekday">Jeudi</label>
                                        <input type="checkbox" name="weekday4" value="4">
                                        <label for="weekday">Vendredi</label>
                                        <input type="checkbox" name="weekday5" value="5">
                                        <label for="weekday">Samedi</label>
                                        <input type="checkbox" name="weekday6" value="6">
                                        <label for="weekday">Dimanche</label>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pour (Combien de semaines)</th>
                                    <td>
                                        <select name="semaines">
                                            <?php for ($z = 1; $z <= 15; $z++) : ?>

                                                <option value="<?= $z ?>"><?= $z ?></option>

                                            <?php endfor; ?>

                                        </select>
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