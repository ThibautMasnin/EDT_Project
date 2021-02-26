<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Emploi du temps</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
    </head>
	<body>    
        <div class="bg-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 navbar navbar-dark">
                        <a class="navbar-brand" href="index.html" style="color: white;">
                            <img src="../Resources/logo.png" width="30" height="30" alt="Logo">
                            Planning
                        </a>
                    </div>
                    <nav class="col-lg-8 navbar navbar-expand-lg bg-dark navbar-dark">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div id="navbarContent" class="collapse navbar-collapse">
                            <ul class="navbar-nav">
                                <!-- if (user != student) { -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Consultation</a>
                                    </li>                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Modification</a>
                                    </li>     
                                    <!-- if (user == admin) { -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Ajout d'utilisateur</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Ajout d'une salle</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Ajout d'un cours</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Service ETD</a>
                                        </li>
                                    <!-- } -->
                                <!-- } -->
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Deconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>        
        <div class="container-fluid">
            <div class="row">
                <nav class="col-lg-2 flex-column navbar-light sidebar" style="background-color: #e3f2fd;">
                    <ul class="navbar-nav">
                        <li class="nav-item-dropdown">                        
                            <a href="#departementSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Départements</a>
                            <div  class="indent">
                                <ul class="collapse list-unstyled" id="departementSubmenu">
                                    <li class="nav-item-dropdown">
                                        <a href="#mathSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Maths</a>
                                        <div  class="indent">
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
                                        <a href="#infoSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Info</a>
                                        <div  class="indent">                                        
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
                                        <a href="#svtSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">SVT</a>
                                        <div  class="indent">
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
                                        <a href="#chimieSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Chimie</a>
                                        <div  class="indent">
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
                            <a href="#teacherSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Enseignants</a>
                            <div  class="indent">
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
                            <a href="#coursSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle">Cours</a>
                            <div  class="indent">
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
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>