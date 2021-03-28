<link rel="stylesheet" href="/view/asset/calendar.css?<?= time() ?>">


<?php
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

$result = new SeanceController('show');
$result = $result->show();

$dt = new DateTime(date('m/d/Y h:i:s', strtotime($result[0]->debut)));
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


//Genere une couleur claire a partir d'une chaine de caracteres
function generateColor($str) {
    $r = ord($str);
    if($r<100) {
        $r+=150;
    }
    $g = ord(substr($str, 1));
    if($g<100) {
        $g+=150;
    }
    $b = ord(substr($str, -1));
    if($b<100) {
        $b+=150;
    }
    return 'rgb('.$r.', '.$g.', '.$b.')';
}

?>

<table>
<th></th>
<?php 
    //Affiche la première ligne avec les jours de la semaine
    do {
        echo '<th>'. strftime("%A", $dt->getTimestamp()) ." ". strftime("%d", $dt->getTimestamp()) ."/". strftime("%m", $dt->getTimestamp()) ."/". strftime("%Y", $dt->getTimestamp()) ."</th>\n";
        $dt->modify('+1 day');
    } while ($week == $dt->format('W'));
    
    //Boucle les colonnes de 8h00 à 20h00
    for ($i = 8; $i < 20; $i = $i + 0.5) { 
        $dt->modify('-7 day'); //revient au debut de la semaine
        echo "<tr>";
            //affiche l'heure dans la premiere case de la ligne
            echo "<th>".sprintf("%02d", intval($i)).":".sprintf("%02d", ($i-intval($i))*60)." - ".sprintf("%02d", intval($i+0.5)).":".sprintf("%02d", ($i+0.5-intval($i+0.5))*60)."</th>";
            //Boucle les jours de la semaine 
            do {
                $occupied=false;
                //Boucle sur chaque cours de la bdd
                foreach ($result as $co) {
                    //Teste si le cours correspond à l'heure de la case
                    if(intval(date('n', strtotime($co->debut)))==intval(strftime("%m", $dt->getTimestamp())) && intval(date('j', strtotime($co->debut)))==intval(strftime("%d", $dt->getTimestamp())) && $i>=(intval(date('H', strtotime($co->debut)))+(intval(date('i', strtotime($co->debut))))/60) && $i<=(intval(date('H', strtotime($co->fin)))+(intval(date('i', strtotime($co->fin))))/60)-0.5) {
                        $occupied=true;
                        //On creer la case du cours si c'est sa premiere demi heure
                        if($i==(intval(date('H', strtotime($co->debut)))+(intval(date('i', strtotime($co->debut))))/60)) {
                            echo '<td style="background-color: '. generateColor($co->cours) .';" rowspan="'. ((intval(date('H', strtotime($co->fin)))-intval(date('H', strtotime($co->debut))))*2+(intval(date('i', strtotime($co->fin)))-intval(date('i', strtotime($co->debut))))/30) .'">'. $co->type ." ". $co->cours ."<br/>". $co->salle ."<br/>". $co->nom_enseignant .'</td>';
                        }
                    }                
                }
                //Si la case n'est pas occupée par un cours on creer une case vide
                if(!$occupied) {
                    echo "<td></td>";
                }
                $dt->modify('+1 day'); //incremente le jour de la semaine
            } while ($week == $dt->format('W'));
        echo "</tr>";
    }
?>
</table>

<a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week - 1) . '&year=' . $year; ?>"><- Precedent</a>
<a href="<?php echo $_SERVER['PHP_SELF'] . '?week=' . ($week + 1) . '&year=' . $year; ?>">Suivant -></a>
<br/>