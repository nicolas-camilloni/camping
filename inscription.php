<?php session_start() ?>

<!DOCTYPE html>

<html>

<head>
    <title>Campigo - Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<?php include("header.php"); ?>
    <main>
        <img class="top" src="img/topinscription.jpg">
        <section class="cform">
            <?php
            if ( isset($_SESSION['login']) ) {
            ?>
                <article class="dejaco">
                    <p class="pincorrect">ERREUR<br />
                    Vous êtes déjà connecté !</p>
                </article>
            <?php
            } 
            else 
            {
                ?>
                <article><h1>Inscription</h1></article>
                    <form class="form" action="inscription.php" method="post">
                        <label>Identifiant</label>
                        <input type="text" name="login" required>
                        <label>Mot de passe</label>
                        <input type="password" name="mdp" required>
                        <label>Confirmation du mot de passe</label>
                        <input type="password" name="mdpval" required>
                        <br />
                        <input type="submit" value="S'inscrire" name="valider">
                    </form>
                <?php

                if ( isset($_POST["valider"]) )
                {
                    $login = $_POST["login"];
                    $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT, array('cost' => 12));
                    $connexion = mysqli_connect("localhost", "root", "", "camping");
                    $requete3 = "SELECT login FROM utilisateurs WHERE login = '$login'";
                    $query3 = mysqli_query($connexion, $requete3);
                    $resultat3 = mysqli_fetch_all($query3);

                    if (!empty($resultat3)) 
                    {
                    ?>
                        <p class="pincorrect">Cet identifiant est déjà pris</p>
                    <?php
                    }
                    elseif ($_POST["mdp"] != $_POST["mdpval"]) 
                    {
                    ?>
                        <p class="pincorrect">Attention ! Mot de passe différents</p>
                    <?php
                    }
                    else 
                    {
                        $requete = "INSERT INTO utilisateurs (login, password) VALUES ('$login','$mdp')";
                        $query = mysqli_query($connexion, $requete);
                        header('Location:connexion.php');
                    }
                }
            }
            ?>
        </section>
    </main>
<?php
    include("footer.php");
    mysqli_close($connexion);

?>

</body>

</html>
