<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<form id="getFormBuilder" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="controller" value="UserController">
    <input type="hidden" name="action" value="formBuilder">
    <input type="hidden" name="tag" value="">
</form>


<div class="row">
    <nav class="col-lg-2 flex-column navbar-light sidebar">
        <ul class="navbar-nav">


            <li class="nav-link-dropdown">
                <a href="#aSubmenu" data-bs-toggle="collapse" aria-expanded="true" class="nav-link dropdown-toggle">Administration</a>
                <div class="indent">
                    <ul class="collapse list-unstyled show" id="aSubmenu">

                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_SESSION['form_name'])) {
                                                    echo "seance" == $_SESSION['form_name'] ? 'active' : '';
                                                } ?>" target="seance" href="">Seances</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_SESSION['form_name'])) {
                                                    echo "cours" == $_SESSION['form_name'] ? 'active' : '';
                                                } ?>" target="cours" href="">Cours</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link <?php if (isset($_SESSION['form_name'])) {
                                                    echo "etd" == $_SESSION['form_name'] ? 'active' : '';
                                                } ?>" target="etd" href="">Service ETD</a>
                        </li>


                        <?php if ($_SESSION["user_data"]["level"] == ADMIN_ROLE) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_SESSION['form_name'])) {
                                                        echo "users" == $_SESSION['form_name'] ? 'active' : '';
                                                    } ?>" target="users" href="">Utilisateurs</a>
                            </li>
                        <?php endif; ?>



                    </ul>
                </div>
            </li>
            <HR>


            <?php if ($_SESSION["user_data"]["level"] == ADMIN_ROLE) : ?>

                <li class="nav-link-dropdown">
                    <a href="#mSubmenu" data-bs-toggle="collapse" aria-expanded="true" class="nav-link dropdown-toggle">Miscellaneous</a>
                    <div class="indent">
                        <ul class="collapse list-unstyled show" id="mSubmenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_SESSION['form_name'])) echo "salle" == $_SESSION['form_name'] ? 'active' : ''; ?>" target="salle" href="">Salle</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_SESSION['form_name'])) echo "courstype" == $_SESSION['form_name'] ? 'active' : ''; ?>" target="courstype" href="">Type de Cours</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_SESSION['form_name'])) echo "role" == $_SESSION['form_name'] ? 'active' : ''; ?>" target="role" href="">Role</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_SESSION['form_name'])) echo "department" == $_SESSION['form_name'] ? 'active' : ''; ?>" target="department" href="">Departement</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($_SESSION['form_name'])) echo "promotion" == $_SESSION['form_name'] ? 'active' : ''; ?>" target="promotion" href="">Promotion</a>

                            </li>
                        </ul>
                    </div>
                </li>

                <HR>
            <?php endif; ?>

    </nav>

    <div class="col-10">

        <div class="tab-content" id="v-pills-tabContent">

            <div role="tabpanel">

                <?php
                if (isset($_SESSION['form_name'])) {

                    if ($_SESSION['form_name'] == 'users') {
                        require_once(__DIR__ . "/user-list.php");
                    } else if ($_SESSION['form_name'] == 'cours') {
                        require_once(__DIR__ . "/cours-list.php");
                    } else if ($_SESSION['form_name'] == 'seance') {
                        require_once(__DIR__ . "/seance-list.php");
                    } else if ($_SESSION['form_name'] == 'etd') {
                        require_once(__DIR__ . "/etd.php");
                    } else {
                        Utility::formBuilder($_SESSION['form_name']);
                    }
                }

                ?>

            </div>


        </div>
    </div>

</div>









<?php
require_once(__DIR__ . "/../page/footer.php");
?>