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
	<h1> Liste des étudiants </h1>
	<tr>
		<td>
			<STRONG>id Etudiant</STRONG>
		</td>
		<td>
			<STRONG>Nom</STRONG>
		</td>
		<td>
			<STRONG>Prénom</STRONG>
		</td>
		<td>
			<STRONG>Formation postulé</STRONG>
		</td>
		<td>
			<STRONG>Statut</STRONG>
		</td>
	</tr>
	<tr>
		<?php 
			echo "<br><br>";
			$formation=$bdd->prepare('SELECT DISTINCT id_etudiant,Nom,Prenom,choixFormation,Intitule_formation,libelle, u.id_statuts from Utilisateur u, DocumentsFourni df, Formation f, Statuts s where u.TypeUser=3 and u.choixFormation=f.id_formation and u.id_statuts=s.id_statuts ORDER BY choixFormation,id_etudiant ASC');
			$formation->execute();
			while($lig = $formation->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
					echo "<td>".$lig['id_etudiant']."</td>";
					echo "<td><a href='AddFilesE.php?id_etudiant=".$lig['id_etudiant']."'>";
					echo $lig['Nom']."</td>";
					echo "<td>".$lig['Prenom']."</td>";
					echo "<td>".$lig['Intitule_formation']."</td>";
					echo "<td>".$lig['libelle']."</td>";
					echo "<td><a href='EditEtudiant.php?id_statut=".$lig["id_statuts"]."&id_etudiant=".$lig["id_etudiant"]."'><img src='../Content/img/edit-icon.png' alt='' class='icone'/></a></td>";
				echo "</tr>";
			}
			?>
	</tr>
</table>
</main>
	<nav>
		<ul>
			<li><a href = "editerProfileP.php">Editer mon profil</a></li><br>
			<li><a href = "formationsP.php">Afficher les formations</a></li><br>
			<li><a href = "Etudiants.php">Liste des étudiants</a></li><br>
			<li><a href ="CommentaireL.php">Commentaire laissé</a></li><br>
			<li><a href = "../Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>