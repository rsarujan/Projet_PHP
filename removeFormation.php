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
if(isset($_GET['id_formation']) and $_GET['id_formation'] > 0)
{
	$getFormation = intval($_GET['id_formation']);
	$reqFormation = $bdd->prepare("SELECT * FROM Formation WHERE id_formation = ?");
	$reqFormation->execute(array($getFormation));
	$formationInfo = $reqFormation->fetch();
}

?>

<!DOCTYPE html>
<html>
<body>
	<?php
	echo $userinfo['id_etudiant'], $formationInfo['id_commentaire'];

	$requete = $bdd->prepare("DELETE FROM Formation WHERE id_formation=?");
	$requete->execute(array($formationInfo['id_formation']));
	header("Location: formationsA.php");
	?>
</body>
</html>