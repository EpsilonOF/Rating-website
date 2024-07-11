<?php

//--------------------UTILISATION DE LA PDO--------------------//


// la fonction session_start() démarre une nouvelle session ou reprend une session existante
session_start(); // ici on reprends la session existante démarée lors de la connexion
?>
<?php

require 'connexion_bdd_pdo.php';

//--------------REQUÊTE SQL--------------//


// requête SQL pour récupérer les notes associées au restaurant
$res1 = $conn -> query
("SELECT note,nom_utilisateur,nom_restaurant 
FROM note AS n,notation AS no,utilisateur AS u, restaurant AS r
WHERE no.id_utilisateur = u.id_utilisateur 
AND no.id_restaurant = r.id_restaurant 
AND no.id_note = n.id_note
AND no.id_restaurant = '".$_GET['id_restaurant']."';");

?>

<html lang="fr">
	<head>
    	<meta charset="utf-8">

        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/consultation.css" media="screen" type="text/css" />
		<!-- Une favicon est une petite image affichée à côté du titre de la page dans l'onglet du navigateur. -->
		<link rel="icon" type="image/x-icon" href="images/icone.png">
    </head>
    <body>
	<nav>
		<ul class="nav-list">
			<!-- lien photo -->
			<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
			<!-- lien vers l'accueil -->
			<li class="nav-item"><a href="index.php">Accueil</a></li>
    		<?php
			// si la varaible $_SESSION['ConnOK'] est définit et non nulle 
			// Autrement dit si l'utilisateur est connecté
			if(isset($_SESSION['ConnOK'])){ // Alors
				// On affiche un lien vers la page profil et de déconnexion 
				echo	"<li class=\"nav-item\"><a href=\"profil.php\">Votre profil</a></li>";
				echo	"<li class=\"nav-item\"><a href=\"deconnexion.php\">Se déconnecter</a></li>";
			}
			else { // Sinon
				// lien qui renvoie vers la page de connexion 
				echo "<li class=\"nav-item\"><a href=\"connexion.php\">Se connecter</a></li>";
				// lien qui renvoie vers la page de creation du compte
				echo "<li class=\"nav-item\"><a href=\"inscription.php\">Créer son compte</a></li>";
				}
			?>
		</ul>
	</nav>
    <?php
	    
// On récupère  ligne par ligne les résultats de la requête
    if(!$item1 = $res1 -> fetch()){
        echo "<div class=\"pasRestaurant\">Pas encore de notes pour ce restaurant.<br><br>  Soyez le premier à en mettre une !</div>";
    }else{
        ?>
	<!-- tableau permettant d'afficher les résultats de la recherche -->
	<div style="width: 550px; height: 600px; overflow-y: auto;overflow-x:hidden; margin-left: 650px; margin-top: 50px;border: 0px solid;text-align: center;">
				<table class="freeze-table" width="548px">
			<thead>
				<tr>
					<!-- Les noms des 3 colonnes du tableau -->
					<th style="min-width:30px; width:100px;color: red;">Nom restaurant</th>
					<th style="min-width:30px; width:100px;color: red;">Note</th>
					<th style="min-width:30px; width:100px;color: red;">Nom d'utilisateur</th>
				</tr>
			</thead>
			<tbody>
			<?php 
    
				// la fonction fetch() récupére les élement du tableau de résultats	
				// On parcours le résultat.
				while ($item1 = $res1 -> fetch()){
					?>
					<tr>
						<td style="text-align:center ;min-width:30px; width:100px; height: 50px;"><?php echo $item1['nom_restaurant']; ?></td>
						<td style="text-align:center ;min-width:30px; width:100px; height: 50px;"><?php echo $item1['note']; ?></td>
						<td style="text-align:center ;min-width:30px; width:100px; height: 50px;"><?php echo $item1['nom_utilisateur']; ?></td>
					</tr>
					<?php
				}
    }
						?>
			</tbody>
		</table>
	</div>
</html>
