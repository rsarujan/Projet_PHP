<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');

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
	<title>Déposer des fichiers</title>
	<link rel="stylesheet" href="Content/css/nobel.css" />
</head>
<body>
	<main>
		<table>
			<h1>Liste des fichiers déposés</h1>
			<tr>

				<td>
					<STRONG>Fichiers à déposer</STRONG>
				</td>
				<td>
					<STRONG>Fichier déposé</STRONG>
				</td>
			</tr>
			<tr>
				<?php
				echo "<br><br>";

				$stat=$bdd->prepare('SELECT * from Documents d left join DocumentsFourni df on df.id_documents = d.id_document and df.id_etu=?');
						$stat->execute(array($_GET['id_etudiant']));

				while($lig = $stat->fetch()){
					echo "<tr>";
						//echo "<td>".$lig['id_document']."</td>";
						echo "<td>".$lig['libelle']."</td>";
						echo "<td><a target='_blank' href='view.php?id_file=".$lig["id_file"]."'>".$lig["name"]."</a></td>";
					echo "</tr>";
				}
				?>
			</tr>
		</tr>
		</table>
	</main>
	<nav>
		<ul>
			<li><a href = "editerProfileP.php">Editer mon profil</a></li><br>
			<li><a href = "formationsP.php">Afficher les formations</a></li><br>
			<li><a href = "Etudiants.php">Liste des étudiants</a></li><br>
			<li><a href ="CommentaireL.php">Commentaire laissé</a></li><br>
			<li><a href = "Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>