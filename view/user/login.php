<?php
if (isset($_SESSION['is_logged_in'])) {
    header('Location: ' . ROOT_URL . "/view/user/userInformation.php");
    exit();
}
require_once(__DIR__ . "/../page/header.php");
?>
<div class="fluid-container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Login User</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?controller=User&action=login">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>
                <div class="form-group">
                    <label>password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="submit">

            </form>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../page/footer.php");
?>