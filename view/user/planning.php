<?php
require_once(__DIR__ . "/../page/app.php");
require_once(__DIR__ . "/../page/header.php");
require_once(__DIR__ . "/../../middleware/auth.php");
?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-lg-2 flex-column navbar-light sidebar" style="background-color: #e3f2fd;">
            <ul class="navbar-nav">
                <li class="nav-item-dropdown">
                    <a href="#departementSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Départements</a>
                    <div class="indent">
                        <ul class="collapse list-unstyled" id="departementSubmenu">
                            <li class="nav-item-dropdown">
                                <a href="#mathSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Maths</a>
                                <div class="indent">
                                    <ul class="collapse list-unstyled" id="mathSubmenu">
                                        <li>
                                            <a class="nav-link" href="#">L1 Maths</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L2 Maths</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L3 Maths</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M1 Maths</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M2 Maths</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-link-dropdown">
                                <a href="#infoSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Info</a>
                                <div class="indent">
                                    <ul class="collapse list-unstyled" id="infoSubmenu">
                                        <li>
                                            <a class="nav-link" href="#">L1 Info</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L2 Info</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L3 Info</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M1 Info</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M2 Info</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-link-dropdown">
                                <a href="#svtSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">SVT</a>
                                <div class="indent">
                                    <ul class="collapse list-unstyled" id="svtSubmenu">
                                        <li>
                                            <a class="nav-link" href="#">L1 SVT</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L2 SVT</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L3 SVT</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M1 SVT</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M2 SVT</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-link-dropdown">
                                <a href="#chimieSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Chimie</a>
                                <div class="indent">
                                    <ul class="collapse list-unstyled" id="chimieSubmenu">
                                        <li>
                                            <a class="nav-link" href="#">L1 Chimie</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L2 Chimie</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">L3 Chimie</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M1 Chimie</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#">M2 Chimie</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <HR>
                <li class="nav-link-dropdown">
                    <a href="#teacherSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Enseignants</a>
                    <div class="indent">
                        <ul class="collapse list-unstyled" id="teacherSubmenu">
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
                    <a href="#coursSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Cours</a>
                    <div class="indent">
                        <ul class="collapse list-unstyled" id="coursSubmenu">
                            <li>
                                <a class="nav-link" href="#">Cours 1</a>
                            </li>
                            <li>
                                <a class="nav-link" href="#">Cours 2</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>


<?php
require_once(__DIR__ . "/../page/footer.php");
?>