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
	<h1> Liste des enseignants </h1>
	<tr>
		<td>
			<STRONG>Nom</STRONG>
		</td>
		<td>
			<STRONG>Prénom</STRONG>
		</td>
		<td>
			<STRONG>Mail</STRONG>
		</td>
	</tr>
	<tr>
		<?php
		echo "<br><br>";
			$enseignants=$bdd->prepare('SELECT * from Utilisateur where TypeUser=2');
			$enseignants->execute();
			while($lig = $enseignants->fetch()){
				//echo $lig['id_formation'];
				echo "<tr>";
					echo "<td>".$lig['Nom']."</td>";
					echo "<td>".$lig['Prenom']."</td>";
					echo "<td>".$lig['mail']."</td>";
					//echo "<td><a href='addFiles.php?id_formation=".$lig['id_formation']."'>Postuler</a></td>";
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