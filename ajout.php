<?php

//--------------------UTILISATION DE LA PDO--------------------//



// la fonction session_start() démarre une nouvelle session ou reprend une session existante,
session_start(); // ici on reprends la session existante démarée lors de la connexion.


//----- VERIFICATION DE LA CONNEXION DE L'UTILISATEUR -----//
if(!isset($_SESSION['ConnOK'])) {
	header("Location:connexion.php");
	exit();
}

//--------- AJOUT D'UN RESTAURANT ---------//

	// si les variable sont déclarées et est différentes de null
	if(isset($_POST['restaurant']) && isset($_POST['ville'])) {	

    	// connexion à la base de donnée
		require 'connexion_bdd_pdo.php';


		//-------------------REQUETES SQL POUR AJOUTER UN RESTAURANT----------------------//
		
		try{

			// Nous faisons façe à 3 cas :
			// - Le restaurant et la ville n'existe pas. (cas 1)
			// - La ville existe mais pas le restaurant. (cas 2)
			// - Le restaurant existe et donc la ville aussi. (cas 3)
			

			// c'est pourquoi nous avons fait deux requêtes res0 et res1 permettant de verifier respectivement 
			// le cas 1 et 2
			
			
			//----------REQUÊTE RES0---------//

			// requête qui va permettre de savoir si le restaurant que l'on cherche à ajouter 
			// existe déjà dans la base de donnée. Cela implique également que la ville n'existe pas.
			$res0 = $conn->query(
			"SELECT restaurant.id_ville,nom_restaurant 
			FROM ville,restaurant 
			WHERE ville.id_ville = restaurant.id_ville 
			AND nom_ville LIKE '".$_POST['ville']."' 
			AND nom_restaurant LIKE '".$_POST['restaurant']."';");


			//-------RESULTATS DE RES0---------/
			$nbr0 = $res0 -> rowCount(); // on calcule le nombre de résultats de la première requête SQL.
			
			// La classe PDOStatement propose une méthode permettant de récupérer ligne par ligne les résultats de la requête : fetch().
			$item0 = $res0 -> fetch(); 

			
			
			//------------VERIFICATION DES CAS-----------//

			if($nbr0 == 0){ // si le restaurant n'existe pas

				//---------REQUÊTE RES1----------//

				// requête qui permet de savoir si la ville existe déjà, auquel cas on récupère son id.
				$res1 = $conn->query(
				"SELECT id_ville
				FROM ville 
				WHERE nom_ville LIKE '".$_POST['ville']."';");

				$nbr1 = $res1 -> rowCount(); // on calcule le nombre de résultats de la seconde requête SQL.

				$item1 = $res1 -> fetch();

				if($nbr1 != 0){ // si  la ville existe déjà

					//-----------------NOUVEAU RESTAURANT SACHANT QUE LA VILLE EXISTE-------------------//

					// On peut donc directement procéder à l'insertion du restaurant

					$final_res = $conn -> query
					("INSERT INTO restaurant(id_ville,nom_restaurant)
					VALUES($item1[id_ville],'".$_POST['restaurant']."');");

					// la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
					// elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
					// mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
					$res0 -> closeCursor();
					$res1 -> closeCursor();
					$final_res -> closeCursor();
		
					// on ferme la connexion à la base de donnée
					$conn = null;

					// On renvoie l'utilisateur à l'accueil
					header("Location:index.php");
					exit();

				}
				else {

					// on insère la nouvelle ville dans la base de donnée
					$res2 = $conn->query("INSERT INTO ville(nom_ville) VALUES ('".$_POST['ville']."');");
	
					$item2 = $res2 -> fetch();
	
					// On récupère l'id de la ville qu'on vient nouvellement d'insérer
					$res3 = $conn->query("SELECT id_ville FROM ville WHERE nom_ville LIKE '".$_POST['ville']."';");
	
					$item3 = $res3 -> fetch();
	
					// Puis on insère le nouveau restaurant
					$final_res = $conn ->query("INSERT INTO restaurant(id_ville,nom_restaurant) 
					VALUES($item3[id_ville],'".$_POST['restaurant']."');");
	
					// la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
					// elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
					// mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
					$res0 -> closeCursor();
					$res2 -> closeCursor();
					$res3 -> closeCursor();
					$final_res -> closeCursor();
			
					// on ferme la connexion à la base de donnée
					$conn = null;
	
					// On renvoie l'utilisateur à l'accueil
					header("Location:index.php");
					exit();
				}
			}
			else {
				echo "<h2>Ce restaurant existe déjà !</h2>";
			}
		}
			// il nous reste plus qu'a traité le cas où le restaurant ainsi que la ville ne sont pas dans la bdd.
			// Par conséquant on peut simplement ajouté le nouveau restaurant ainsi que la nouvelle ville à la bdd.
				

		catch(PDOException $error) 
		{
			echo ("Erreur : ".$error->getMessage());
		}
	}
?>


<html lang="fr">
	<head>
    	<meta charset="utf-8">
	<title>Ajout d'un restaurant</title>
        
	<!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/ajout.css" media="screen" type="text/css" />
	
	<!-- Une favicon est une petite image affichée à côté du titre de la page dans l'onglet du navigateur. -->	
	<link rel="icon" type="image/x-icon" href="images/icone.png">
   
   	</head>
    <body>
	<nav>
		<ul class="nav-list">
			<!-- lien photo -->
			<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
			<!-- lein vers la page d'accueil -->
			<li class="nav-item"><a href="index.php">Accueil</a></li>
    			<!-- lien vers la page de profil -->
			<li class="nav-item"><a href="profil.php">Votre profil</a></li>
			<!-- lien pour se deconnecter (page de déconnexion) -->
			<li class="nav-item"><a href="deconnexion.php">Se déconnecter</a></li>
		</ul>
	</nav>
		<div id="container">
        	<form action="ajout.php" method="POST">
                
				<!-- titre -->
				<h1>Ajout d'un nouveau restaurant</h1>
                
				<!-- légende du champ nom du restaurant -->
            	<label><b>Nom du restaurant</b></label>
				<!-- champ de texte pour le nom du restaurant -->
            	<input type="text" placeholder="Entrer le nom du restaurant" name="restaurant" required>

				<!-- légende du champ  ville -->
            	<label><b>Ville</b></label>
				<!-- champ de texte pour le nom de la ville -->
            	<input type="text" placeholder="Entrer le nom de la ville" name="ville" required>

				<!-- bouton pour soumettre le contenu du formulaire -->
            	<input type="submit" id='submit' value='Ajouter le restaurant'>
        	</form>
		</div>
	</body>
</html>
