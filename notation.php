<?php

//--------------------UTILISATION DE LA PDO--------------------//

    // la fonction session_start() démarre une nouvelle session ou reprend une session existante
    session_start(); // ici on reprends la session existante
?>

<html>
    <head>
	    <title>Notation</title>
       <meta charset="utf-8">
	   <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/notation.css" media="screen" type="text/css" />
		<link rel="icon" type="image/x-icon" href="images/icone.png">
    </head>
    <body>
        <nav>
            <ul class="nav-list">
                <li class="nav-item"><a href="index.php"><img src="images/logo.png"></a></li>
                <li class="nav-item"><a href="index.php">Accueil</a></li>
                <li class="nav-item"><a href="profil.php">Votre profil</a></li>
            </ul>
        </nav>

        <div id="container">
            <form action="notation.php" method="POST">
                
                <h1>Notez votre restaurant !</h1>
                    
                <label>Nom du restaurant</label>
                <input type="text" placeholder="Entrez le nom du restaurant" name="restaurant" required>
                
                <label>Nom de la ville</label>
                <input type="text" placeholder="Entrez le nom de la ville" name="ville" required>
		    
		<!-- selection de la note -->
                <label for="note">Choisissez une note :</label>
                    <select name="note" id="note">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                
		 <!-- boutton de validation -->
                <input type="submit" id='submit' value='Valider'>

            </form>
        </div>
    </body>

</html>



<?php

// Si $_SESSION['ConnOK'] est déclarée et non nulle mais false alors
if(!isset($_SESSION['ConnOK'])){
	header("Location:connexion.php"); // on renvoie l'utilisateur à l'accueil
	exit();
}
	
    // si les variables (i.e ce qu'a écrit l'utilisateur) sont non-nulle et déclarées
    if(isset($_POST['restaurant']) && isset($_POST['ville'])){

        // Connexion à la base de donnée
        require 'connexion_bdd_pdo.php';



        // Première étape : on vérifie si le restaurant existe
        $res0 = $conn -> query(
        "SELECT id_restaurant,nom_restaurant, nom_ville
        FROM restaurant, ville 
        WHERE restaurant.id_ville = ville.id_ville
        AND (nom_restaurant LIKE '".$_POST['restaurant']."'
        AND ville.nom_ville LIKE '".$_POST['ville']."');"); 

        // on compte le nombre de résultats de la requête.
        $nbr0 = $res0 -> rowCount();
        $item0 = $res0 -> fetch();

	// si la requête $res0 admet un ou des résultats   
        if($nbr0 != 0) {


            // On récupère l'id de l'utilisateur: 
            $res1 = $conn -> query
            ("SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur LIKE '".$_SESSION['username']."';");

            $item1 = $res1 -> fetch();
            
            // si il y a un résultat alors on peut modifier la table notation.
            $final = $conn -> query
            ("INSERT INTO notation(id_note,id_restaurant,id_utilisateur) 
            VALUES ('".$_POST['note']."',$item0[id_restaurant],$item1[id_utilisateur]);");


            // la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
			// elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
			// mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
			$res0 -> closeCursor();
            $res1 -> closeCursor();
            $final -> closeCursor();


            // On renvoie l'utilisateur à l'accueil
            header("Location:index.php");
            exit();

        }
        // Si le restaurant n'existe pas
        else {
            // alors on renvoie un message d'erreur
            echo "<h2>Ce restaurant n'existe pas, veuillez d'abord l'ajouter ! </h2>";
            
        }
    }
?>
