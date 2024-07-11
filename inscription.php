<?php


	// si les champs sont remplis 
	if(isset($_POST['username']) && isset($_POST['password'])){
		
		// connexion à la bdd
		require 'connexion_bdd_mysqli.php';
		
		
//------ON RECUPERE LE NOM D'UTILISATEUR AFIN DE VERIFIER S'IL EXISTE DEJA----------//

		// requête qui récupère le nom d'utilisateur si il est déjà utilisé
		$res = $conn->query("SELECT nom_utilisateur FROM utilisateur WHERE nom_utilisateur LIKE '".$_POST['username']."';"); 
		// on récupère les résultats de la reqête SQL sous forme de tableau
		$res->data_seek(0);
		
		$row = $res->fetch_assoc();
		
		
//------------------------------INSERTION DU NOUVEL UTILISATEUR---------------------------------------//
		
		
		// on crée la variable $pass_hash qui stock le password chiffré
		$pass_hash = password_hash($_POST['password'],PASSWORD_DEFAULT);
		
		
		// si la réponse à la requête SQL précdente est non nulle
		if(null !== $row) {
			// alors on affiche un message d'erreur
			?><div class="nomDejaPris">Nom d'utilisateur déjà utilisé</div><?php
		}
		// sinon
		else {
			// on verifie si le nom d'utlisateur rentré existe déjà
			// (methode query qui renvoie un boolean pour savoir si tout c'est bien passé)
			// on execute la requête SQL permettant d'insérer un nouvel utilisateur dans la base de donnée
			if(!$conn->query("INSERT INTO utilisateur(mdp_utilisateur,nom_utilisateur) VALUES ('".$pass_hash."','".$_POST['username']."');"))
			{
				// si oui, on renvoie un message d'erreur
				echo "Error : (" . $conn->errno . ") " . $conn->error; 
			} 
			else { // sinon
				header("Location:connexion.php"); // redirection vers la page de connexion
				exit();
			}
		}
		
		// On ferme la connexion
		$conn->close(); 
	}
?>

<html>
	<head>
		<title>Inscription</title>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/connexion.css" media="screen" type="text/css" />
		<link rel="icon" type="image/x-icon" href="images/icone.png">
    </head>
    	<nav>
			<ul class="nav-list">
				<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
				<li class="nav-item"><a href="index.php">Accueil</a></li>
			</ul>
		</nav>
		<div id="container">
            <form action="inscription.php" method="POST">
                
				<!-- titre -->
				<h1>Inscription</h1>
                
				<!-- légende du champ nom d'utilisateur -->
                <label><b>Nom d'utilisateur</b></label>
				<!-- champ de texte pour le nom d'utilisateur -->
                <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username" required>

				<!-- légende du champ  mot de passe -->
                <label><b>Mot de passe</b></label>
				<!-- champ de texte pour le mot de passe -->
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

				<!-- bouton pour soumettre le contenu du formulaire -->
                <input type="submit" id='submit' value='Creer son compte'>
                
				<!-- lien qui renvoie vers la page de connexion -->
				<br>Vous êtes déjà inscrit ? <a class="button" href="connexion.php"><br>Se connecter</a>
            </form>
        </div>
    </body>
</html>
