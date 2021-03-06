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
	$redDoc = $bdd->prepare("SELECT * FROM DocumentsFourni WHERE id_document = ? and id_etudiant=?");
	$redDoc->execute(array($id_document,$_SESSION['id_etudiant']));
	$document = $redDoc->fetch();

	echo $document;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Déposer des fichiers</title>
	<link rel="stylesheet" href="../Content/css/nobel.css" />
</head>
<body>
	<main>
		<table>
			<h1>Dépôts de fichiers</h1>
			<tr>
				<td>
					<STRONG>Fichiers à déposer</STRONG>
				</td>
				<td>
				</td>
				<td>

				</td>
				<td>
					<STRONG>Fichier déposé</STRONG>
				</td>
			</tr>
			<tr>
				<?php
				echo "<br><br>";
				$doc=$bdd->prepare('SELECT * from Documents');
				$doc->execute();
				while($lig = $doc->fetch()){
					//echo $formInfo['id_formation'];
					echo "<tr>";
					//insérer un fichier
						//affiche le nom du fichier à déposer
						echo "<td>".$lig['libelle']."</td>";
						//il insère le fichier avec l'id du fichier demandé
						echo "<td><a href=file.php?id_document=".$lig['id_document']."&id_formation=".$formInfo['id_formation']."> <img src='../Content/img/upload-icon.png' alt='' class='icone'/></a></td>";
						//il supprime le fichier avec l'id du fichier déposé
						echo "<td><a href=remove.php?id_document=".$lig['id_document']."&id_etudiant=".$_SESSION['id_etudiant']."&id_formation=".$formInfo['id_formation']."> <img src='../Content/img/remove-icon.png' alt='' class='icone'/></a></td>";
						//il affiche tous les fichiers déposé en face de chaque libelle des documents
						$stat=$bdd->prepare('SELECT * from DocumentsFourni df, Documents d where df.id_documents = d.id_document and d.id_document=? and df.id_etu=?');
						$stat->execute(array($lig['id_document'],$_SESSION['id_etudiant']));
						while($row = $stat->fetch())
						{
							//ouverture des fichiers dans un nouveau onglet
							echo "<td><a target='_blank' href='view.php?id_file=".$row["id_file"]."'>".$row["name"]."</a></td>";
						}
					echo "</tr>";
					//il met à jour la table utilisateur avec la donnée du choixFormation
					$userUpdate=$bdd->prepare('UPDATE Utilisateur SET choixFormation = ? WHERE id_etudiant=?');
						$userUpdate->execute(array($formInfo['id_formation'],$_SESSION['id_etudiant']));
				}
				?>
			</tr>
		</tr>
		</table>
	</main>
	<nav>
		<ul>
			<li><a href = "editerProfile.php">Editer mon profil</a></li><br>
			<li><a href = "formations.php">Afficher les formations</a></li><br>
			<li><a href = "SuiviFormations.php">Suivre candidature</a></li><br>
			<li><a href ="Commentaire.php">Laisser un commentaire</a></li><br>
			<li><a href = "../Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>