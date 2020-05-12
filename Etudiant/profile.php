<?php
session_start();

include_once '../db.php';

if(isset($_GET['id_etudiant']) and $_GET['id_etudiant'] > 0)
{
	$getid = intval($_GET['id_etudiant']);
	$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE id_etudiant = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();

?>



<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="../Content/css/nobel.css" />

</head>
<body>
	<main>
		<div align="center"><h1>Profil de <?php echo $userinfo['Nom']." ".$userinfo['Prenom'];?></h1>
		<br><br><br>
		Nom = <?php echo $userinfo['Nom'];?><br>
		Prenom = <?php echo $userinfo['Prenom'];?>
		<br><br>
		Carte ID = <?php echo $userinfo['carte_id'];?><br>
		Date de naissance = <?php echo $userinfo['date_naiss'];?><br>
		Adresse = <?php echo $userinfo['adresse'];?><br>
		Numéro de téléphone = <?php echo $userinfo['num_tel'];?>
		<br><br>
		Mail = <?php echo $userinfo['mail'];?><br><br><br></div>
	</main>
		<nav>
			<ul>
			<?php

			if(isset($_SESSION['id_etudiant']) and $userinfo['id_etudiant'] == $_SESSION['id_etudiant'])
			{
				?>
				<li><a href = "editerProfile.php">Editer mon profil</a></li><br>
				<li><a href = "formations.php">Afficher les formations</a></li><br>
				<li><a href = "SuiviFormations.php">Suivre candidature</a></li><br>
				<li><a href ="Commentaire.php">Laisser un commentaire</a></li><br>
				<li><a href = "../Deconnexion.php">Se déconnecter</a></li><br>
				<?php 
			}
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur.'</font>';
			}
		?></ul></nav>
</body>
</html>

<?php
}

?>