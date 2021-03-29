<link rel="stylesheet" href="/view/asset/calendar.css?<?= time() ?>">


<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
//--------------------

$result = '';
if (isset($_SESSION['calendar'])) {
    $result = $_SESSION['calendar'];
}



//-------------------

if (!empty($result)) {
    $dt = new DateTime(date('Y-m-d H:i:s', strtotime($result[0]->debut)));
} else {
    $dt = new DateTime();
}

if (isset($_POST['year']) && isset($_POST['week'])) {
    $dt->setISODate($_POST['year'], $_POST['week']);
} else {
    $dt->setISODate($dt->format('o'), $dt->format('W'));
}


$year = $dt->format('o');
$week = $dt->format('W');




//Genere une couleur claire a partir d'une chaine de caracteres
function generateColor($str)
{
    $r = ord($str);
    if ($r < 100) {
        $r += 150;
    }
    $g = ord(substr($str, 1));
    if ($g < 100) {
        $g += 150;
    }
    $b = ord(substr($str, -1));
    if ($b < 100) {
        $b += 150;
    }
    return 'rgb(' . $r . ', ' . $g . ', ' . $b . ')';
}

?>


<div class="row">
    <div class="col-1">
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="controller" value="SeanceController">
            <input type="hidden" name="action" value="show">

            <?php if (isset($_SESSION['seance_by'])) : ?>
                <?php if ($_SESSION['seance_by']['id'] == 1) : ?>

                    <input type="hidden" name="form_promo" value="<?= $_SESSION['seance_by']['content'][0] ?>">
                    <input type="hidden" name="form_depart" value="<?= $_SESSION['seance_by']['content'][1] ?>">
                <?php elseif ($_SESSION['seance_by']['id'] == 2) : ?>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['seance_by']['content'][0] ?>">
                <?php elseif ($_SESSION['seance_by']['id'] == 3) : ?>
                    <input type="hidden" name="salle_id" value="<?= $_SESSION['seance_by']['content'][0] ?>">
                <?php endif; ?>
            <?php endif; ?>
            <input type="hidden" name="year" value="<?= $year ?>">
            <input type="hidden" name="week" value="<?= ($week - 1) ?>">

            <button class="btn btn-success" type="submit">Precedent</button>
        </form>
    </div>
    <div class="col-1"></div>
    <div class="col-1">
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="controller" value="SeanceController">
            <input type="hidden" name="action" value="show">

            <?php if (isset($_SESSION['seance_by'])) : ?>
                <?php if ($_SESSION['seance_by']['id'] == 1) : ?>

                    <input type="hidden" name="form_promo" value="<?= $_SESSION['seance_by']['content'][0] ?>">
                    <input type="hidden" name="form_depart" value="<?= $_SESSION['seance_by']['content'][1] ?>">
                <?php elseif ($_SESSION['seance_by']['id'] == 2) : ?>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['seance_by']['content'][0] ?>">
                <?php elseif ($_SESSION['seance_by']['id'] == 3) : ?>
                    <input type="hidden" name="salle_id" value="<?= $_SESSION['seance_by']['content'][0] ?>">
                <?php endif; ?>
            <?php endif; ?>
            <input type="hidden" name="year" value="<?= $year ?>">
            <input type="hidden" name="week" value="<?= ($week + 1) ?>">

            <button class="btn btn-success" type="submit">Suivant</button>
        </form>
    </div>
</div>

<table class="table table-striped border">
    <th></th>
    <?php
    //Affiche la première ligne avec les jours de la semaine
    do {
        echo '<th>' . strftime("%A", $dt->getTimestamp()) . " " .
            strftime("%d", $dt->getTimestamp()) . "/" . strftime(
                "%m",
                $dt->getTimestamp()
            ) . "/" . strftime("%Y", $dt->getTimestamp()) . "</th>\n";
        $dt->modify('+1 day');
    } while ($week == $dt->format('W'));

    //Boucle les colonnes de 8h00 à 20h00
    for ($i = 8; $i <= 20; $i = $i + 0.5) {
        $dt->modify('-7 day'); //revient au debut de la semaine
        echo "<tr>";
        //affiche l'heure dans la premiere case de la ligne
        // echo "<th>" . sprintf("%02d", intval($i)) . ":" .
        //     sprintf("%02d", ($i - intval($i)) * 60) . " - " . sprintf("%02d", intval($i + 0.5)) . ":" .
        //     sprintf("%02d", ($i + 0.5 - intval($i + 0.5)) * 60) . "</th>";

        if (is_numeric($i) && floor($i) != $i) {
            echo  '<th>' . (int)$i . ":30" . '</th>';
        } else {
            echo  '<th><span>' . $i . ":00" . '</span></th>';
        }




        //Boucle les jours de la semaine 
        do {
            $occupied = false;
            //Boucle sur chaque cours de la bdd
            foreach ($result as $co) {
                //Teste si le cours correspond à l'heure de la case
                if (
                    intval(date('n', strtotime($co->debut))) == intval(strftime("%m", $dt->getTimestamp()))
                    && intval(date('j', strtotime($co->debut))) == intval(strftime("%d", $dt->getTimestamp()))
                    && $i >= (intval(date('H', strtotime($co->debut))) + (intval(date('i', strtotime($co->debut)))) / 60)
                    && $i <= (intval(date('H', strtotime($co->fin))) + (intval(date('i', strtotime($co->fin)))) / 60)
                ) {
                    $occupied = true;
                    //On creer la case du cours si c'est sa premiere demi heure
                    // sinon on fait rien
                    if ($i == (intval(date('H', strtotime($co->debut))) + (intval(date('i', strtotime($co->debut)))) / 60)) {
                        echo '<td style="background-color: ' . generateColor($co->cours) . ';" rowspan="' .
                            ((strtotime($co->fin) - strtotime($co->debut)) / 60 / 30 + 1) .
                            '">' . $co->type . " " . $co->cours . "<br/>" . $co->salle . "<br/>" . $co->nom_enseignant . '</td>';
                    }
                }
            }
            //Si la case n'est pas occupée par un cours on creer une case vide
            if (!$occupied) {
                echo "<td></td>";
            }
            $dt->modify('+1 day'); //incremente le jour de la semaine
        } while ($week == $dt->format('W'));
        echo "</tr>";
    }
    ?>
</table>