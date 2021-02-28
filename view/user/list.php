<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<div class="container">
    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
    <table class="table table-dark table-hover table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Level</th>
                <th>Promotion</th>
                <th>Created_at</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php

            $result = new UserController('getAll');
            $result = $result->getAll();


            ?>
            <?php foreach ($result as $rec) : ?>
                <?php $tmp_id = $rec['id'];
                unset($rec["password"]); ?>
                <tr>
                    <?php foreach ($rec as $val) : ?>
                        <td data-id="<?= $tmp_id ?>">
                            <?php echo $val; ?>
                        </td>
                    <?php endforeach; ?>
                    <td>
                        <div class="row">
                            <div class="col"><button class="btn-outline-info btnedit" data-id="<?= $tmp_id ?>" data-bs-toggle="modal" data-bs-target="#modifyModal">Modify</button></div>
                            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="controller" value="UserController">
                                <input type="hidden" name="action" value="delete">

                                <input type="hidden" name="id" value="<?= $tmp_id ?>" />
                                <div class="col"><button class="btn-outline-danger" type="submit" name="submit" value="submit">Delete</button></div>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

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
                                    <th>UserName : </th>
                                    <td><input type="text" class="input-update" name="username" /></td>
                                </tr>
                                <tr>
                                    <th>Level :</th>
                                    <td><input type="number" class="input-update" name="level" /></td>
                                </tr>
                                <tr>
                                    <th>Promotion :</th>
                                    <td><input type="text" class="input-update" name="promotion" /></td>
                                </tr>
                                <tr>
                                    <td><input type="hidden" class="input-update" /></td>
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
                                    <td> <input type="hidden" name="id" /></td>
                                </tr>
                                <tr>
                                    <th>UserName : </th>
                                    <td><input type="text" name="username" value="<?= time() ?>" read-only /></td>
                                </tr>
                                <tr>
                                    <th>Password : </th>
                                    <td><input type="text" name="password" value="<?= time() ?>" read-only /></td>
                                </tr>
                                <tr>
                                    <th>Level :</th>
                                    <td><input type="number" name="level" /></td>
                                </tr>
                                <tr>
                                    <th>Promotion :</th>
                                    <td><input type="text" name="promotion" /></td>
                                </tr>
                                <tr>
                                    <td><input type="hidden" /></td>
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