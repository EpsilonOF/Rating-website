
<?php

//-----------------------CONNEXION A LA BASE DE DONNEE---------------------------//	
		
		// connexion à la base de donnée
		$db_username = 'root'; 
		$db_password = '';
		$db_name = 'rproject';
		$db_host ='localhost';
		$conn = new mysqli($db_host, $db_username, $db_password, $db_name); // on se connecte à la base de donnée
		

		//On vérifie la connexion
		if($conn->connect_error){
			echo "Échec lors de la connexion à MySQL :( " . $conn->connect_error . ") " . $conn->connect_error;
		}
		/* on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
		   pour éliminer toute attaque de type injection SQL et XSS */
		$username = mysqli_real_escape_string($conn, htmlspecialchars($db_username));
		$password = mysqli_real_escape_string($conn, htmlspecialchars($db_password));

?>