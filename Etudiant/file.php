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
if(isset($_GET['id_document']) and $_GET['id_document'] > 0)
{
	$id_etudiant = intval($_GET['id_document']);
	$redDoc = $bdd->prepare("SELECT * FROM Documents WHERE id_document = ?");
	$redDoc->execute(array($id_etudiant));
	$document = $redDoc->fetch();
}

if(isset($_GET['id_formation']) and $_GET['id_formation'] > 0)
{
	$getFormationid = intval($_GET['id_formation']);
	$reqFormation = $bdd->prepare("SELECT * FROM Formation WHERE id_formation = ?");
	$reqFormation->execute(array($getFormationid));
	$formInfo = $reqFormation->fetch();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dépôt de fichier</title>
</head>
<body>
	<?php
	if(isset($_POST['btn']))
	{
		$name = $_FILES['myfile']['name'];
		$type=$_FILES['myfile']['type'];
		$data=file_get_contents($_FILES['myfile']['tmp_name']);
		echo $document['id_document'],$_SESSION['id_etudiant'],$formInfo['id_formation'];
		$stnt=$bdd->prepare('INSERT INTO DocumentsFourni(name,mime,data, id_documents, id_etu) VALUES(?,?,?,?,?)');
		$stnt->execute(array($name,$type,$data,$document['id_document'],$_SESSION['id_etudiant']));


		$utilisateurUpdate=$bdd->prepare('UPDATE Utilisateur SET choixFormation=?, id_statuts = ? WHERE id_etudiant = ?');
		$utilisateurUpdate->execute(array($formInfo['id_formation'],1, $_SESSION['id_etudiant']));
		header("Location: addFiles.php?id_formation=".$formInfo['id_formation']);
	}
	?>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="myfile">
		<button name="btn">Upload</button>
	</form>
</body>
</html>