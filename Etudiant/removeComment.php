<?php
session_start();
include_once '../db.php';
if(isset($_GET['id_etudiant']) and $_GET['id_etudiant'] > 0)
{
	$getid = intval($_GET['id_etudiant']);
	$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE id_etudiant = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}
if(isset($_GET['id_commentaire']) and $_GET['id_commentaire'] > 0)
{
	$getCommentaire = intval($_GET['id_commentaire']);
	$reqComm = $bdd->prepare("SELECT * FROM Commentaire WHERE id_commentaire = ?");
	$reqComm->execute(array($getCommentaire));
	$commInfo = $reqComm->fetch();
}

?>

<!DOCTYPE html>
<html>
<body>
	<?php
	echo $userinfo['id_etudiant'], $commInfo['id_commentaire'];
	//supprimer un commentaire laissé
	$requete = $bdd->prepare("DELETE FROM Commentaire WHERE id_etudiant=? and id_commentaire=?");
	$requete->execute(array($userinfo['id_etudiant'], $commInfo['id_commentaire']));
	header("Location: Commentaire.php");
	?>
</body>
</html>