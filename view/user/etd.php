<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");

?>
<div>
    <h2>SERVICE ETD</h2>
</div>
<?php if ($_SESSION["user_data"]["level"] == ADMIN_ROLE) : ?>

    <?php

    $offset = 0;
    $limit = 3;

    if (!empty($_POST["limit"])) {
        $limit = $_POST["limit"];
        $_SESSION["limit"] = $limit;
    } else if (isset($_SESSION["limit"])) {
        $limit = $_SESSION["limit"];
    }



    if (isset($_POST["previous"]) || isset($_POST["next"])) {
        $res = Utility::etd_all();
        $total_pages = ceil($res["total"]["total"] / $limit);


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


        $res =  Utility::etd_all($offset, $limit);
        $result = $res["res"];
    } else {

        $res = Utility::etd_all($offset, $limit);

        if (!empty($res)) {
            $result = $res["res"];
            $total_pages = ceil($res["total"]["total"] / $limit);
            $current = 1;
        }
    }



    ?>

    <div class="container">
        <div class="row">

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
                    <th>USER_ID</th>
                    <th>PRRNOM</th>
                    <th>NOM</th>
                    <th>heures totales</th>
                </tr>
            </thead>
            <tbody id="tbody">

                <?php if (!empty($result)) : ?>
                    <?php foreach ($result as $rec) : ?>

                        <tr>

                            <td>
                                <?php echo $rec['user_id']; ?>
                            </td>

                            <td>
                                <?php echo $rec['first_name']; ?>
                            </td>
                            <td>
                                <?php echo $rec['last_name']; ?>
                            </td>
                            <td>
                                <?php echo $rec['etd']; ?>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php elseif ($_SESSION["user_data"]["level"] == PROF_ROLE) : ?>

    <?php
    $result =  Utility::etd_one();
    ?>

    <table class="table table-hover table-striped border">

        <thead class="bg-dark text-light">
            <tr>
                <th>USER_ID</th>
                <th>PRRNOM</th>
                <th>NOM</th>
                <th>heures totales</th>
            </tr>
        </thead>
        <tbody id="tbody">

            <?php if (!empty($result)) : ?>


                <tr>

                    <td>
                        <?php echo $result['user_id']; ?>
                    </td>

                    <td>
                        <?php echo $result['first_name']; ?>
                    </td>
                    <td>
                        <?php echo $result['last_name']; ?>
                    </td>
                    <td>
                        <?php echo $result['etd']; ?>
                    </td>


                </tr>

            <?php endif; ?>
        </tbody>
    </table>
    </div>



<?php endif; ?>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>