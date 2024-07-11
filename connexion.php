<?php

	// La fonction isset() détermine si une variable est déclarée et est différente de null
	if(isset($_POST['username']) && isset($_POST['password'])){

		// connexion à la base de donnée
		require 'connexion_bdd_mysqli.php';
		
		
		//-------------------------VERIFICATION DU MOT DE PASSE ET DU NOM D'UTILISATEUR LORS DE LA CONNEXION----------------------------------//
		
		
		// requête SQL qui selectionne l'utilisateur s'il existe.
		// On compare en fonction du pseudo puisqu'il est unique.
		$res = $conn->query
		("SELECT id_utilisateur,nom_utilisateur, mdp_utilisateur,profil_utilisateur
		FROM utilisateur 
		WHERE nom_utilisateur LIKE '".$_POST['username']."';"); 
		
		
		$res->data_seek(0); // Déplace le pointeur interne de résultat
		$item = $res->fetch_assoc(); // Lit une ligne de résultat MySQL dans un tableau associatif
				
		// si il y a au moins un résultat de la requête SQL alors on vérifie le mot de passe
		if(null !== $item) {
			// $row['mot_de_passe'] récupère l emot de passe de la requête SQL
			if (password_verify($_POST['password'],$item['mdp_utilisateur']))
			{
				session_start(); // la fonction session_start() démarre une nouvelle session
				
				$_SESSION['username'] = $_POST['username']; // Je stocke dans le tableau, un champ "Pseudo", avec le pseudo à l'intérieur
				
				$_SESSION['ConnOK']= true;
				
				$_SESSION['user'] = $item['profil_utilisateur']; 

				$_SESSION['mdp'] = $item['mdp_utilisateur'];

				$_SESSION['id'] = $item['id_utilisateur'];

				$conn->close(); // fermer la connexion
				
				header("Location:index.php"); // redirection vers la page d'accueil
				exit();
			}
			else {// sinon 
				?><div class="mdpInc">Mot de passe incorrect</div><?php // message d'erreur
			}
		}
		// sinon il n'y a pas de résultat cela signifie que le nom d'utilisateur entré est inexistant dans la base de donnée
		else 
		{
			echo "<h2>Compte utilisateur inexistant et/ou mot de passe incorrect</h2>"; // message d'erreur
		}
	}
?>


<html>
    <head>
	    <title>Connexion</title>
       <meta charset="utf-8">
	   <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/connexion.css" media="screen" type="text/css" />
		<!-- Une favicon est une petite image affichée à côté du titre de la page dans l'onglet du navigateur. -->
		<link rel="icon" type="image/x-icon" href="images/icone.png">
    </head>
    <body>
	<body>
		<nav>
			<ul class="nav-list">
				<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
				<li class="nav-item"><a href="index.php">Accueil</a></li>
			</ul>
		</nav>
        
		<div id="container">
            <form action="connexion.php" method="POST">
                
				<!-- titre -->
                <h1>Connexion</h1>
                
                <!-- champ pour rentrer son nom d'utilisateur -->
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <!-- champ pour rentrer son mot de passe -->
                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>
                
				<input type="submit" id='submit' value='Se connecter'>
                
				<br>
                <!-- lien qui renvoie vers la page de creation du compte -->
                Vous n'êtes pas encore inscrit ? <a class="button" href="inscription.php"><br>Créer un compte</a>
            </form>
        </div>
    </body>
</html>
