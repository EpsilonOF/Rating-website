# Projet IO2: Réalisation d’un site de notation

### Année 2021-2022

## 1 Organisation

__Equipes__ : ́ Vous devez r ́ealiser ce projet par binˆomes.Aucune ́equipe de
plus de deux personnes ne sera acceptée. Vous pouvez faire le projet
avec un·e ́etudiant·e d’un autre groupe. Les monˆomes sont interdits sauf
exceptions et ils ne seront autoris ́es qu’au cas par cas par les enseignants.

__Inscription__ : L’inscription s’effectuera sur Moodle. Les membres d’une
mˆeme ́equipe doivent s’inscrire dans le mˆeme binˆome (identifi ́e par un num ́ero)
sur Moodle. Les num ́eros n’ont aucune signification, l’ordre de passage des
groupes sera fix ́e plus tard.

__Rendu__ : Vous devrez rendre votre travail dans une archive sur Moodle.
Si vous travaillez sur vos propres machines, pensez à tester votre site
web au Script pour le cas où vous auriez un probl`eme avec votre ordinateur.

__Soutenances__ : L’objectif de ce projet est de r ́ealiser un site complet et
d’ˆetre capable de pr ́esenter votre travail lors d’une soutenance de 20 à 30
minutes.
Il est important de travailleren groupede manière ́equitable: chacun
des membres du binˆome devra avoir programm ́e une partie significative du
projet. Par exemple, si un·e ́etudiant·e ne code que le HTML et le CSS et
son·sa camarade tout le reste, ce n’est pas ́equitable. Par ailleurs, chacun
des membres du binˆome doit pouvoir r ́epondre `a des questions sur chaque
partie du projet.

## 2 Travail demandé

L’objectif de ce projet est de d ́evelopper un prototype de site de notation.
Ce peut ˆetre, par exemple, un site qui recueille des avis et des notes sur
des restaurants, des films, des voitures,.... Vous ˆetes libres de choisir la
th ́ematique et le contenu du site; soyez cr ́eatifs!
Certaines fonctionnalit ́es sont impos ́ees (dans la suite, on prend l’exemple
des restaurants).

1. Page d’accueil: La page d’accueil devra permettre de choisir de s’inscrire,
    de se connecter avec un compte d ́ej`a cr ́e ́e ou de faire des recherches.
    Ces fonctionnalit ́es pourront ˆetre effectu ́ees via des redirections vers
    d’autres pages.
2. Page d’inscription: Une page avec formulaire pour cr ́eer un nouveau
    compte. L’utilisateur pourra au minimum choisir un pseudo et un mot
    de passe (qui sera stock ́e de mani`erechiffr ́ee).
3. Page profile: Chaque utilisateur connect ́e aura une page associ ́ee `a son
    compte qui montrera les derniers avis ou notes qu’il a donn ́es.
4. Fonction de recherche: il sera possible de faire des recherches selon
    plusieurs crit`eres: par exemple, le nom du restaurant et/ou la ville
    et/ou la note minimale.
    On pourra au choix consid ́erer que tous les avis sont visibles par tous,
    ou que seuls les restaurants sont visibles par les utilisateurs non con-
    nect ́es mais pas les avis ou encore que seule une s ́election est visible
    aux utilisateurs non connect ́es. (voir extension)
5. Comptes administrateurs: Certains comptes pourront ˆetre d ́esign ́es
    comme administrateurs. Ces administrateurs pourront effacer les avis
    ou notes de tous les autres utilisateurs, ou supprimer des utilisateurs.
6. Publier des avis: Les utilisateurs inscrits et connect ́es pourront donner
    des avis et/ou des notes. Par exemple, une fois qu’il a s ́electionn ́e un
    restaurant, il pourra dire ce qu’il en pense.


Dans la configuration minimale (avant extension),
- il est possible pour un utilisateur de s’inscrire et, s’il a un compte, de
    se connecter.
- la base est pr ́eremplie avec un certain nombre de restaurants, il n’y a
    pas de formulaire pr ́evu pour en ajouter un.
- Il faut qu’il soit possible de mettre soit des avis soit des notes, mais
    pas forc ́ement les deux.
- Pour la fonction de recherche, il doit y avoir au moins deux critères
    possibles combinables entre eux. (Par exemple, chercher les restaurants à Lyon qui ont eu une note sup ́erieures `a 4)


- Les avis sont tous visibles par tous les utilisateurs.
- il y a un compte administrateur qui peut supprimer des comptes ou
    des avis.

__Extensions__: Le nombre d’extensions doit ˆetre ́egal au nombre de membres
du groupe (donc normalement 2).

1. avis publics et privés : Faire en sorte que certains avis ou notes soient
    visibles par les utilisateurs non connect ́es, mais pas tous. Le crit`ere
    peut ˆetre la date de l’avis; on peut aussi ne montrer que le dernier avis
    sur un restaurant, film, ...
2. Ajouts de restaurants : Permettre l’ajout de restaurant, soit par les
    utilisateurs connect ́es, soit uniquement par les administrateurs.
3. Likes, r ́eactions ou commentaires: Ajouter un bouton (le même) à
    chaque note, qui permet `a un utilisateur connect ́e de donner automa-
    tiquement la mˆeme note pour ce restaurant.
4. Signalement de contenu à un administrateur: Ajouter un bouton à
    chaque avis permettant de le signaler à un compte administrateur.
    Les comptes administrateurs pourront consulter une liste des avis
    signal ́es dans une nouvelle page. Pour chaque avis signal ́e, on indi-
    quera l’utilisateur qui l’a donn ́e et le choix d’ignorer le signalement ou
    d’effacer l’avis.
5. Votre imagination...

__Langages__ : Le site devra utiliser les langages vus en cours et TP: HTML,
CSS, PHP et MySQL. L’utilisation de Javascript est autoris ́ee mais pas
requise et uniquement pour de petites portions de code, PHP doit rester
majoritaire. L’utilisation d’un framework CSS (bootstrap, etc.) ou PHP
(Symfony, etc.) n’est pas autoris ́ee.

__Cibles__ Le site devra avant tout ˆetre pens ́e pour ˆetre utilis ́e par des ˆetres
humains. Il devra en particulier ˆetre accessible en navigateur, et le ou la
visiteur·se ne devra jamais avoir à deviner où se trouve ce qu’il ou elle
cherche.

## 3 Evaluation 
L’archive rendue devra contenir:

- Le code int ́egral de votre site;


- Un document d ́ecrivant comment le faire fonctionner, et notamment:
    - Comment pr ́eremplir la base de donn ́ees, cr ́eer les tables, etc. Il
       est recommand ́e de fournir un fichier __.sql__ tout fait pour cela.
- Un document d ́ecrivant le sch ́ema de la base de donn ́ees, il peut ˆetre
    manuscrit, il ne vous est pas demand ́e de faire un sch ́ema UML, donnez
    juste les tables, leurs colonnes et si une colonne d’une table correspond
    `a une colonne d’une autre, indiquez-le. Si vous aviez pr ́evu un sch ́ema
    pour plus d’extensions que r ́ealis ́ees, indiquez les parties qui ne servent
    pas, nous tiendrons compte de cette partie du travail.

L’ ́evaluation portera en particulier sur les crit`eres suivants:

__Modularité du code__ Le code devra ˆetre aussi modulaire que possi-
ble. On s ́eparera les fonctionnalit ́es distinctes dans des fonctions, classes
diff ́erentes ou fichiers diff ́erents.

__Factorisation du code__ On ́evitera la r ́ep ́etition de code en pr ́ef ́erant
cr ́eer une nouvelle fonction, classe ou un nouveau fichier.

__Clarté du code__ Le code devra ˆetre clair et lisible facilement par l’ ́evaluateur·rice.
Il est recommand ́e qu’il soit organis ́e, a ́er ́e, indent ́e. L’utilisation de com-
mentaires explicatifs est extrˆemement recommand ́ee. De plus, il est attendu
que le code soit valide et respecte les standards.

__Securité__ On fera attention aux failles de s ́ecurit ́e et notamment aux in-
jections SQL et au stockage des mots de passe. La session d’un utilisateur
connect ́e doit aussi ˆetre maintenue de mani`ere chiffr ́ee.

__Esthétique du site__ Un site ́el ́egant sera appr ́eci ́e, mais ce n’est pas le
sujet du cours. L’ ́evaluation portera avant tout sur les fonctionnalit ́es. Il
en va de mˆeme pour l’utilisation du Javascript: cela peut apporter un plus,
mais ne sera pas au centre de l’ ́evaluation; vous serez avant tout not ́es sur
la maˆıtrise des quatre langages du programme du cours.

__Compréhension du projet__ Lors de la soutenance, la r ́epartition des
tˆaches entre les membres du binˆome devra ˆetre claire. On attendra de
chacun·e qu’il ou elle soit capable de parler de la partie dont il ou elle
s’est occup ́e et au moins vaguement de la partie laiss ́ee `a l’autre. Les notes
seront attribu ́ees personnellement et non pas aux binˆomes.


__Paternité du code__ La seule personne autoris ́ee à travailler avec vous sur
votre projet est votre binˆome. Vous ˆetes toujours autoris ́e à consulter les
sources publiques telles que la documentation PHP, Stackoverflow, Github.
Cependant, toute recopie de bout de code devra ˆetre pr ́ecis ́e et ne devra
concerner qu’une petite partie du code du projet. De plus, tout code r ́eutilis ́e
doit l’ˆetre l ́egalement et doit porter la mention de sa source.

## 4 Recommandations

__Sur la sauvegarde__ : Pensez à faire des sauvegardes r ́egulières et à
toujours avoir une version qui fonctionne sous la main. Parfois, en voulant
corriger un bug, on casse autre chose et on est très soulagé d’avoir une an-
cienne version qui marche depuis laquelle repartir. Pensez ́egalement à faire
des sauvegardes sur plusieurs supports : sur vos ordinateurs, au SCRIPT,
sur une clé USB, sur un git ou svn... en cas de panne de l’un de ces supports,
vous aurez toujours les autres en remplacement. Les enseignants de ce cours
vous recommandentfortementde stocker votre code sur un serveur git, par
exemple Gaufre, Gitlab ou Github.

__Sur la planification__ : Le projet fait appel à des contenus du cours qui
n’auront pas tous déjà ́eté vus au moment où cet ́enoncé est donné. Vous
ne pourrez donc pas, a priori, travailler sur tous les aspects du projet dès le
début.
Que ceux qui veulent ́etaler leur effort se rassurent : c’est tout à fait
possible.
Tout d’abord, avant même de commencer à coder, vous pouvez com-
mencer par chercher le thème de votre projet, r ́eflˆechir à l’enchaînement des
pages.
Pour vos mises en page HTML et CSS, faites un sch ́ema du r ́esultat
d ́esir ́e et identifiez ses sous-parties avant d’essayer de le coder.
Ensuite, les pages HTML et CSS peuvent ˆetre ́ecrites avant d’y int ́egrer
du PHP, puis la base de donn ́ees. Le projet est aussi une opportunit ́e de
r ́eviser son cours en le mettant en pratique au fur et à mesure que celui-ci
avance.
Pour la partie en lien avec la base de donn ́ees, r ́efl ́echissez aux exten-
sions que vous souhaitez mettre en placeavant de commencer `a coder.
Si vous ne vous y prenez pas en amont, certaines d’entre elles vous deman-
deront d’adapter lourdement votre base de donn ́ees, ce qui vous fera perdre
beaucoup de temps...

__Questions__ : Si vous avez des questions ou des suggestions, parlez-en à votre
chargé(e) de TP. Un forum sera ́egalement mis en place sur Moodle.


