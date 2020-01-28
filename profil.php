<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
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

                <article><h1>Mes réservations</h1></article>
                <?php

                $requeteres = "SELECT reservations.id,lieu,type,sejour,debut,fin,option1,option2,option3,prix FROM reservations INNER JOIN utilisateurs ON reservations.id_utilisateur = utilisateurs.id WHERE login = '" . $_SESSION['login'] . "'";
                echo $requeteres;
                $queryres = mysqli_query($connexion, $requeteres);
                $resultatres = mysqli_fetch_all($queryres);

                foreach ( $resultatres as $key ) {
                ?>

                <a class="creslist">
                    <section class="restop"></section>
                    <section class="resbot"></section>
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
    <?php include("footer.php"); ?>
</body>

</html>