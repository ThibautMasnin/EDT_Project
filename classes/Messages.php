<?php
class Messages
{
    public static function setMsg($text, $type)
    {
        if ($type == 'error') {
            $_SESSION['errorMsg'] = $text;
        } else {
            $_SESSION['successMsg'] = $text;
        }
    }

    public static function display()
    {
        if (isset($_SESSION['errorMsg'])) {
            echo '<div class="alert alert-danger text-center message" style="position:absolute !important; left:25%; width:50%; top:30px !important; z-index: 100;" role="alert">' . $_SESSION['errorMsg'] . '</div>';
            unset($_SESSION['errorMsg']);
        }

        if (isset($_SESSION['successMsg'])) {
            echo '<div class="alert alert-success text-center message" style="position:absolute !important; left:25%; width:50%; top:30px !important; z-index: 100;" role="alert">' . $_SESSION['successMsg'] . '</div>';
            unset($_SESSION['successMsg']);
        }
    }
}
