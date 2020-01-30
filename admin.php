<?php

session_start();

if (isset($_GET["deco"])) {
    session_unset();
    session_destroy();
    header('Location:index.php');
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Campigo - Administration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include("header.php");
?>

<main>
    <img class="top" src="img/topindex.jpg">
    <section class="cform">

    <?php  

           $cnx = mysqli_connect("localhost", "root", "", "camping");
           $requetetarifs = "SELECT * FROM tarifs";
           $querytarifs = mysqli_query($cnx, $requetetarifs);
           $resultattarifs = mysqli_fetch_all($querytarifs, MYSQLI_ASSOC);
           $tarifeactuel = $resultattarifs[0]['tarifemplacement'];
           $tarifeo1actuel = $resultattarifs[0]['tarifo1'];
           $tarifeo2actuel = $resultattarifs[0]['tarifo2'];
           $tarifeo3actuel = $resultattarifs[0]['tarifo3'];

            if (!empty($_SESSION['login'])) 
             {

              if ($_SESSION['login'] == "admin") {
    ?>
            <article><h1>Administration</h1></article>
                <form class="form" action="admin.php" method="post">
                <br>
                <br>
                <label>Tarif de l'option 1</label>
                <input type="number" id="newtarifo1" name="newtarifo1" placeholder="Tarif actuel: <?php echo $tarifeo1actuel; ?>€/j">
                <br>
                <br>
                <br>
                <label>Tarif de l'option 2</label>
                <input type="number" id="newtarifo2" name="newtarifo2" placeholder="Tarif actuel: <?php echo $tarifeo2actuel; ?>€/j">
                <br>
                <br>
                <br>
                <label>Tarif de l'option 3</label>
                <input type="number" id="newtarifo3" name="newtarifo3" placeholder="Tarif actuel: <?php echo $tarifeo3actuel; ?>€/j">
                <br>
                <br>
                <br>
                <label>Tarif d'un emplacement</label>
                <input type="number" id="newtarifemplacement" name="newtarifemplacement" placeholder="Tarif actuel: <?php echo $tarifeactuel; ?>€/j">
                <br>
                <input type="submit" name="modiftarifs" value="Modifier" />
                </form>  
            <?php 
              if (isset($_POST['modiftarifs']) ) {
                   $newtarifo1 = $tarifeo1actuel;
                   $newtarifo2 = $tarifeo2actuel;
                   $newtarifo3 = $tarifeo3actuel;
                   $newtarifemplacement = $tarifeactuel;

                   if(!empty($_POST['newtarifo1'])){
                    $newtarifo1 = $_POST['newtarifo1'];
                   }
                    if(!empty($_POST['newtarifo2'])){
                    $newtarifo2 = $_POST['newtarifo2'];
                   }
                   if(!empty($_POST['newtarifo3'])){
                    $newtarifo3 = $_POST['newtarifo3'];
                   }
                   if(!empty($_POST['newtarifemplacement'])){
                    $newtarifemplacement = $_POST['newtarifemplacement'];
                   }
                    $changetarifs = "UPDATE tarifs SET tarifo1 ='$newtarifo1', tarifo2 ='$newtarifo2', tarifo3 ='$newtarifo3', tarifemplacement ='$newtarifemplacement' ";
                    $querychangetarifs = mysqli_query($cnx, $changetarifs);
                    header('Location:admin.php');
                }

                $getresa = "SELECT * FROM reservations";
                $queryresa = mysqli_query($cnx, $getresa);
                $resultatresa = mysqli_fetch_all($queryresa, MYSQLI_ASSOC);
                echo "<center><table border>";
                echo "<thead><tr>";
                $taille = count($resultatresa) - 1;
                foreach ($resultatresa[$taille] as $key => $value) 
                {
                 echo "<th>{$key}</th>";
                }
                 echo "</tr></thead>";
                 echo "<tbody>";
                 $i = 0;
                while ($i <= $taille) 
                {
                 echo "<tr>";
                foreach ($resultatresa[$i] as $key => $value) 
                {
                 echo "<td>{$value}</td>";
                }
                 echo "</tr>";
                $i++;
                }

                echo "</tbody></table>";
            }
            else {
                echo "<p class=\"pincorrect\">Vous devez être connecté en tant qu'administrateur pour accéder à cette page.</p>";
            }
        }
        else{
            echo "<p class=\"pincorrect\">Vous devez être connecté en tant qu'administrateur pour accéder à cette page.</p>";
        }
        ?>
    </section>
    
</main>

<?php
    include("footer.php");
    mysqli_close($cnx);
?>

</body>
</html>