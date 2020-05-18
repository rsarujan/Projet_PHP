<?php
session_start();

include_once '../db.php';

if(isset($_SESSION['id_etudiant']))
{
	$requser = $bdd->prepare("SELECT DISTINCT Nom,Prenom,Intitule_formation, s.libelle FROM Utilisateur u, Formation f, Statuts s WHERE u.choixFormation=f.id_formation and u.id_statuts=s.id_statuts and id_etudiant=? ");
	$requser->execute(array($_GET['id_etudiant']));
	$user = $requser->fetch();

	if(isset($_POST['nouveauStat']) and !empty($_POST['nouveauStat']) and $_POST['nouveauStat'] != $user['nouveauStat'])
	{
		$nouveauStat = htmlspecialchars($_POST['nouveauStat']);
		$insertStatut = $bdd->prepare("UPDATE Utilisateur SET id_statuts = ? WHERE id_etudiant = ?");
		$insertStatut->execute(array($nouveauStat,$_GET['id_etudiant']));
		header('Location: Etudiants.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="../Content/css/nobel.css" />

</head>
<body>
	<main>
		<h1>Mise à jour du statuts étudiant</h1>
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
						Formation postulé:
					</td>
					<td>
						<input type="text" readonly value="<?php echo $user['Intitule_formation'];?>">
					</td>
				</tr>
				<tr>
					<td>
						Statuts:
					</td>
					<td>
						<!--change le statut de la candidature de l'étudiant-->
						<select name="nouveauStat">
						    <option style="width:100px" value="1">Reçu</option>
						    <option value="2">Reçu, incomplet en attente de complément</option>
						    <option value="3">Validé / complet</option>
						    <option value="4">Entretien</option>
						    <option value="5">Accepté</option>
						    <option value="6">Refusé</option>
						    <option value="7">Liste d’attente</option>
						</select>
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
			<li><a href = "editerProfile.php">Editer mon profil</a></li><br>
			<li><a href = "formations.php">Afficher les formations</a></li><br>
			<li><a href ="Commentaire.php">Laisser un commentaire</a></li><br>
			<li><a href = "../Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>

<?php
}
else
	header("Location: index.php");
?>