<?php

    session_start();
    $_SESSION["num"] = 0; 
    $ismdpwrong = false;
    $isIDinconnu = false;
    $ischampremplis = false;

    if ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) != 0 && isset($_POST['password']) && strlen($_POST['password']) != 0 ) {
        $connexion = mysqli_connect("db5000890310.hosting-data.io", "dbu594451", "S26n6j29p20m13!", "dbs781078");
        $requete = "SELECT * FROM camping_utilisateurs WHERE login ='".$_POST['login']."'";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        if ( !empty($resultat) ) {
            if ( password_verify($_POST['password'], $resultat[0][2]) )
                    {
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['password'] = $_POST['password'];
                        header('Location:index.php');
                    }
            else {
                $ismdpwrong = true;
            }
        }
        else {
            $isIDinconnu = true;
        }
        mysqli_close($connexion);
    }
    elseif ( isset($_POST['connexion']) == true && isset($_POST['login']) && strlen($_POST['login']) == 0 || isset($_POST['password']) && strlen($_POST['password']) == 0 ) {
        $ischampremplis = true;
    }

?>

<!DOCTYPE html>

<html>
<head>
    <title>Campigo - Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include("header.php"); ?>
    <main>
        <img class="top" src="img/topconnexion.jpg">
        <section class="cform">
            <?php
            if ( !isset($_SESSION['login']) ) {
                ?>
                <article><h1>Connexion</h1></article>
                <form class="form" method="post" action="connexion.php">
                    <label>Identifiant</label>
                    <input type="text" name="login" ><br />
                    <label>Mot de passe</label>
                    <input type="password" name="password" ><br />
                    <input type="submit" value="Se connecter" name="connexion" >
                </form>
                <?php
                if ( $ismdpwrong == true ) {
                ?>
                    <p class="pincorrect">Identifiant ou mot de passe incorrect.</p>
                <?php
                }
                elseif ( $isIDinconnu == true ) {
                ?>
                    <p class="pincorrect">Cet identifiant n'exsite pas.</p>
                <?php
                }
                elseif ( $ischampremplis == true ) {
                ?>
                    <p class="pincorrect">Merci de remplir tous les champs!</p>
                <?php
                }
            }

            elseif ( isset($_SESSION['login']) ) {
            ?>
                <article class="dejaco">
                    <p class="pincorrect">ERREUR<br />
                    Vous êtes déjà connecté !</p>
                </article>
            <?php
            }
            ?>
        </section>
    </main>
    <?php include("footer.php"); ?>
</body>
</html>