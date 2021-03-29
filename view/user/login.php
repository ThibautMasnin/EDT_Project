<?php
require_once(__DIR__ . "/../page/app.php");
if (isset($_SESSION['is_logged_in'])) {
    header('Location: ' . "/view/user/userInformation.php");
    exit();
}

require_once(__DIR__ . "/../page/header.php");

?>
<div class="container w-25"><br /><br />
    <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h3 class="panel-title">Connexion</h3>
        </div><br />
        <div class="panel-body">
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <input type="text" placeholder="Nom d'utilisateur" name="username" class="form-control">
                </div><br />
                <div class="form-group">
                    <input type="password" placeholder="Mot de passe" name="password" class="form-control">
                </div><br />
                <input type="hidden" name="controller" value="UserController">
                <input type="hidden" name="action" value="login">
                <button class="btn btn-primary" type="submit" name="submit" value="submit">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>