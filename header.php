<header>
    <section id="topnav">
        <article id="campingstars">
            <p>CAMPING</p>
            <img src="img/stars.png" alt="etoiles">
            <img src="img/stars.png" alt="etoiles">
            <img src="img/stars.png" alt="etoiles">
            <img src="img/stars.png" alt="etoiles">
        </article>
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
        <nav class="nav">
            <section>
                <a href="index.php">Accueil</a>
            </section>
            <section>
                <a href="topics.php"><span>T</span>opics</a>
            </section>
            <?php if( !isset($_SESSION['login']) ){ ?>
            <section>
                <a href="inscription.php"><span>I</span>nscription</a>
            </section>
            <section>
                <a href="connexion.php"><span>C</span>onnexion</a>
            </section>
            <?php } if( isset($_SESSION['login']) ){ ?>
             <section>
                <a href="profil.php"><span>P</span>rofil</a>
            </section>
            <section>
                <form action="index.php" method="get">
                    <input type="submit" name="deco" value="Déconnexion" />
                </form>
                <a href="index.php?deco"><span>D</span>éconnexion</a>
            </section>
            <?php } ?>
        </nav>
    </header>
