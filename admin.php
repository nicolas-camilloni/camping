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
    <title>Campigo - ADMIN PANEL</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
    include("header.php");
?>

<main>
    <img class="top" src="img/topindex.jpg">

    <?php  

           $cnx = mysqli_connect("localhost", "root", "", "camping");
           $requetetarifs = "SELECT * FROM tarifs";
           $querytarifs = mysqli_query($cnx, $requetetarifs);
           $resultattarifs = mysqli_fetch_all($querytarifs, MYSQLI_ASSOC);
           $tarifeactuel = $resultattarifs[0]['tarifemplacement'];
           $tarifeo1actuel = $resultattarifs[0]['tarifo1'];
           $tarifeo2actuel = $resultattarifs[0]['tarifo2'];
           $tarifeo3actuel = $resultattarifs[0]['tarifo3'];

            if (!empty($_SESSION['login'])) 
             {

              if ($_SESSION['login'] == "admin") {
    ?>
                <form action="admin.php" method="post">
                <section class="cform">
                <?php echo "Tarif actuel de l'option 1: ".$tarifeo1actuel; ?>
                <br>
                <br>
                <label>Modifier Tarif Option 1</label>
                <input type="number" id="newtarifo1" name="newtarifo1">
                <br>
                <?php echo "Tarif actuel de l'option 2: ".$tarifeo2actuel; ?>
                <br>
                <br>
                <label>Modifier Tarif Option 2</label>
                <input type="number" id="newtarifo2" name="newtarifo2">
                <br>
                <?php echo "Tarif actuel de l'option 3: ".$tarifeo3actuel; ?>
                <br>
                <br>
                <label>Modifier Tarif Option 3</label>
                <input type="number" id="newtarifo3" name="newtarifo3">
                <br>
                <?php echo "Tarif actuel d'1 emplacement: ".$tarifeactuel; ?>
                <br>
                <br>
                <label>Modifier Tarif Emplacement</label>
                <input type="number" id="newtarifemplacement" name="newtarifemplacement">
                <br>
                <input type="submit" name="modiftarifs" value="Modifier" />
                </section>
                </form>  
            <?php 
              if (isset($_POST['modiftarifs']) ) {
                   $newtarifo1 = $tarifeo1actuel;
                   $newtarifo2 = $tarifeo2actuel;
                   $newtarifo3 = $tarifeo3actuel;
                   $newtarifemplacement = $tarifeactuel;

                   if(!empty($_POST['newtarifo1'])){
                    $newtarifo1 = $_POST['newtarifo1'];
                   }
                    if(!empty($_POST['newtarifo2'])){
                    $newtarifo2 = $_POST['newtarifo2'];
                   }
                   if(!empty($_POST['newtarifo3'])){
                    $newtarifo3 = $_POST['newtarifo3'];
                   }
                   if(!empty($_POST['newtarifemplacement'])){
                    $newtarifemplacement = $_POST['newtarifemplacement'];
                   }


                    $changetarifs = "UPDATE tarifs SET tarifo1 ='$newtarifo1', tarifo2 ='$newtarifo2', tarifo3 ='$newtarifo3', tarifemplacement ='$newtarifemplacement' ";
                    $querychangetarifs = mysqli_query($cnx, $changetarifs);
                    header('Location:admin.php');
                }
            }
            else {
                echo "Vous n'avez pas acces a cette page.";
            }
        }
        else{
            echo "Vous devez vous connecter en tant qu'admin pour acceder a cette page";
        }
        ?>
    
</main>

<?php
    include("footer.php");
?>

</body>
</html>