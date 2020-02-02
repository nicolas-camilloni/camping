<?php

session_start();
$_SESSION["num"] = 0;
setlocale (LC_TIME, 'fr_FR.utf8','fra');
date_default_timezone_set("Europe/Paris");

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

                ?>
            </section>
            
            <section id="cresadmin">
                <article><h1>Modifier une réservation</h1></article>
                <?php

                $requeteres = "SELECT reservations.id,lieu,type,sejour,debut,fin,option1,option2,option3,prix,login FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id";
                // echo $requeteres;
                $queryres = mysqli_query($cnx, $requeteres);
                $resultatres = mysqli_fetch_all($queryres);

                foreach ( $resultatres as $key ) {
                    $reslogin = $key[10];
                    $resid = $key[0];
                    $reslieu = $key[1];
                    $restype = $key[2];
                    $ressejour = $key[3];
                    $resdebut = $key[4];

                    $resdebutjour = strtoupper(strftime("%A", strtotime($resdebut)));
                    // echo $resdebutjour;
                    $resdebutmois = strtoupper(strftime("%b", strtotime($resdebut)));
                    $resdebutmois = substr($resdebutmois,0,-1);
                    $resdebutmois = utf8_encode($resdebutmois);
                    // echo $resdebutmois;
                    $resdebutcjour = strtoupper(strftime("%d", strtotime($resdebut)));
                    // echo $resdebutcjour;

                    $resfin = $key[5];

                    $resfinjour = strtoupper(strftime("%A", strtotime($resfin)));
                    // echo $resfinjour;
                    $resfinmois = strtoupper(strftime("%b", strtotime($resfin)));
                    $resfinmois = substr($resfinmois,0,-1);
                    $resfinmois = utf8_encode($resfinmois);
                    // echo $resfinmois;
                    $resfincjour = strtoupper(strftime("%d", strtotime($resfin)));
                    // echo $resfincjour;

                    $resotpion1 = $key[6];
                    $resoption2 = $key[7];
                    $resotpion3 = $key[8];
                    $resprix = $key[9];
                ?>

                <a href="reservation.php?idresa=<?php echo $resid; ?>" class="creslist">
                    <section class="restop">
                        <section class="cdateres">
                            <section class="blocdate">
                                <article class="blocdatetop">
                                    <p class="jour"><?php echo $resdebutjour; ?></p>
                                </article>
                                <article class="blocdatebot">
                                    <p class="chiffrejour"><?php echo $resdebutcjour; ?></p>
                                    <p class="mois"><?php echo $resdebutmois; ?></p>
                                </article>
                            </section>
                            <article class="fleche">
                                <img id="imgfleche" src="img/fleche.png" alt="fleche">
                            </article>
                            <section class="blocdate">
                                <article class="blocdatetop">
                                    <p class="jour"><?php echo $resfinjour; ?></p>
                                </article>
                                <article class="blocdatebot">
                                    <p class="chiffrejour"><?php echo $resfincjour; ?></p>
                                    <p class="mois"><?php echo $resfinmois; ?></p>
                                </article>
                            </section>
                        </section>
                        <article class="crestarif">
                            <p>Lieu: <?php echo $reslieu;?></p>
                        </article>
                        <article class="crestarif">
                            <p>Prix: <?php echo $resprix;?>€</p>
                        </article>
                    </section>
                    <section class="resbot">
                        <section class="cimgres">
                            <?php
                            if ( $restype == "Tente" ) {
                                echo "<img class=\"imgres\" src=\"img/tente.png\" alt=\"tente\">";
                            }
                            else {
                                echo "<img class=\"imgres\" src=\"img/mobilhome.png\" alt=\"mobilhome\">";
                            }
                            ?>
                        </section>
                        <section class="coptionsres">
                            <article>
                                <p>Option 1:</p>
                                <?php
                                if ( $resotpion1 == "1" ) {
                                    echo "<span class=\"green\">✓</span>";
                                }
                                else {
                                    echo "<span class=\"orange\">✗</span>";
                                }
                                ?>
                            </article>
                            <article>
                                <p>Option 2:</p>
                                <?php
                                if ( $resoption2 == "1" ) {
                                    echo "<span class=\"green\">✓</span>";
                                }
                                else {
                                    echo "<span class=\"orange\">✗</span>";
                                }
                            ?>
                            </article>
                            <article>
                                <p>Option 3:</p>
                                <?php
                                if ( $resotpion3 == "1" ) {
                                    echo "<span class=\"green\">✓</span>";
                                }
                                else {
                                    echo "<span class=\"orange\">✗</span>";
                                }
                                ?>
                            </article>
                        </section>
                        <article class="csejourres">
                            <p>Durée du séjour: <span class="green"><?php echo $ressejour; ?></span> jour(s)</p>
                        </article>
                    </section>
                </a>
            <?php
            }
            }
            else {
                echo "<p class=\"pincorrect\">Vous devez être connecté en tant qu'administrateur pour accéder à cette page.</p>";
            }
        }
        else{
            echo "<p class=\"pincorrect\">Vous devez être connecté en tant qu'administrateur pour accéder à cette page.</p>";
        }
        ?>    
</main>

<?php
    include("footer.php");
    mysqli_close($cnx);
?>

</body>
</html>