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
?>




<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="Content/css/nobel.css" />
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
			<STRONG>Candidater</STRONG>
		</td>
	</tr>
	<tr>
		<?php 
			$formation=$bdd->prepare('SELECT * from formation');
			$formation->execute();
			while($lig = $formation->fetch()){
				//echo $lig['id_formation'];
				echo "<tr>";
					echo "<td>".$lig['intitule_formation']."</td>";
					echo "<td><a href='addFiles.php?id_formation=".$lig['id_formation']."'>Postuler</a></td>";
					//echo $lig['id_formation'];
					//echo "<td>".$lig['id_formation']."</td>";
					/*echo "<td><a href=file.php?id_document=".$lig['id_document']."> Télécharger un fichier </a></td>";
					echo "<td><a href=remove.php?id_file=".$lig['id_document']."> Supprimer le fichier </a></td>";
					
					$stat=$bdd->prepare('SELECT * from DocumentsFourni df, Documents d where df.id_documents = d.id_document and d.id_document=?');
					$stat->execute(array($lig['id_document']));
					while($row = $stat->fetch())
					{
						echo "<td><a target='_blank' href='view.php?id_file=".$row["id_file"]."'>".$row["name"]."</a></td>";
					}
					print_r($stat->fetch());*/
				echo "</tr>";
			}
			?>
	</tr>
</table>
</main>
	<nav>
		<ul>
			<li><a href = "editerProfile.php">Editer mon profil</a></li><br>
			<li><a href = "formations.php">Afficher les formations</a></li><br>
			<li><a href = "SuiviFormations.php">Suivre candidature</a></li><br>
			<li><a href ="Commentaire.php">Laisser un commentaire</a></li><br>
			<li><a href = "Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>