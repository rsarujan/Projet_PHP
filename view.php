<?php
$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');
if(isset($_GET['id_etudiant']) and $_GET['id_etudiant'] > 0)
{
	$getid = intval($_GET['id_etudiant']);
	$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE id_etudiant = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}

if(isset($_GET['id_file']) and $_GET['id_file'] > 0)
{
	$id = intval($_GET['id_file']);
	$stat = $bdd->prepare("SELECT * FROM DocumentsFourni WHERE id_file = ?");
	$stat->execute(array($id));
	$row = $stat->fetch();
	header('Content-Type:'.$row['mime']);
	echo $row['data'];
}

?>
