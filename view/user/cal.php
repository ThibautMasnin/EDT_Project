<link rel="stylesheet" href="/view/asset/cal.css?<?= time() ?>">

<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
$dt = new DateTime();
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}
$year = $dt->format('o');
$week = $dt->format('W');

$result = new SeanceController('show');
$result = $result->show();
print_r($result);
?>

<table>
    <tr>
        <td><a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year; ?>">Pre Week</a></td>
        <?php
        do {
            echo "<td>" . strftime("%A", $dt->getTimestamp()) . "<br/>" . strftime("%D", $dt->getTimestamp()) . "</td>\n";
            $dt->modify('+1 day');
        } while ($week == $dt->format('W'));
        ?>
        <td>
            <a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>">Next Week</a>

        </td>
    </tr>



    <tr>

        <!-- <div class="container"> -->
        <div class="col-2">
            <td>
                <div class="timings">
                    <?php for ($l = 8; $l <= 20; $l = $l + 0.5) {
                        if (is_numeric($l) && floor($l) != $l) {
                            echo  '<div>' . (int)$l . ":30" . '</div>';
                        } else {
                            echo  '<div><span>' . $l . ":00" . '</span></div>';
                        }
                    } ?>


                </div>
            </td>
        </div>
        <?php for ($m = 0; $m < 7; $m++) {
            echo '<div class="col-1"><td>
                   <div class="days" id="events">
                   </div>
               </td></div>';
        } ?>
        <div class="col-1">
            <td>
            </td>
        </div>











    </tr>

</table>