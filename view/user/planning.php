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

                                    <a class="nav-link" <?php if (isset($_SESSION['form_promo']) and isset($_SESSION['form_depart'])) {
                                                            echo ($v['id'] == $_SESSION['form_promo'] and $val['id'] = $_SESSION['form_depart']) ? 'active' : '';
                                                        } ?>" target="seance" href=""><?= $v['name'] . " " . $val['name'] ?></a>

                                    <form class="hide" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="controller" value="SeanceController">
                                        <input type="hidden" name="action" value="show">
                                        <input type="hidden" name="promo" value="<?= $v['id'] ?>">
                                        <input type="hidden" name="depart" value="<?= $val['id'] ?>">
                                    </form>
                                </li>
                            <?php endforeach; ?>

                        <?php endforeach; ?>


                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_SESSION['form_name'])) {
                                                    echo "users" == $_SESSION['form_name'] ? 'active' : '';
                                                } ?>" target="users" href="">Utilisateurs</a>
                        </li>
                    </ul>
                </div>
            </li>
            <HR>
            <li class="nav-link-dropdown">
                <a href="#teacherSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Enseignants</a>
                <div class="indent">
                    <ul class="collapse list-unstyled show" id="teacherSubmenu">
                        <li>
                            <a class="nav-link" href="#">Enseignant 1</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Enseignant 2</a>
                        </li>
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
                                <a class="nav-link" href="#"><?= $v['name'] ?></a>
                            </li>


                        <?php endforeach; ?>

                    </ul>
                </div>
            </li>
            <HR>
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