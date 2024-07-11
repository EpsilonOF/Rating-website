CREATE DATABASE rproject;

USE rproject;


CREATE TABLE note
(
    id_note INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    note INT NOT NULL
);

CREATE TABLE ville 
(
    id_ville INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    nom_ville TEXT NOT NULL
);



CREATE TABLE utilisateur
(
    id_utilisateur INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    mdp_utilisateur TEXT NOT NULL,
    nom_utilisateur TEXT NOT NULL,
    profil_utilisateur INT NOT NULL DEFAULT 0 
);



CREATE TABLE restaurant
(
    id_restaurant INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_ville INT NOT NULL,
    nom_restaurant TEXT NOT NULL
);


CREATE TABLE notation
(
    id_notation INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    id_note INT NOT NULL,
    id_restaurant INT NOT NULL,
    id_utilisateur INT NOT NULL
);

INSERT INTO note(note) VALUES (1);
INSERT INTO note(note) VALUES (2);
INSERT INTO note(note) VALUES (3);
INSERT INTO note(note) VALUES (4);
INSERT INTO note(note) VALUES (5);

INSERT INTO utilisateur(mdp_utilisateur,nom_utilisateur,profil_utilisateur) VALUES ("$2y$10$Q4z3MVUnzhILlJAW/BeCS.w.iSUSX5vKA/4Vlk3noIep9rYiDvUSu","Aurelien",1);   
INSERT INTO utilisateur(mdp_utilisateur,nom_utilisateur,profil_utilisateur) VALUES ("$2y$10$.hleSW1OVg/0GWq2nKWTeevaW2xnFG7J9XkiTHrXO9H2JdU6z.g72","Felix",1);  
INSERT INTO utilisateur(mdp_utilisateur,nom_utilisateur,profil_utilisateur) VALUES ("$2y$10$fXkwaDc.72jClpSGAxNqQOicX.Opry8SzH43b194t.DS/JUJVpXR2","Correcteur",1); 


INSERT INTO ville(nom_ville) VALUES ("BOE");
INSERT INTO ville(nom_ville) VALUES ("AGEN");
INSERT INTO ville(nom_ville) VALUES ("BON-ENCONTRE");
INSERT INTO ville(nom_ville) VALUES ("FOULAYRONNES");
INSERT INTO ville(nom_ville) VALUES ("SERIGNAC-SUR-GARONNE");
INSERT INTO ville(nom_ville) VALUES ("ROQUEFORT");
INSERT INTO ville(nom_ville) VALUES ("LAPLUME");
INSERT INTO ville(nom_ville) VALUES ("MOIRAX");
INSERT INTO ville(nom_ville) VALUES ("LE PASSAGE");
INSERT INTO ville(nom_ville) VALUES ("CAUDECOSTE");
INSERT INTO ville(nom_ville) VALUES ("LAYRAC");
INSERT INTO ville(nom_ville) VALUES ("ASTAFFORT");
INSERT INTO ville(nom_ville) VALUES ("BRAX");
INSERT INTO ville(nom_ville) VALUES ("SAINT-HILAIRE-DE-LUSIGNAN");
INSERT INTO ville(nom_ville) VALUES ("ESTILLAC");
INSERT INTO ville(nom_ville) VALUES ("COLAYRAC-SAINT-CIRQ");
INSERT INTO ville(nom_ville) VALUES ("LAFOX");
INSERT INTO ville(nom_ville) VALUES ("SAINT-SIXTE");


INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (11,"Imagine");  
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (14,"Osaka");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (5,"Tea Japon"); 
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (10,"La Cinquieme Saison");  
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (12,"La Marmite Fleurie");   
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (13,"La Caoulet");   
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (10,"Le Colonial Cafe"); 
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (14,"L'imprevu");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (7,"Carre Gourmand");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (8,"La Cucina"); 
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (9,"L'Etable");  
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (15,"Au Bureau");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (6,"Le Prince Noir");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (4,"Le Yaka");   
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (12,"Buffalo Grill");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (9,"La Licorne");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (4,"L'Aromatik");    
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (8,"L'Orangerie");   
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (11,"La Table d'Antan"); 
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (6,"L'arti show");   
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (7,"Escale au Maroc");   
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (8,"La Cigale"); 
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (14,"La Palmeraie"); 
INSERT INTO restaurant(id_ville,nom_restaurant) VALUES (14,"Auberge Le Prieur");    