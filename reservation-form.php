<?php
session_start();
$_SESSION["num"] = 0;
?>

<html>
<head>
<title>Campigo - Réservation</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php include("header.php"); ?>
<main>
 <img class="top" src="img/topindex.jpg">
<section class="cform">
	 <?php
            date_default_timezone_set('Europe/Paris');
            $cnx = mysqli_connect("localhost", "root", "", "camping");
            if (isset($_SESSION["login"])) 
            {
                    $requete2 = "SELECT * FROM utilisateurs WHERE login='".$_SESSION['login']."'";
                    $query2 = mysqli_query($cnx, $requete2);
                    $resultat2 = mysqli_fetch_all($query2, MYSQLI_ASSOC);

                    $requeteprix = "SELECT * FROM tarifs";
                    $queryprix = mysqli_query($cnx, $requeteprix);
                    $resultatprix = mysqli_fetch_all($queryprix);
            ?>
                   <article><h1>Réserver</h1></article>
                   <form class="form" method="post" action="reservation-form.php">
                   <label for="text"><b>Lieu</b></label>
                   <select name="lieu">
                   <option value="Plage">Plage</option>
                   <option value="Pins">Pins</option>
                   <option value="Maquis">Maquis</option>
                   </select>
                   <br>
                   <label for="text"><b>Type</b></label>
                   <select name="type">
                   <option value="Tente">Tente (1 emplacement)</option>
                   <option value="Campingcar">Campingcar (2 emplacements)</option>
                   </select>
                   <br>
                  <section id="coptionsform">
                   <label for="text"><b>Options</b></label>
                   <article class="coptionsformcase"><input type="checkbox" name="option1" value="borne" /><p>Accès borne électrique (+<span class="green"><?php echo $resultatprix[0][0]; ?>€/j</span>)</p></article>
                   <article class="coptionsformcase"><input type="checkbox" name="option2" value="disco" /><p>Accès au Disco Club "Les girelles dansantes" (+<span class="green"><?php echo $resultatprix[0][1]; ?>€/j</span>)</p></article>
                   <article class="coptionsformcase"><input type="checkbox" name="option3" value="activites" /><p>Accès aux activités (Yoga, Frisbee et Ski Nautique) (+<span class="green"><?php echo $resultatprix[0][2]; ?>€/j</span>)</p></article>
                  </section>
                   <label for="datedebut"><b>Date debut</b></label>
                   <input type="date" name="datedebut" required> 
                   <br>
                   <label for="datefin"><b>Date fin</b></label>
                   <input type="date" name="datefin" required> 
                   <br>
                   <input type="submit" value="Réserver" name="valider" />
                   </form>
            <?php
                    $requetetarifs = "SELECT * FROM tarifs";
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
                          $sejour =  ($endunix - $startunix)/86400 + 1;
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
                          if($startdate < date('Y-m-d H:i:s')){
                              echo "Vous ne pouvez pas reserver a une date anterieur au ".date('d-m-Y H:i:s');
                          
                          }
                          elseif ($enddate < $startdate) {
                              echo "Vous ne pouvez pas choisir une date de fin antérieur a la date de debut";
                          }
                          else{
                              $resaverif = "SELECT * FROM reservations WHERE (debut BETWEEN '$startdate' AND '$enddate') OR (fin BETWEEN '$startdate' AND '$enddate')";
                              $queryverif = mysqli_query($cnx, $resaverif);
                              $resultatverif = mysqli_fetch_all($queryverif, MYSQLI_ASSOC);
                              // var_dump($resultatverif);
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
                              $requete = "INSERT INTO reservations (lieu, type, sejour, debut, fin, option1, option2, option3, prix, id_utilisateur) VALUES ('$lieu', '$type', '$sejour', '$startdate', '$enddate', '$option1', '$option2', '$option3', '$prix', ".$resultat2[0]['id'].")";
                              $query = mysqli_query($cnx, $requete);
                                   echo "<p class=\"green\">Votre réservation a bien été enregistrée.</p>";
                              }   
                          } 
                    }
            } 
            else 
            {
                 echo "<p>Bonjour, veuillez vous connecter afin de pouvoir réserver.</p><br />";
               
            }

            mysqli_close($cnx);
            ?>
</section>
</main>
 <?php include("footer.php"); ?>
</body>
</html>
