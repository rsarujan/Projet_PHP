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
if(isset($_GET['id_formation']) and $_GET['id_formation'] > 0)
{
	$getFormationid = intval($_GET['id_formation']);
	$reqFormation = $bdd->prepare("SELECT * FROM Formation WHERE id_formation = ?");
	$reqFormation->execute(array($getFormationid));
	$formInfo = $reqFormation->fetch();
}
if(isset($_GET['id_document']) and $_GET['id_document'] > 0)
{
	$id_document = intval($_GET['id_document']);
	$redDoc = $bdd->prepare("SELECT * FROM DocumentsFourni WHERE id_documents = ?");
	$redDoc->execute(array($id_document));
	$document = $redDoc->fetch();

}
?>

<!DOCTYPE html>
<html>
<body>
	<?php
	echo $userinfo['id_etudiant'], $formInfo['id_formation'], $document['id_documents'];
	//supprimer un fichier déposé
	$requete = $bdd->prepare("DELETE FROM DocumentsFourni WHERE id_etu=? and id_documents=?");
	$requete->execute(array($userinfo['id_etudiant'], $document['id_documents']));
	header("Location: addFiles.php?id_formation=".$formInfo['id_formation']);
	?>
</body>
</html>