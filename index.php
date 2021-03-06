<?php
session_start();


include_once 'db.php'; 

if(isset($_POST['formconnexion']))
{
	$mailconnect = htmlspecialchars($_POST['mailconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);

	if(!empty($mailconnect) and !empty($mdpconnect)) //vérifie si le mail et le mdp n'est pas vide
	{
		$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE mail=? AND mdp=? ");	//vérifie s'il existe dans la base de données
		$requser->execute(array($mailconnect,$mdpconnect));
		$UserExists = $requser->rowCount();

		if($UserExists ==1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id_etudiant'] = $userinfo['id_etudiant'];
			$_SESSION['Nom'] = $userinfo['Nom'];
			$_SESSION['Prenom'] = $userinfo['Prenom'];
			$_SESSION['carte_id'] = $userinfo['carte_id'];
			$_SESSION['date_naiss'] = $userinfo['date_naiss'];
			$_SESSION['adresse'] = $userinfo['adresse'];
			$_SESSION['num_tel'] = $userinfo['num_tel'];
			$_SESSION['mail'] = $userinfo['mail'];
			if ($userinfo['TypeUser'] == 1)		// il vérifie s'il s'agit de l'admin
			{
				header("Location: Admin/profileA.php?id_etudiant=".$_SESSION['id_etudiant']);
			}
			else if ($userinfo['TypeUser'] == 2)// il vérifie s'il s'agit d'un professeur
			{
				header("Location: Prof/profileP.php?id_etudiant=".$_SESSION['id_etudiant']);
			}
			else 		//sinon étudiant
				header("Location: Etudiant/profile.php?id_etudiant=".$_SESSION['id_etudiant']);
		}
		else
			$erreur = "Mauvais mail ou mot de passe érroné";
	}
	else
		$erreur = "Tous les champs doivent être remplis !";
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="Content/css/nobel.css" />

</head>
<body>
<main>
	<div align="center">
		<h1>Connexion</h1>
		<br><br><br>
		<form method="POST" action="">
			<input type="email" name="mailconnect" placeholder="Mail">
			<input type="password" name="mdpconnect" placeholder="Mot de passe">
			<input type="submit" name="formconnexion" value="Se connecter !"><br>
			Pas encore inscrit?... <a href = "inscription.php">S'inscrire !</a>
		</form>
		<?php 
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur.'</font>'; //permet d'afficher les erreurs en rouge
			}
		?>
	</div>
</main>
</body>
</html>