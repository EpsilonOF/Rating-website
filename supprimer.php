<?php 
    // la fonction session_start() démarre une nouvelle session ou reprend une session existante
    session_start();// ici on reprends la session existante

    // Connexion à la base de donnée
    require 'connexion_bdd_pdo.php';
?>

<html>
    <head>
	    <title>Supprimer un utilisateur</title>
       <meta charset="utf-8">
	   <!-- importer le fichier de style -->
        <link rel="stylesheet" href="styles/ajout.css" media="screen" type="text/css" />
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
            <form action="supprimer.php" method="POST">
                
                <h1>Supprimer un utilisateur</h1>
                
                <!-- champ pour rentrer le  nom d'utilisateur qu'il souhaite supprimer -->
                <label><b>Nom d'utilisateur a supprimer</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <!-- champ pour rentrer son mot de passe -->
                <label><b>Mot de passe de confirmation</b></label>
                <input type="password" placeholder="Entrer votre mot de passe" name="password" required>
                
				<input type="submit" id='submit' value='Supprimer'>
                
            </form>
        </div>
    </body>
</html>


<?php

if(!isset($_SESSION['ConnOK'])){
	header("Location:connexion.php");
	exit();
}
if(isset($_POST['username']) && isset($_POST['password'])){
    
    // On vérifie le mot de passe de l'admin
    if(password_verify($_POST['password'],$_SESSION['mdp'])){

        // L'administrateur doit entrer le nom d'utilisateur qu'il souahite supprimer
        // Donc on doit récupérer l'id de l'utilisateur correspondant à ce pseudo. (1)
        // Puis on supprime dans la table utilisateur et notation les lignes correspondantes


        // recupère l'id de l'utilisateur (1)
        $res = $conn -> query
        ("SELECT id_utilisateur 
        FROM utilisateur 
        WHERE nom_utilisateur = '".$_POST['username']."';");

        $item = $res -> fetch();


        // On supprime dans la table notation et utilisateur les lignes correspndantes
        // à l'id_utilisateur.

        $final1 = $conn -> query
        ("DELETE FROM notation 
        WHERE id_utilisateur = $item[id_utilisateur];");

        $final2 = $conn -> query
        ("DELETE FROM utilisateur
        WHERE id_utilisateur = $item[id_utilisateur];");



        // la fonction closeCursor() retourne true en cas de succès ou false si une erreur survient
        // elle libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, 
        // mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.
        $res -> closeCursor();
        $final1 -> closeCursor();
        $final2 -> closeCursor();

        // on ferme la connexion à la base de donnée
        $conn = null;

        // On renvoie l'utilisateur à l'accueil
        header("Location:profil.php");
        exit();
    }
}

?>
