<?php

session_start();

$datejour = new DateTime("today");

var_dump($datejour);

if (!isset($_SESSION["num"])) {
    $_SESSION["num"] = 0;
}

if (isset($_POST["suivant"])) {
    $_SESSION["num"] += 1;
}

if (isset($_POST["precedent"])) {
    $_SESSION["num"] -= 1;
}

echo $_SESSION["num"];

date_add($datejour, date_interval_create_from_date_string($_SESSION['num']." days"));

echo date_format($datejour, 'Y-m-d');

$dateselec = date_format($datejour, 'Y-m-d');

var_dump($dateselec);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Camping</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include("header.php");
?>

<form method="post" action="index.php">
    <input type="submit" name="suivant" value=">">
    <input type="submit" name="precedent" value="<">
</form>

<?php

$connexion = mysqli_connect("localhost", "root", "", "camping");
$requete = "SELECT login, type, lieu, DATE_FORMAT(debut, \"%Y-%m-%d\"), DATE_FORMAT(fin, \"%Y-%m-%d\"), option1, option2, option3, prix FROM reservations LEFT JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur WHERE \"$dateselec\" BETWEEN DATE_FORMAT(debut, \"%Y-%m-%d\") AND DATE_FORMAT(fin, \"%Y-%m-%d\")";
echo $requete;
$query = mysqli_query($connexion, $requete);
var_dump($query);
$resultat = mysqli_fetch_all($query);
var_dump($resultat);

$capacite1 = 0;
$capacite2 = 0;
$capacite3 = 0;

foreach ( $resultat as $key ) {
    if ( $key[2] == "plage" ) {
        if ( $key[1] == "tente" ) {
            $capacite1 += 1;
        }
        elseif ( $key[1] == "campingcar" ) {
            $capacite1 += 2;
        }
    }
    if ( $key[2] == "pins" ) {
        if ( $key[1] == "tente" ) {
            $capacite2 += 1;
        }
        elseif ( $key[1] == "campingcar" ) {
            $capacite2 += 2;
        }
    }
    if ( $key[2] == "maquis" ) {
        if ( $key[1] == "tente" ) {
            $capacite3 += 1;
        }
        elseif ( $key[1] == "campingcar" ) {
            $capacite3 += 2;
        }
    }

    echo $capacite1;
    echo $capacite2;
    echo $capacite3;

    $capacite = [$capacite1, $capacite2, $capacite3];
    var_dump($capacite);

}

?>
   <table>
       <thead>
           <tr>
               <th></th>
               <th>Plage</th>
               <th>Pins</th>
               <th>Maquis</th>
       </thead>
       <tbody>

    <?php
    for ( $emplacement = 1; $emplacement < 5; $emplacement++ ) {
        echo "<tr>";
        echo "<td>Emplacement:".$emplacement."";

        for ( $lieu=0; $lieu < 3; $lieu++ ) { 
        echo "<td>";

            if ( $capacite[$lieu] >= $emplacement ) {
                echo "Reservé";
            }
             
            else{
              echo "Dispo";
            }
           
            echo "</td>";
        }
        
        echo "</tr>";
          
    }
        
        
        
    ?>
    
       </tbody>

   </table>