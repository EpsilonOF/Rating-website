<?php
    // la fonction session_start() démarre une nouvelle session ou reprend une session existante
    session_start();// ici on reprends la session existante

    // connexion à la base de donnée
    require 'connexion_bdd_pdo.php';
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="styles/profil.css" media="screen" type="text/css" />
    <link rel="icon" type="image/x-icon" href="images/icone.png">
</head>
<body>
    <nav>
		<ul class="nav-list">
			<!-- lien photo qui renvoie sur acceuil -->
			<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
            		<!-- lien qui renvoie à l'accueil -->
			<li class="nav-item"><a href="index.php">Accueil</a></li>
            		<!-- lien qui renvoie la page d'ajout d'un restaurant -->
			<li class="nav-item"><a href="ajout.php">Ajouter un restaurant</a></li>
			<!-- lien qui renvoie à la page de notation d'un restaurant -->
			<li class="nav-item"><a href="notation.php">Noter un restaurant</a></li><!-- lien qui renvoie vers les notes des restaurants de l'utilisateur -->
            		<!-- lien qui permet de se déconnecter de sa session -->
			<li class="nav-item"><a href="deconnexion.php">Se déconnecter</a></li>
            
            <?php
		// si l'utilisateur est un admin
                if(isset($_SESSION['user']) && $_SESSION['user'] == 1) {
                    // lien qui renvoie vers la page de suppresion d'un utilisateur
				    echo "<li class=\"nav-item\"><a href=\"supprimer.php\">Supprimer un utilisateur</a></li>";
                }
            ?>
		</ul>
	</nav>
	<!-- liens qui renvoie vers la page pour modifier son pseudo ou son mot de passe  -->
    <div class="button pseudo"><a href="change_pseudo.php"><br>Modifier son pseudo</a><br><br>
    <div class="button mdp"><a href="change_mdp.php"><br>Modifier son mot de passe</a>
    	<!-- titre -->
	<h2>Dernières notes</h2>



<?php


    //-------- Si l'utilisateur n'est pas connecté --------//

    // Par mesure de sécurité, si l'utilisateur n'est pas connecté 
    // on le renvoie vers la page de connexion
    if(!isset($_SESSION['ConnOK'])) {
	    header("Location:connexion.php"); // renvoie vers la page de connexion
	    exit();
    }


    
    //-------------------------PAGE DE PROFILE-------------------------//


    // Affichage des derniers avis


    // Requête SQL pour récupérer les derniers restaurant que l'utilisateur à noté
	// on récupère les 3 derniers avis, on classe donc en fonction de l'id_notation de manière décroissante
    $res = $conn -> query
    ("SELECT DISTINCT id_notation,note,nom_restaurant,nom_ville
    FROM note AS n,notation AS no,utilisateur AS u, restaurant AS r, ville AS v
    WHERE no.id_restaurant = r.id_restaurant
        AND no.id_note = n.id_note
        AND r.id_ville = v.id_ville
        AND no.id_utilisateur = '".$_SESSION['id']."'
        ORDER BY id_notation
        LIMIT 3;");


// Si la requête n'a pas de résultats
    if(!$item = $res -> fetch()){
        echo "<h3>Vous n'avez encore rien noté</h3>";
    }else{
    ?>
    
    <!-- tableau permettant d'afficher les résultats de la recherche -->
        <div style="width: 550px; height: 400px; overflow-y: auto;overflow-x:hidden; margin-left: 580px; margin-top: -150px;border: 0px solid;text-align: center;">
                    <table class="freeze-table" width="548px">
            <thead>
                <tr>
                    <!-- Les noms des 2 colonnes du tableau -->
                    <th style="min-width:30px; width:100px;">Nom restaurant</th>
                    <th style="min-width:30px; width:100px;">Ville</th>
                    <th style="min-width:30px; width:100px;">Note</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            // la fonction fetch() récupére les élement du tableau de résultats    
            // On parcours le résultat.
                while ($item = $res -> fetch()){
                    ?>
                    <tr>
                        <td style="height: 50px;"><?php echo $item['nom_restaurant']; ?></td>
                        <td style="height: 50px;"><?php echo $item['nom_ville']; ?></td>
                        <td style="height: 50px;"><?php echo $item['note']; ?></td>
                    </tr>
                    <?php
                }
            }
                        ?>
            </tbody>
        </div>
        
    </body>
</html>
