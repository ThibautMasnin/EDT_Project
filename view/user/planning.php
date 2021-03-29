<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<div class="row">
    <nav id="seance-nav" class="col-lg-2 flex-column navbar-light sidebar">
        <ul class="navbar-nav">

            <li class="nav-link-dropdown">
                <a href="#edtSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Promotion</a>
                <div class="indent">
                    <ul class="collapse list-unstyled show" id="edtSubmenu">

                        <?php foreach (PROMO_ARR  as $v) : ?>
                            <?php foreach (DEPART_ARR  as $val) : ?>
                                <li>
                                    <a class="nav-link <?php if (isset($_SESSION['seance_by'])) if ($_SESSION['seance_by']['id'] == 1) {
                                                            echo ($v['id'] == $_SESSION['seance_by']['content'][0] and $val['id'] == $_SESSION['seance_by']['content'][1]) ? 'active' : '';
                                                        } ?>" href=""> <?= $v['name'] . " " . $val['name'] ?></a>


                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="controller" value="SeanceController">
                                        <input type="hidden" name="action" value="show">
                                        <input type="hidden" name="form_promo" value="<?= $v['id'] ?>">
                                        <input type="hidden" name="form_depart" value="<?= $val['id'] ?>">
                                        <input type="hidden" name="seance_by" value="1">

                                    </form>
                                </li>
                            <?php endforeach; ?>

                        <?php endforeach; ?>


            </li>
        </ul>
</div>
</li>
<HR>
<?php if ($_SESSION["user_data"]["level"] <= PROF_ROLE) : ?>

    <li class="nav-link-dropdown">
        <a href="#teacherSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Enseignants</a>
        <div class="indent">
            <ul class="collapse list-unstyled show" id="teacherSubmenu">

                <?php $teachers = new UserController('getAllTeachers');
                $teachers = $teachers->getAllTeachers();
                ?>

                <?php foreach ($teachers as $v) : ?>
                    <li>
                        <a class="nav-link <?php if (isset($_SESSION['seance_by'])) if ($_SESSION['seance_by']['id'] == 2) {
                                                echo ($v['id'] == $_SESSION['seance_by']['content'][0]) ? 'active' : '';
                                            } ?>" href="#"><?= $v['first_name'] . " " . $v['last_name'] ?></a>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="controller" value="SeanceController">
                            <input type="hidden" name="action" value="show">
                            <input type="hidden" name="user_id" value="<?= $v['id'] ?>">
                            <input type="hidden" name="seance_by" value="2">
                        </form>
                    </li>

                <?php endforeach; ?>

            </ul>
        </div>
    </li>
    <HR>



    <li class="nav-link-dropdown">
        <a href="#salleSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Salles</a>
        <div class="indent">
            <ul class="collapse list-unstyled show" id="salleSubmenu">



                <?php foreach (SALLE_ARR as $v) : ?>


                    <li>
                        <a class="nav-link <?php if (isset($_SESSION['seance_by'])) if ($_SESSION['seance_by']['id'] == 3) {
                                                echo ($v['id'] == $_SESSION['seance_by']['content'][0]) ? 'active' : '';
                                            } ?>" href="#"><?= $v['name'] ?></a>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="controller" value="SeanceController">
                            <input type="hidden" name="action" value="show">
                            <input type="hidden" name="salle_id" value="<?= $v['id'] ?>">
                            <input type="hidden" name="seance_by" value="3">

                        </form>
                    </li>


                <?php endforeach; ?>

            </ul>
        </div>
    </li>
    <HR>

<?php endif; ?>
</ul>
</nav>


<div class="col-10">

    <div class="tab-content" id="v-pills-tabContent">

        <div role="tabpanel" class="mw-100">

            <?php
            //    if (isset($_SESSION['form_promo']) and isset($_SESSION['form_depart'])) {
            require_once(__DIR__ . "/calendar.php");

            //  }

            ?>

        </div>


    </div>
</div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>