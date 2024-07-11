<?php

//--------------------UTILISATION DE LA PDO--------------------//

// la fonction session_start() démarre une nouvelle session ou reprend une session existante
session_start(); // ici on reprends la session existante démarée lors de la connexion
?>
<html>
	<head>
		<title>Accueil</title>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/index.css" media="screen" type="text/css" />
		<link rel="icon" type="image/x-icon" href="images/icone.png">
    </head>
    <body>
	<header>
	<nav>
		<ul class="nav-list">
			<!-- lien photo -->
			<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
			
			<?php

			if(isset($_SESSION['ConnOK'])){
				// lien qui renvoie vers la page d'ajout d'un restaurant
				echo "<li class=\"nav-item\"><a href=\"ajout.php?id_restaurant=2\">Ajouter un restaurant</a></li>";
				// lien qui renvoie vers la page de notation d'un restaurant
				echo "<li class=\"nav-item\"><a href=\"notation.php\">Noter un restaurant</a></li>";
				// lien qui renvoie vers la page de profil
				echo "<li class=\"nav-item\"><a href=\"profil.php\">Votre profil</a></li>";
				// lien qui renvoie vers la page d'accueil en étant non-connecté à son compte
				echo "<li class=\"nav-item\"><a href=\"deconnexion.php\">Se déconnecter</a></li>";
			}
			else {
			// lien qui renvoie vers la page de connexion 
			echo "<li class=\"nav-item\"><a href=\"connexion.php\">Se connecter</a></li>";
			// lien qui renvoie vers la page de creation du compte
			echo "<li class=\"nav-item\"><a href=\"inscription.php\">Créer son compte</a></li>";
			}
			?>
		</ul>
	</nav>
	</header>
		<!-- Si l'utilisateur a réussi à se connecter, on crée une session au nom de l'utilisateur
	    et on le redirige vers l'accueil -->
		<div id="content">
			<!-- tester si l'utilisateur est connecté -->
		</div>
		<h1>Trouvez le meilleur restaurant <br>autour de vous</h1>
		<div id="searchbox">
            <!-- on intègre le formulaire, la méthode get permet de visualiser les mots écrits dans la barre -->
		    <form method="POST" action="index.php">
			    <!-- on creer la zone de texte qui permet de saisir les mots clés de la recherche -->
			    <input type="text" name="keywords" placeholder="Rechercher un restaurant, une ville..."/>
			    <!-- button de type submit qui permet de soumettre le formulaire au serveur -->
				<input type="submit" id='submit' value='Rechercher'>
			</form>
        </div>
	<?php
	

	// si les mots clés de la recherche sont déclarées et non nulles 
	if(isset($_POST['keywords'])){    
		
		// connexion à la base de donnée
		require 'connexion_bdd_pdo.php';

		try{
		//-------------------------ENVOIE DE LA REQUETE SQL SUITE A LA RECHERCHE----------------------------------//
		

		// Envoie de la requête SQL
		// On effectue dans la requête dans les tables resturant et ville
		// en fonction des mots écrits dans dans le champ de la recherche.
		// recherche qui fonctionne en fonction de la ville ou du nom du restaurant
		$res = $conn -> query(
		"SELECT id_restaurant, nom_restaurant, nom_ville
		FROM restaurant, ville 
		WHERE restaurant.id_ville = ville.id_ville
		AND (nom_restaurant LIKE '".'%'.$_POST['keywords'].'%'."'
		OR ville.nom_ville LIKE '".'%'.$_POST['keywords'].'%'."');"); 

		// La fonction rowCount() compte le nombre de résultats de la requête SQL
		// On compte donc le nombre de résultats.
		$nbr = $res -> rowCount();

				
		// si il n'y a pas résultat de la requête SQL 
		if($nbr == 0) {
			// on renvoie un message
			echo "<h2>Aucune correspondance avec votre recherche</h2>";
		}

		else // sinon, on affiche les résultats dans un tableau
		{

			// la fonction fetch() récupére les élement du tableau de résultats	
			?>
				<!-- tableau permettant d'afficher les résultats de la recherche -->
				<div style="width: 550px; height: 400px; overflow-y: auto;overflow-x:hidden; margin-left: 650px; margin-top: 250px;border: 0px solid;text-align: center;">
				<table class="freeze-table" width="548px">
					<thead>
						<tr>
							<!-- Les noms des 3 colonnes du tableau -->
							<th style="min-width:30px; width:100px;">Nom du restaurant</th>
							<th style="min-width:30px; width:100px;">Ville</th>
							<th style="min-width:30px; width:100px;">Note</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						while ($item = $res -> fetch()){
						?>
						<tr>
							<td style="text-align:center ;min-width:30px; width:100px; height: 50px;"><?php echo $item['nom_restaurant']; ?></td>
							<td style="text-align:center ;min-width:30px; width:100px; height: 50px;"><?php echo $item['nom_ville']; ?></td>
							<td style="text-align:center ;min-width:30px; width:100px; height: 50px;"><?php echo "<a class=\"consultation\" href=\"consultation.php?id_restaurant=$item[id_restaurant]\">Consulter</a>>" ?></td>
					</tr>
					<?php
						}
						?>
				</tbody>
			</div>
		<?php			
		}

		// la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
		// elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
		// mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
		$res -> closeCursor();
		
		// on ferme la connexion à la base de donnée
		$conn = null; 

        }
		catch(PDOException $error)
		{
			echo ("Erreur : ".$error->getMessage());
		}	
	}	
	?>

	</body>
</html>
