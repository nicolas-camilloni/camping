<?php
session_start();
ob_start();
$cnx = mysqli_connect("db5000890310.hosting-data.io", "dbu594451", "S26n6j29p20m13!", "dbs781078");
if ( isset($_GET["idresa"]) ) {
$idresa = $_GET["idresa"];
$requete1 = "SELECT lieu,type,sejour,debut,fin,option1,option2,option3,prix FROM camping_reservations WHERE id=$idresa";
$query1 = mysqli_query($cnx, $requete1);
$resultat = mysqli_fetch_all($query1, MYSQLI_ASSOC);
$taille = count($resultat) - 1;
$datedebutformat = date("Y-m-d",strtotime($resultat[0]['debut'])); 
$datefinformat = date("Y-m-d", strtotime($resultat[0]['fin']));
}
?>
<html>
<head>
<title>INFO RESERVATION</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include("header.php"); ?>
<main>
<img class="top" src="img/topindex.jpg">
    <section class="cform">
    <article><h1>Modifier la réservation</h1></article>
      <?php  
      if (!empty($_SESSION['login']) && $_SESSION['login'] == "admin" ) 
      {
      ?>
      <form class="form" action="reservation.php?idresa=<?php echo $idresa ?>" method="post" enctype="multipart/form-data">
                            <section class="cform">
                               <label for="text"><b>Lieu</b></label>
                               <select name="lieu">
                               <option value="<?php echo $resultat[0]['lieu'] ?>"><?php echo "Lieu Actuel: ".$resultat[0]['lieu'] ?></option>
                               <option value="Plage">Plage</option>
                               <option value="Pins">Pins</option>
                               <option value="Maquis">Maquis</option>
                               </select>
                               <br>
                               <label for="text"><b>Type</b></label>
                               <select name="type">
                                <option value="<?php echo $resultat[0]['type'] ?>"><?php echo "Lieu Actuel: ".$resultat[0]['type'] ?></option>
                               <option value="Tente">Tente</option>
                               <option value="Campingcar">Camping Car</option>
                               </select>
                               <br>
                               <section id="coptionsform">
                               <label for="text"><b>Options</b></label>
                               <?php 
                               if($resultat[0]['option1'] == 0)
                               {
                               ?>
                              <article class="coptionsformcase"><input type="checkbox" name="option1" value="borne" /><p>Accès borne électrique</p></article>
                               <br>
                               <?php
                               }
                               else{
                               ?>
                              <article class="coptionsformcase"><input type="checkbox" name="option1" value="borne" checked/><p>Accès borne électrique</p></article>
                               <?php
                               }
                               if($resultat[0]['option2'] == 0)
                               {
                               ?>
                              <article class="coptionsformcase"><input type="checkbox" name="option2" value="disco" /><p>Accès au Disco Club "Les girelles dansantes</p></article>
                               <br>
                               <?php
                               }
                               else{
                               ?>
                              <article class="coptionsformcase"><input type="checkbox" name="option2" value="disco" checked/><p>Accès au Disco Club "Les girelles dansantes</p></article>
                               <?php
                               }
                               if($resultat[0]['option3'] == 0)
                               {
                               ?>
                              <article class="coptionsformcase"><input type="checkbox" name="option3" value="activites" /><p>Accès aux activités (Yogo, Frisbee et Ski Nautique)</p></article>
                               <br>
                               <?php
                               }
                               else{
                               ?>
                              <article class="coptionsformcase"><input type="checkbox" name="option3" value="activites" checked/><p>Accès aux activités (Yogo, Frisbee et Ski Nautique)</p></article>
                               <?php
                               }
                               ?>
                               </section>
                               <br>
                               <label for="datedebut"><b>Date debut</b></label>
                               <input type="date" value="<?php echo "$datedebutformat" ?>" name="datedebut" required> 
                               <br>
                               <label for="datefin"><b>Date fin</b></label>
                               <input type="date" value="<?php echo "$datefinformat" ?>" name="datefin" required> 
                               <br>
                               <input type="submit" value="Modifier" name="valider" />
                            </section>
                        </form>

                   <?php
                    $requetetarifs = "SELECT * FROM camping_tarifs";
                    $querytarifs = mysqli_query($cnx, $requetetarifs);
                    $resultattarifs = mysqli_fetch_all($querytarifs, MYSQLI_ASSOC);
                    if ( isset($_POST["valider"]) )
                    {
                          $lieu = $_POST['lieu'];
                          $type = $_POST['type'];
                          $capacite = 4;
                          $capaciteneed = 0;
                          $option1 = 0;
                          $option2 = 0;
                          $option3 = 0;
                          $datedebut = $_POST['datedebut'];
                          $datefin = $_POST['datefin'];
                          $startdate = date('Y-m-d H:i:s', strtotime($datedebut));
                          $enddate = date('Y-m-d H:i:s', strtotime($datefin));
                          $startunix = strtotime($datedebut);
                          $endunix = strtotime($datefin);
                          $sejour =  ($endunix - $startunix)/86400;
                          $prix = 0;
                          if ($type == "Tente") {
                            $prix =  $resultattarifs[0]['tarifemplacement'] * $sejour;
                            $capaciteneed = 1;
                          }
                          if ($type == "Campingcar") {
                            $prix = ($resultattarifs[0]['tarifemplacement'] * 2) * $sejour;
                            $capaciteneed = 2;
                          }
                          if(isset($_POST['option1']))
                          {
                            $option1 = 1;
                            $prix = $prix + ($resultattarifs[0]['tarifo1'] * $sejour);
                          }
                          if(isset($_POST['option2']))
                          {
                            $option2 = 1;
                            $prix = $prix + ($resultattarifs[0]['tarifo2'] * $sejour);
                          }
                          if(isset($_POST['option3']))
                          {
                            $option3 = 1;
                            $prix = $prix + ($resultattarifs[0]['tarifo3'] * $sejour);
                          }
                              $resaverif = "SELECT * FROM camping_reservations WHERE (debut BETWEEN '$startdate' AND '$enddate') OR (fin BETWEEN '$startdate' AND '$enddate')";
                              $queryverif = mysqli_query($cnx, $resaverif);
                              $resultatverif = mysqli_fetch_all($queryverif, MYSQLI_ASSOC);
                              if(!empty($resultatverif)){
                                $taille = sizeof($resultatverif);
                                $i = 0;
                                while ($i < $taille) {
                                      if ($resultatverif[$i]['type'] == "Tente" && $resultatverif[$i]['lieu'] == $lieu) {
                                          $capacite = $capacite - 1;
                                      }
                                      if ($resultatverif[$i]['type'] == "Campingcar" && $resultatverif[$i]['lieu'] == $lieu) {
                                          $capacite = $capacite - 2;
                                      }
                                  $i++;
                                }
                              }
                              if ($capacite < $capaciteneed) {
                                echo "<p class=\"pincorrect\">Plus de place disponible à cette date.</p>";
                              }
                              else{
                              $update = "UPDATE camping_reservations SET lieu='$lieu', type='$type', sejour='$sejour',debut='$datedebut', fin='$datefin',option1='$option1',option2='$option2', option3='$option3', prix='$prix' WHERE id = $idresa";
                              header("Location:reservation.php?idresa=".$idresa."");
                              $updatequery = mysqli_query($cnx, $update);
                              }
                          } 
                  

            mysqli_close($cnx);
       ?>
    </section>
    <?php
        }
        else {
            ?>
            <p class="pincorrect">Il faut être connecté en tant qu'administrateur afin de pouvoir accéder à cette page.</p>
            <?php
        }
    ?>

                       
</section>
</main>
 <?php include("footer.php"); ?>
</body>
</html>