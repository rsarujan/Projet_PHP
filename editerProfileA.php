<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');

if(isset($_SESSION['id_etudiant']))
{
	$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE id_etudiant=? ");
	$requser->execute(array($_SESSION['id_etudiant']));
	$user = $requser->fetch();


	if(isset($_POST['nouveauAdresse']) and !empty($_POST['nouveauAdresse']) and $_POST['nouveauAdresse'] != $user['nouveauAdresse'])
	{
		$nouveauAdresse = htmlspecialchars($_POST['nouveauAdresse']);
		$insertAdresse = $bdd->prepare("UPDATE Utilisateur SET adresse = ? WHERE id_etudiant = ?");
		$insertAdresse->execute(array($nouveauAdresse,$_SESSION['id_etudiant']));
		header('Location: Connexion.php');
	}

	if(isset($_POST['nouveauNumTel']) and !empty($_POST['nouveauNumTel']) and $_POST['nouveauNumTel'] != $user['nouveauNumTel'])
	{
		$nouveauNumTel = htmlspecialchars($_POST['nouveauNumTel']);
		$insertnumTel = $bdd->prepare("UPDATE Utilisateur SET num_tel = ? WHERE id_etudiant = ?");
		$insertnumTel->execute(array($nouveauNumTel,$_SESSION['id_etudiant']));
		header('Location: Connexion.php');
	}

	if(isset($_POST['nouveaumail']) and !empty($_POST['nouveaumail']) and $_POST['nouveaumail'] != $user['nouveaumail'])
	{
		$nouveaumail = htmlspecialchars($_POST['nouveaumail']);
		$insertmail = $bdd->prepare("UPDATE Utilisateur SET mail = ? WHERE id_etudiant = ?");
		$insertmail->execute(array($nouveaumail,$_SESSION['id_etudiant']));
		header('Location: Connexion.php');
	}

	if(isset($_POST['nouveauMdp1']) and !empty($_POST['nouveauMdp1']) and isset($_POST['nouveauMdp2']) and !empty($_POST['nouveauMdp2']))
	{
		$mdp1 = sha1($_POST['nouveauMdp1']);
		$mdp2 = sha1($_POST['nouveauMdp2']);

		if ($mdp1 == $mdp2)
		{
			$insertMdp = $bdd->prepare("UPDATE Utilisateur SET mdp = ? WHERE id_etudiant = ?");
			$insertMdp->execute(array($mdp1,$_SESSION['id_etudiant']));
			header('Location: Connexion.php');
		}
		else
			$msg = "Vos deux mot de passes ne correspondent pas !";
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
		<h1>Édition de mon profil</h1>
		<form method="POST" action="">
			<table>
				<tr>
					<td>
						Nom:
					</td>
					<td>
						<input type="text" readonly value="<?php echo $user['Nom'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Prénom:
					</td>
					<td>
						<input type="text" readonly value="<?php echo $user['Prenom'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Carte d'ID:
					</td>
					<td>
						<input type="number" readonly value="<?php echo $user['carte_id'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Date de Naissance:
					</td>
					<td>
						<input type="date" readonly value="<?php echo $user['date_naiss'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Adresse:
					</td>
					<td>
						<input type="text" name="nouveauAdresse" placeholder="Adresse" value="<?php echo $user['adresse'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Numéro de Téléphone:
					</td>
					<td>
						<input type="number" name="nouveauNumTel" placeholder="Numéro de Téléphone" value="<?php echo $user['num_tel'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Mail:
					</td>
					<td>
						<input type="email" name="nouveaumail" placeholder="Mail" value="<?php echo $user['mail'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Mot de passe:
					</td>
					<td>
						<input type="password" name="nouveauMdp1" placeholder="Mot de passe">
					</td>
				</tr>
				<tr>
					<td>
						Confirmation du mot de passe:
					</td>
					<td>
						<input type="password" name="nouveauMdp2" placeholder="Confirmez mot de passe">
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						<input type="submit" value="Mettre à jour mon profil !">
					</td>
				</tr>
			</table>
		</form>
	</main>
	<nav>
		<ul>
			<li><a href = "editerProfileA.php">Editer mon profil</a></li><br>
			<li><a href = "formationsA.php">Afficher les formations</a></li><br>
			<li><a href = "AddFormation.php">Ajouter une formation</a></li><br>
			<li><a href = "Enseignants.php">Liste des enseignants</a></li><br>
			<li><a href = "AddEnseignant.php">Ajouter un enseignant</a></li><br>
			<li><a href ="CommentaireL_A.php">Commentaire laissé</a></li><br>
			<li><a href = "Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>

<?php
}
else
	header("Location: Connexion.php");
?>