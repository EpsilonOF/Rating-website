
<?php 
    //-----------------------------CONNEXION A LA BASE DE DONNEE---------------------------//	
		
		// identifiants pour se connecter à la base
		$db_username = 'root'; 
		$db_password = '';
		$db_name = 'rproject';
		$db_host ='localhost';

		
		// utilisation du try and catch
		
    		try{ //----Connexion à la base-----------//
			$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password); // on se connecte à la base de donnée
			$conn -> exec("SET CHARACTER SET utf8"); // Codage en UTF8
			$conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);			
			//echo("Connection OK");
		}

		//---------- Si il y a un problème de connexion à la base-----//
		// Alors on renvoie un message d'erreur
		catch(PDOException $error)
		{
			echo ("Erreur : ".$error->getMessage());
		}

?>