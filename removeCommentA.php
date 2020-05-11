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
if(isset($_GET['id_commentaire']) and $_GET['id_commentaire'] > 0)
{
	$getCommentaire = intval($_GET['id_commentaire']);
	$reqComm = $bdd->prepare("SELECT * FROM Commentaire WHERE id_commentaire = ?");
	$reqComm->execute(array($getCommentaire));
	$commInfo = $reqComm->fetch();
	//print_r($commInfo);
}

//echo $d['id_document'];
?>

<!DOCTYPE html>
<html>
<body>
	<?php
	echo $userinfo['id_etudiant'], $commInfo['id_commentaire'];

	$requete = $bdd->prepare("DELETE FROM Commentaire WHERE id_etudiant=? and id_commentaire=?");
	$requete->execute(array($userinfo['id_etudiant'], $commInfo['id_commentaire']));
	//print_r($requete);
	header("Location: CommentaireL_A.php");
	?>
</body>
</html>