<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>


<div class="row">
    <nav class="col-lg-2 flex-column navbar-light sidebar">
        <ul class="navbar-nav">
            <li class="nav-link-dropdown">
                <a href="#mSubmenu" data-bs-toggle="collapse" aria-expanded="true" class="nav-link dropdown-toggle">Miscellaneous</a>
                <div class="indent">
                    <ul class="collapse list-unstyled show" id="mSubmenu">
                        <li class="nav-item">
                            <a class="nav-link active" target="list" href="">Salle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="list" href="">Type de Cours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="list" href="">Role</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="list" href="">Departement</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="list" href="">Promotion</a>
                        </li>
                    </ul>
                </div>
            </li>

            <HR>
            <li class="nav-link-dropdown">
                <a href="#aSubmenu" data-bs-toggle="collapse" aria-expanded="true" class="nav-link dropdown-toggle">Administration</a>
                <div class="indent">
                    <ul class="collapse list-unstyled show" id="aSubmenu">
                        <li class="nav-item">
                            <a class="nav-link" target="info" href="">Utilisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="info" href="">Cours</a>
                        </li>
                    </ul>
                </div>
            </li>
            <HR>


    </nav>
    <div class="col-10">

        <div class="tab-content" id="v-pills-tabContent">
            <?php
            require_once(__DIR__ . "/../page/footer.php");
            ?>

            <div class="tab-pane not-d-none" id="v-pills-list" role="tabpanel">


                <?php
                require_once(__DIR__ . "/list.php");
                ?>



            </div>


            <div class="tab-pane d-none" id="v-pills-info" role="tabpanel">

                <?php
                require_once(__DIR__ . "/userinformation.php");
                ?>


            </div>


        </div>
    </div>

</div>









<?php
require_once(__DIR__ . "/../page/footer.php");
?>