<?php

//--------------------UTILISATION DE LA PDO--------------------//

    // la fonction session_start() démarre une nouvelle session ou reprends une session existante,
    session_start(); // ici on reprends la session existante démarée lors de la connexion

    // connexion à la base de donnée
    require 'connexion_bdd_pdo.php';
?>

<html>
    <head>
	    <title>Changer de mot de passe</title>
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
				<!-- lien vers la page d'acceuil -->
				<li class="nav-item"><a href="index.php">Accueil</a></li>
			</ul>
		</nav>
        <div id="container">
            <form action="change_mdp.php" method="POST"> 
                
                <!-- titre -->
                <h1>Changer son mot de passe</h1>
                    
                <!-- champ pour ecrire son mot de passe actuel -->
                <label>Votre mot de passe actuel</label>
                <input type="password" placeholder="Entrez votre mot de passe actuel" name="current_mdp" required>
                
                <!-- champ pour ecrire son nouveau mot de passe -->
                <label>Votre nouveau mot de passe</label>
                <input type="password" placeholder="Entrez votre nouveau mot de passe" name="new_mdp1" required>
                
                <!-- champ pour ecrire son nouveau mot de passe -->
                <label>Votre nouveau mot de passe</label>
                <input type="password" placeholder="Entrez votre nouveau mot de passe" name="new_mdp2" required>

                <!-- bouton de validation -->
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


//--------------CHANGEMENT DE MOT DE PASSE--------------//

// Si les variables sont déclarées et diférentes de null
if(isset($_POST['current_mdp']) && isset($_POST['new_mdp1']) && isset($_POST['new_mdp2'])){


    // Raisonnement: 
    // - On récupère le mot de passe actuel de l'utilisateur, puis on vérifie qu'il est correct. (1)
    // - Ensuite on vérifie si le nouveau mot de passe qu'il a écrit deux fois est le même. (2)
    // - On chiffre le mot de passe, puis on modifie la base de donnée. (3)


    // ---- On récupère le mot de passe actuel (1) ----//
    
    // requête SQL qui récupère le mot de passe
    $res = $conn -> query
    ("SELECT mdp_utilisateur 
    FROM utilisateur
    WHERE nom_utilisateur = '".$_SESSION['username']."';");
    // on parcours le résultat
    $item = $res -> fetch();

    
    //---- On verifie le nouveau mot de passe (2) ----//

    // la fonction strcmp compare 2 chaines de caractères.
    // Elle renvoie 0 si les 2 chaînes sont égales
    if(strcmp($_POST['new_mdp1'],$_POST['new_mdp2']) == 0){
        
        // On peut donc maitenant chiffrer le nouveau mot de passe et modifier la bdd (3)

        // on crée la variable $pass_hash qui stock le password chiffré
		$pass_hash = password_hash($_POST['new_mdp1'],PASSWORD_DEFAULT); 

        // On remplace l'ancien mot de passe dans la base de donnée par le nouveau
        $final = $conn -> query
        ("UPDATE utilisateur
        SET mdp_utilisateur = '".$pass_hash."' 
        WHERE mdp_utilisateur = '".$item['mdp_utilisateur']."';");


        // la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
		// elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
		// mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
		$res -> closeCursor();
        	$final -> closeCursor();
		
		// on ferme la connexion à la base de donnée
		$conn = null;

        // On renvoie l
        header("Location:index.php");
        exit();

    }

// Si les nouveaux mot de passes ne correspondent pas entre eux
    else { // alors on renvoie un message d'erreur
        echo "<h2>Nouveau mot de passe incorrect !</h2>";
    }

}

?>
