<?php

session_start();

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
    <title>Campigo - Accueil</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include("header.php");
?>

<main>
    <img class="top" src="img/topindex.jpg">
    <article id="cbvn">
        <h1>Campigo, un camping idéalement placé</h1>
        <p>Notre camping familial 4 étoiles vous accueille dans un environnement privilégié à quelques kilomètres de Marseille pour découvrir les plus grands sites de la région PACA. Les rivières sont à 3 km pour la pratique du canoé. Nous vous proposons de vous retrouver en famille et de profiter de nos bons plans dans notre camping à Marseille en location mobil home ou tente. Pour les randonnées pédestres ou équestres, vous partirez sur des chemins de randonnées balisés à partir du camping. Des jeunes enfants dans votre famille? Ne cherchez plus! Notre camping vous propose des animations et activités qui leur sont spécialement dédiés.</p>
    </article>
    <section id="ctarif">
        <section id="toptarif">
            <h1>TARIFS</h1>
        </section>
        <section id="tarif">
            <section class="ctabletarif1">
                <article id="titretarif">
                    <img id="imgtente" src="img/tente.png" alt="tente">
                    <h1>Tente</h1>
                </article>
                <article class="casetarif">
                    <p>Emplacements occupés: <span class="green">1</span></p>
                </article>
                <article class="casetarifnoborder">
                    <p>Prix: <span class="green">10€/j</span><p>
                </article>
                <article id="optioncase">
                    <p>Options</p>
                </article>
                <article class="casetarif">
                    <p>Accès borne électrique: <span class="green">+2€/j</span></p>
                </article>
                <article class="casetarif">
                    <p>Accès au Disco Club "Les girelles dansantes": <span class="green">+17€/j</span></p>
                </article>
                <article class="casetarif">
                    <p>Accès aux activités (Yoga, Frisbee et Ski Nautique): <span class="green">+30€/j</span></p>
                </article>
            </section>
            <section class="ctabletarif2">
                <article id="titretarif">
                    <img id="imgtente" src="img/mobilhome.png" alt="mobilhome">
                    <h1>Campingcar</h1>
                </article>
                <article class="casetarif">
                    <p>Emplacements occupés: <span class="green">2</span></p>
                </article>
                <article class="casetarifnoborder">
                    <p>Prix: <span class="green">20€/j</span><p>
                </article>
                <article id="optioncase">
                    <p>Options</p>
                </article>
                <article class="casetarif">
                    <p>Accès borne électrique: <span class="green">+2€/j</span></p>
                </article>
                <article class="casetarif">
                    <p>Accès au Disco Club "Les girelles dansantes": <span class="green">+17€/j</span></p>
                </article>
                <article class="casetarif">
                    <p>Accès aux activités (Yoga, Frisbee et Ski Nautique): <span class="green">+30€/j</span></p>
                </article>
            </section>
        </section>
        <section id="cbtnres">
            <a href="reservation-form.php"><p>Réserver</p></a>
        </section>
    </section>
</main>

<?php
    include("footer.php");
?>

</body>
</html>