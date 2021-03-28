<link rel="stylesheet" href="/view/asset/calendar.css?<?= time() ?>">


<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

$result = new SeanceController('show');
$result = $result->show();

$dt = new DateTime(date('m/d/Y h:i:s', strtotime($result[0]->debut)));
//printf($dt->format('Y-m-d H:i:s'));
//$dt = new DateTime();
if (isset($_GET['year']) && isset($_GET['week'])) {
    $dt->setISODate($_GET['year'], $_GET['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}



$year = $dt->format('o');
$week = $dt->format('W');

print("Annee : ".$year);
print(", Semaine : ".$week);
echo "<br/><br/>";

strtotime('1/1/2011');
//print_r($result);
?>

<table>
<th></th>
<?php 
    $colspan = 1;
    do {
        echo '<th colspan='. $colspan .'>'. strftime("%A", $dt->getTimestamp()) ." ". strftime("%d", $dt->getTimestamp()) ."/". strftime("%m", $dt->getTimestamp()) ."/". strftime("%Y", $dt->getTimestamp()) ."</th>\n";
        $dt->modify('+1 day');
    } while ($week == $dt->format('W'));
    for ($i = 8; $i < 20; $i = $i + 0.5) { 
        $dt->modify('-7 day');
        echo "<tr>";
        echo "<th>".sprintf("%02d", intval($i)).":".sprintf("%02d", ($i-intval($i))*60)." - ".sprintf("%02d", intval($i+0.5)).":".sprintf("%02d", ($i+0.5-intval($i+0.5))*60)."</th>";
        do {
            $occupied=false;
            foreach ($result as $co) {
                if(intval(date('n', strtotime($co->debut)))==intval(strftime("%m", $dt->getTimestamp())) && intval(date('j', strtotime($co->debut)))==intval(strftime("%d", $dt->getTimestamp())) && $i==(intval(date('H', strtotime($co->debut)))+(intval(date('i', strtotime($co->debut))))/60)) {
                    echo '<td class="cours" rowspan="'. ((intval(date('H', strtotime($co->fin)))-intval(date('H', strtotime($co->debut))))*2+(intval(date('i', strtotime($co->fin)))-intval(date('i', strtotime($co->debut))))/30) .'">'. $co->cours .'</td>';
                    $occupied=true;
                }
                $tmp = date('j', strtotime($co->debut)); // day
                $tmp2 = date('n', strtotime($co->fin)); // month
                $tmp3 = date('Y', strtotime($co->debut)); // year
                $tmp4 = date('H', strtotime($co->fin)); // hour
                $tmp5 = date('i', strtotime($co->fin)); // minute
            }
            if(!$occupied) {
                echo "<td></td>";
            }
            $dt->modify('+1 day');
        } while ($week == $dt->format('W'));
        

        echo "</tr>";
    }
?>
</table>

<a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year; ?>"><- Precedent</a>
<a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>">Suivant -></a>
<br/>

    <!-- 
<table>
    <tr>
        <td></td>
        <?php /*
        $colspan = 1;


        do {
            echo '<td colspan=' . $colspan . '>' . strftime("%A", $dt->getTimestamp()) . " " . strftime("%D", $dt->getTimestamp()) . "</td>\n";
            $dt->modify('+1 day');
        } while ($week == $dt->format('W'));
        */?>

    </tr>

    <?php /*for ($i = 8; $i <= 20; $i = $i + 0.5) : ?>

        <?php if (true) :  ?>
            <tr>
                <th><?= $i ?></th>
                <?php for ($l = 0; $l < 7 * $colspan; $l++) : ?>

                    <td>
                    </td>


                <?php endfor; ?>

                <!-- <td colspan="3" rowspan="2" class="stage-saturn">Welcome</td> -->
            </tr>

        <?php else :  ?>
            <tr>
                <th><?= $i ?></th>
                <?php for ($l = 0; $l < 7 * $colspan; $l++) : ?>

                    <td>
                    </td>


                <?php endfor; ?>

                <!-- <td colspan="3" rowspan="2" class="stage-saturn">Welcome</td> -->
            </tr>
        <?php endif; ?>


    <?php endfor; */ ?>


    <tr>
        <th>08:00</th>
         <td></td>
        <td></td>
        <td></td> 
        <td colspan="2" rowspan="2" class="stage-saturn">Welcome</td>
       <td>&nbsp;</td>
        <td colspan="1" class="stage-saturn">Welcome</td>

        <td>jkkkjk</td>

        <td colspan="1" rowspan="1.5" class="stage-saturn">xxx</td>  
    </tr>
    <tr>
        <th>08:30</th>
        <td colspan="2" rowspan="2" class="stage-saturn">Welcome</td>
    </tr>
    <tr>
        <th>09:00</th>
        <td colspan="4" class="stage-earth">Speaker One <span>Earth Stage</span></td>
    </tr>
    <tr>
        <th>09:30</th>
        <td colspan="4" class="stage-earth">Speaker Two <span>Earth Stage</span></td>
    </tr>
    <tr>
        <th>10:00</th>
        <td colspan="4" class="stage-earth">Speaker Three <span>Earth Stage</span></td>
    </tr>
    <tr>
        <th>10:30</th>
        <td colspan="4" class="stage-earth">Speaker Four <span>Earth Stage</span></td>
    </tr>
    <tr>
        <th>11:00</th>
        <td rowspan="5" class="stage-mercury">
            Speaker Five <span>Mercury Stage</span>
        </td>
        <td rowspan="5" class="stage-venus">Speaker Six <span>Venus Stage</span></td>
        <td rowspan="5" class="stage-mars">Speaker Seven <span>Mars Stage</span></td>
        <td rowspan="2" class="stage-saturn">Lunch</td>
    </tr>
    <tr>
        <th>11:30</th>
    </tr>
    <tr>
        <th>12:00</th>
        <td rowspan="3" class="stage-saturn">Break</td>
    </tr>
    <tr>
        <th>12:30</th>
    </tr>
    <tr>
        <th>13:00</th>
    </tr>
    <tr>
        <th>13:30</th>
        <td colspan="4" rowspan="2" class="stage-earth">Speaker Eight <span>Earth Stage</span></td>
    </tr>
    <tr>
        <th>14:00</th>
    </tr>
    <tr>
        <th>14:30</th>
        <td colspan="4" rowspan="8" class="stage-saturn">Break</td>
    </tr>
    <tr>
        <th>15:00</th>
    </tr>
    <tr>
        <th>15:30</th>
    </tr>
    <tr>
        <th>16:00</th>
    </tr>
    <tr>
        <th>16:30</th>
    </tr>
    <tr>
        <th>17:00</th>
    </tr>
    <tr>
        <th>17:30</th>
    </tr>
    <tr>
        <th>18:00</th>
    </tr>
    <tr>
        <th>18:30</th>
        <td colspan="4" class="stage-earth">Speaker Nine <span>Earth Stage</span></td>
    </tr>
    <tr>
        <th>19:00</th>
        <td colspan="2" rowspan="2" class="stage-earth">Speaker Ten <span>Earth Stage</span></td>
        <td colspan="2" rowspan="2" class="stage-jupiter">Speaker Eleven <span>Jupiter Stage</span></td>
    </tr>
    <tr>
        <th>19:30</th>
    </tr>
    <tr>
        <th>20:00</th>
        <td colspan="2" class="stage-mars">Speaker Twelve <span>Mars Stage</span></td>
        <td class="stage-jupiter">Speaker Thirteen <span>Jupiter Stage</span></td>
        <td class="stage-jupiter">Speaker Fourteen <span>Jupiter Stage</span></td>
    </tr>
    <tr>
        <th>20:30</th>
        <td colspan="4" rowspan="2" class="stage-saturn">Drinks</td>
    </tr> -->


</table>