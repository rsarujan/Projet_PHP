<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');

if(isset($_GET['id_etudiant']) and $_GET['id_etudiant'] > 0)
{
	$getid = intval($_GET['id_etudiant']);
	$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE id_etudiant = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

if(isset($_POST['formAddFormation']))
{
	$formation = htmlspecialchars($_POST['Intitule_formation']);

	if(!empty($_POST['Intitule_formation']))
	{
		$reqFormation = $bdd->prepare("SELECT * FROM Formation WHERE Intitule_formation = ?");
		$reqFormation->execute(array($formation));
		$formationExist = $reqFormation->rowCount();
		if($formationExist == 0)
		{
			$insertion = $bdd->prepare("INSERT INTO Formation(Intitule_formation) VALUES (?)");
			$insertion->execute(array($formation));
			$erreur = "Le formation a été inséré!";
			header("Location: formationsA.php");
		}
		else
			$erreur="Il y a déjà une formation sous ce nom";
	}
	else
		$erreur="Veuillez compléter la case";
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
	<h1> Ajouter une formations </h1>
	<table>
		<br><br><br>
		<form method="POST" action="">
			<table>
				<tr>
					<td align="right">
						Nom de la formation :
					</td>
					<td>
						<input type="text" id="Intitule_formation" name="Intitule_formation" placeholder="Écrire votre message" value="<?php if(isset($formation)) {echo $formation;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
					</td>
					<td align="center">
						<br>
						<input type="submit" name="formAddFormation"value="Insérer">
					</td>
				</tr>
			</table>
		</form>
		</table>
</main>
	<nav>
		<ul>
			<li><a href = "editerProfileA.php">Editer mon profil</a></li><br>
			<li><a href = "formationsA.php">Afficher les formations</a></li><br>
			<li><a href = "AddFormation.php">Ajouter une formation</a></li><br>
			<li><a href = "Enseignants.php">Liste des enseignants</a></li><br>
			<li><a href = "AddEnseignant.php">Ajouter un enseignant</a></li><br>
			<li><a href ="CommentaireL_A.php">Commentaire laissé</a></li><br>
			<li><a href = "Deindex.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>