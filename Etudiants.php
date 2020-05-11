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
	<link rel="stylesheet" href="fichier.css" />
</head>
<body>
<main>
<table>
	<h1> Liste des étudiants </h1>
	<tr>
		<td>
			<STRONG>id</STRONG>
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
			//$formation=$bdd->prepare('SELECT DISTINCT id_etudiant,Nom,Prenom,choixFormation,Intitule_formation,libelle from Utilisateur u, DocumentsFourni df, Formation f, Statuts s where u.TypeUser=3 and u.choixFormation=df.id_formation and df.id_formation=f.id_formation and u.Status=s.id_statuts ORDER BY choixFormation ASC');

			$formation=$bdd->prepare('SELECT DISTINCT id_etudiant,Nom,Prenom,choixFormation,Intitule_formation,libelle, u.id_statuts from Utilisateur u, DocumentsFourni df, Formation f, Statuts s where u.TypeUser=3 and u.choixFormation=f.id_formation and u.id_statuts=s.id_statuts ORDER BY choixFormation ASC');
			$formation->execute();
			while($lig = $formation->fetch(PDO::FETCH_ASSOC)){
				//echo $lig['id_formation'];
				echo "<tr>";
					echo "<td>".$lig['id_etudiant']."</td>";
					echo "<td><a href='AddFilesE.php?id_etudiant=".$lig['id_etudiant']."'>";
					echo $lig['Nom']."</td>";
					echo "<td>".$lig['Prenom']."</td>";
					echo "<td>".$lig['Intitule_formation']."</td>";
					echo "<td>".$lig['libelle']."</td>";
					echo "<td><a href='EditEtudiant.php?id_statut=".$lig["id_statuts"]."&id_etudiant=".$lig["id_etudiant"]."'><img src='Content/img/edit-icon.png' alt='' class='icone'/></a></td>";



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
			<li><a href = "editerProfile.php">Editer mon profil</a></li><br>
			<li><a href = "formations.php">Afficher les formations</a></li><br>
			<li><a href ="Commentaire.php">Laisser un commentaire</a></li><br>
			<li><a href = "Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>