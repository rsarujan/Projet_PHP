Sarujan RAJARATNAM - L3 MIAGE APP

Projet_Php:

Lien git: https://github.com/rsarujan/Projet_PHP


Sujet:
Le but de ce projet est de mettre en place une application Web permettant de gérer la candidature des étudiants souhaitant s’inscrire dans notre formation Miage en licence ou en Master1 ou en Master2.


Comment utiliser l'application Web:
1 - Télécharger le projet sur GitHub ou sur cours en ligne.
2 - Mettre dans le serveur local
3 - Récupérer le fichier "code.sql" qui contient toute la base de données du projet
4 - Insérer le script dans phpmyadmin
5 - Ouvrir le fichier "db.php"
6 - Modifier la ligne 2 avec les données de votre base de données.
7 - Aller dans le serveur local sur le navigateur (Chrome de préférence) et cliquer que le répertoire de ce projet, ce qui vous ramènera sur la page index.php automatiquement. Si ce n'est pas le cas, cliquez sur index.php dans le navigateur.
Le fichier index.php est la page principale mais aussi la page de connexion.


Scénarios:
	Admin:
		- id : admin@parisnanterre.fr		mdp : admin
	Prof:
		- id : prof@parisnanterre.fr		mdp: prof
	Etudiants:
		- id : 39010018@parisnanterre.fr	mdp: azerty
		- id : test@test.fr			mdp: azerty
		- id : etu2@parisnanterre.fr		mdp: azerty
		- id : az@a.fr				mdp: azerty

Si aucun de ces scénarios ne marche, cela est dû à l'encodage (sha1) du mot de passe.
Pour cela je vous invite à supprimer tous les utilisateurs de la base de données et re faire l'inscription.

Pour l'administrateur, on n'a pas le choix il faut faire l'inscription comme pour tout le monde et une fois l'inscription faite, il faut aller sur phpmyadmin et changer le TypeUser de l'admin marqué 3 par un 1, car cela permettra de gérer son espace administrateur.
Pour l'enseignant, il faut passer par l'administrateur pour créer un compte enseignant.


Si avec cette manipulation ne marche pas, il faudrait que vous remplaciez sha1 par htmlspecialchars et vous refaites les manipulations mentionnées en haut.