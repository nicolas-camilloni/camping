<?php
session_start();
setlocale (LC_TIME, 'fr_FR.utf8','fra');
date_default_timezone_set("Europe/Paris");
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Campigo - Mon compte</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <img class="top" src="img/topmoncompte.jpg">
        <section class="cform">
            <?php
            if (isset($_SESSION['login']))
            {
                $connexion = mysqli_connect("localhost", "root", "", "camping");
                $requete = "SELECT * FROM utilisateurs WHERE login='" . $_SESSION['login'] . "'";
                $query = mysqli_query($connexion, $requete);
                $resultat = mysqli_fetch_assoc($query);

                ?>

                <article><h1>Mon profil</h1></article>
                <form class="form" action="profil.php" method="post">
                    <label> Identifiant </label>
                    <input type="text" name="login" value=<?php echo $resultat['login']; ?> />
                    <label> Nouveau mot de passe </label>
                    <input type="password" name="passwordx" />
                    <label> Confirmation du mot de passe </label>
                    <input type="password" name="passwordconf" />
                    <input name="ID" type="hidden" value=<?php echo $resultat['id']; ?> />
                    <br>
                    <input type="submit" name="modifier" value="Modifier" />
                </form>
        </section>
        <section id="cres">
                <article><h1>Mes réservations</h1></article>
                <?php

                $requeteres = "SELECT reservations.id,lieu,type,sejour,debut,fin,option1,option2,option3,prix FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE login = '" . $_SESSION['login'] . "'";
                // echo $requeteres;
                $queryres = mysqli_query($connexion, $requeteres);
                $resultatres = mysqli_fetch_all($queryres);

                foreach ( $resultatres as $key ) {
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

                <a class="creslist">
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

                    if (isset($_POST['modifier']) ) 
                    {
                         if ($_POST["passwordx"] != $_POST["passwordconf"]) 
                         {
                             ?>
                            <p>Attention ! Mot de passe différents</p>
                        <?php
                        } 
                        elseif(isset($_POST['passwordx']) && !empty($_POST['passwordx'])){
                            $pwdx = password_hash($_POST['passwordx'], PASSWORD_BCRYPT, array('cost' => 12));
                            $updatepwd = "UPDATE utilisateurs SET password = '$pwdx' WHERE id = '" . $resultat['id'] . "'";
                            $query2 = mysqli_query($connexion, $updatepwd);
                            header('Location:profil.php');
                        }
                        $login = $_POST["login"];
                        $req = "SELECT login FROM utilisateurs WHERE login = '$login'";
                        $req3 = mysqli_query($connexion, $req);
                        $veriflog = mysqli_fetch_all($req3);
                            if(!empty($veriflog))
                            {
                                ?>
                                <p>Login deja utilisé, requete refusé.<br /></p>
                                <?php
                            }
                        if(empty($veriflog))
                            {
                                $updatelog = "UPDATE utilisateurs SET login ='" . $_POST['login'] . "' WHERE id = '" . $resultat['id'] . "'";
                                $querylog = mysqli_query($connexion, $updatelog);
                                $_SESSION['login']=$_POST['login'];
                                header("Location:profil.php");
                            }
                    }
                    ?>
        </section>
    <?php

    } 
    else 
    {
        ?>
            <p>Veuillez vous connecter pour accéder à votre page !</p>
        <?php
    }
    ?>

    </main>
    <?php
        include("footer.php");
        mysqli_close($connexion);
    ?>
</body>

</html>