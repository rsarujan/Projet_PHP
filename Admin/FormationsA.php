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
?>




<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="../Content/css/nobel.css" />
</head>
<body>
<main>
<table>
	<h1> Liste des formations </h1>
	<tr>
		<td>
			<STRONG>Nom de la formation</STRONG>
		</td>
		<td>
			<STRONG></STRONG>
		</td>
	</tr>
	<tr>
		<?php
		echo "<br><br>";
		//afficher et ou supprimer une formation
			$formation=$bdd->prepare('SELECT * from formation');
			$formation->execute();
			while($lig = $formation->fetch()){
				echo "<tr>";
					echo "<td>".$lig['intitule_formation']."</td>";
					echo "<td><a href='removeFormation.php?id_formation=".$lig['id_formation']."'><img src='../Content/img/remove-icon.png' alt='' class='icone'/></a></td>";
				echo "</tr>";
			}
			?>
	</tr>
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
			<li><a href = "../Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>			
</body>
</html>