  <footer>
        <nav>
            <a href="index.php"><span>A</span>ccueil</a>
            <?php if(!isset($_SESSION['login'])){ ?>
            <a href="inscription.php"><span>I</span>nscription</a>
            <a href="connexion.php"><span>C</span>onnexion</a>
            <?php } if(isset($_SESSION['login'])){ ?>
            <a href="profil.php"><span>P</span>rofil</a>
            <?php } ?>
            <a href="topics.php"><span>T</span>opics</a>
        </nav>
        <article>
            <p>Copyright 2019 Coding School | All Rights Reserved | Project Nicolas.</p>
        </article>
    </footer>
