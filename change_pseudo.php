<?php

//--------------------UTILISATION DE LA PDO--------------------//

// on récupère la session déjà existante
    session_start();
// connexion à la base de donnée
    require 'connexion_bdd_pdo.php';
?>


<html>
    <head>
	    <title>Changer de pseudo</title>
       <meta charset="utf-8">
	   <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/ajout.css" media="screen" type="text/css" />
		<!-- Une favicon est une petite image affichée à côté du titre de la page dans l'onglet du navigateur. -->
	    <link rel="icon" type="image/x-icon" href="images/icone.png">
    </head>
    <body>
        <nav>
			<ul class="nav-list">
				<!-- lien photo pour le logo de la page -->
				<li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
				<!-- lien vers l'acceuil -->
				<li class="nav-item"><a href="index.php">Accueil</a></li>
			</ul>
		</nav>
        <div id="container">
            <form action="change_pseudo.php" method="POST"> 
                
		<!-- titre -->
                <h1>Changer son pseudo</h1>
                    
		<!-- champ pour ecrire -->
                <label>Nom de votre pseudo actuel</label>
                <input type="text" placeholder="Entrez votre pseudo actuel" name="current_pseudo" required>
                
                <!-- champ pour ecrire -->
		<label>Nom de votre nouveau pseudo</label>
                <input type="text" placeholder="Entrez votre nouveau pseudo" name="new_pseudo" required>

                <!-- champ pour ecrire -->
		<label>Votre mot de passe</label>
                <input type="password" placeholder="Entrer votre mot de passe" name="password" required>
                
		<!-- boutton de confirmation --> 
                <input type="submit" id='submit' value='Valider'>

            </form>
        </div>
    </body>
</html>


<?php

//-------- Si l'utilisateur n'est pas connecté --------//

// Par mesure de sécurité, si l'utilisateur n'est pas connecté 
// on le renvoie vers la page de connexion
if(!isset($_SESSION['ConnOK'])) {
	header("Location : connexion.php");
	exit();
}


//--------------CHANGEMENT DE PSEUDO--------------//


// Si les champs sont remplis
if(isset($_POST['current_pseudo']) && isset($_POST['new_pseudo']) && isset($_POST['password'])){


    
    // Alors on verifie déja si les idetifiants à savoir son pseudo 
    // et son mot de passe actuel sont corrects.

    // On fait d'abord une recherche dans la base de donnée
    // Comparé uniquement avec le pseudo suffit
    // On a donc comme requête :
    $res = $conn -> query
    ("SELECT nom_utilisateur,mdp_utilisateur 
    FROM utilisateur
    WHERE nom_utilisateur LIKE '".$_POST['current_pseudo']."';");

    // On compte le nombre de résultats
    $nbr = $res -> rowCount();

    $item = $res -> fetch();


    // Si l'exécution de la requête contient un seul résultat et que le mot de passe est correct
    // Alors on peut faire le changement dans la base de donnée.
    if($nbr == 1 && password_verify($_POST['password'],$item['mdp_utilisateur'])){
        
        // requête final qui remplace l'ancien par le nouveau pseudo
        $final = $conn -> query
        ("UPDATE utilisateur 
        SET nom_utilisateur = '".$_POST['new_pseudo']."' 
        WHERE nom_utilisateur = '".$_POST['current_pseudo']."';");

        // la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
		// elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
		// mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
		$res -> closeCursor();
        $final -> closeCursor();
		
		// on ferme la connexion à la base de donnée
		$conn = null;

        // on revoie l'utilisateur à l'accueil du site.
        header("Location:index.php");
        exit();
    }
	
	// si l'utilisateur s'est trompé
    else { // alors on renvoie un message d'erreur
        echo "Il y a une erreur, vérifier !";
    }

}


?>
