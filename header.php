<header>
    <section id="topnav">
        <a href="admin.php"><article id="campingstars">
            <p>CAMPING</p>
            <img src="img/stars.png" alt="etoiles">
            <img src="img/stars.png" alt="etoiles">
            <img src="img/stars.png" alt="etoiles">
            <img src="img/stars.png" alt="etoiles">
            <?php
            if ( isset($_SESSION['login']) && $_SESSION['login'] == "admin" ) {
            ?>
            <article id="adminpannel">
                <img src="img/admin.png" alt="administrateur">
                <p>Admin</p>
            </article>
            <?php
            }
            ?>
        </article></a>
        <article id="campingcontact">
            <article id="tel">
                <img src="img/tel.png">
                <p>06 01 02 03 04</p>
            </article>
            <article id="adresse">
                <img src="img/adresse.png">
                <p>4 rue des cocotiers jaunes</p>
            </article>
        </article>
    </section>
    <a href="index.php" id="logocamping">
        <img src="img/logocamping.png" alt="logo">
    </a>
    <nav class="nav">
        <section id="navleft">
            <section>
                <a href="index.php"><p>Accueil</p></a>
            </section>
            <section>
                <a href="planning.php"><p>Planning</p></a>
            </section>
        </section>
        <section id="navright">
            <?php if( !isset($_SESSION['login']) ){ ?>
            <section>
                <a href="inscription.php"><p>Inscription</p></a>
            </section>
            <section>
                <a href="connexion.php"><p>Connexion</p></a>
            </section>
            <?php } if( isset($_SESSION['login']) ){ ?>
             <section>
                <a href="profil.php"><p>Mon compte</p></a>
            </section>
            <section>
                <form action="index.php" method="get">
                    <button type="submit" name="deco" value="Déconnexion">
                </form>
                <a href="index.php?deco"><p>Déconnexion</p></a>
            </section>
            <?php } ?>
        </section>
    </nav>
</header>
