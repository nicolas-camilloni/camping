<?php

session_start();

$datejour = new DateTime("today");

// var_dump($datejour);

if (!isset($_SESSION["num"])) {
    $_SESSION["num"] = 0;
}

if (isset($_POST["suivant"])) {
    $_SESSION["num"] += 1;
}

if (isset($_POST["precedent"])) {
    $_SESSION["num"] -= 1;
}

// echo $_SESSION["num"];

date_add($datejour, date_interval_create_from_date_string($_SESSION['num']." days"));

$dateselec = date_format($datejour, 'Y-m-d');

// var_dump($dateselec);
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Camping - Planning</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include("header.php");
?>
<main>
    <img class="top" src="img/topplanning.jpg">
    <section id="cdateplanning">
    <form id="dateplanning" method="post" action="planning.php">
        <input type="submit" name="precedent" value="<">
        <p><?php echo date_format($datejour, 'd-m-Y'); ?></p>
        <input type="submit" name="suivant" value=">">
    </form>
    </section>

    <?php

    $connexion = mysqli_connect("localhost", "root", "", "camping");
    $requete = "SELECT login, type, lieu, DATE_FORMAT(debut, \"%Y-%m-%d\"), DATE_FORMAT(fin, \"%Y-%m-%d\"), option1, option2, option3, prix FROM reservations LEFT JOIN utilisateurs ON utilisateurs.id = reservations.id_utilisateur WHERE \"$dateselec\" BETWEEN DATE_FORMAT(debut, \"%Y-%m-%d\") AND DATE_FORMAT(fin, \"%Y-%m-%d\")";
    // echo $requete;
    $query = mysqli_query($connexion, $requete);
    // var_dump($query);
    $resultat = mysqli_fetch_all($query);
    // var_dump($resultat);

    $capacite1 = 0;
    $capacite2 = 0;
    $capacite3 = 0;

    foreach ( $resultat as $key ) {
        if ( $key[2] == "Plage" ) {
            if ( $key[1] == "Tente" ) {
                $capacite1 += 1;
            }
            elseif ( $key[1] == "Campingcar" ) {
                $capacite1 += 2;
            }
        }
        if ( $key[2] == "Pins" ) {
            if ( $key[1] == "Tente" ) {
                $capacite2 += 1;
            }
            elseif ( $key[1] == "Campingcar" ) {
                $capacite2 += 2;
            }
        }
        if ( $key[2] == "Maquis" ) {
            if ( $key[1] == "Tente" ) {
                $capacite3 += 1;
            }
            elseif ( $key[1] == "Campingcar" ) {
                $capacite3 += 2;
            }
        }

        // echo $capacite1;
        // echo $capacite2;
        // echo $capacite3;

        $capacite = [$capacite1, $capacite2, $capacite3];
        // var_dump($capacite);

    }

    ?>
    <section id="ctable">
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
            echo "<td id=\"caseemplacement\">Emplacement ".$emplacement."";

            for ( $lieu=0; $lieu < 3; $lieu++ ) { 
                if ( !empty($resultat) && $capacite[$lieu] >= $emplacement ) {
                    echo "<td class=\"reserve\">Reservé</td>";
                }
                else{
                    echo "<td class=\"dispo\">Disponible</td>";
                }            
            }
            
            echo "</tr>";
            
        }

        ?>
        
        </tbody>

    </table>
    <section id="cbtnres">
        <a href="reservation-form.php"><p>Réserver</p></a>
    </section>
    </section>
    </main>
    <?php
        include("footer.php");
        mysqli_close($connexion);
    ?>
</body>
</html>