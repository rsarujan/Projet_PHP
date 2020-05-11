<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');
/*if(isset($_GET['id_etudiant']) and $_GET['id_etudiant'] > 0)
{
	$getid = intval($_GET['id_etudiant']);
	$requser = $bdd->prepare("SELECT * FROM Utilisateur WHERE id_etudiant = ?");
	$requser->execute(array($getid));
	$userinfo = $requser->fetch();
}*/

if(isset($_GET['id_formation']) and $_GET['id_formation'] > 0)
{
	$getFormationid = intval($_GET['id_formation']);
	$reqFormation = $bdd->prepare("SELECT * FROM Formation WHERE id_formation = ?");
	$reqFormation->execute(array($getFormationid));
	$formInfo = $reqFormation->fetch();
}
/*if(isset($_GET['id_document']) and $_GET['id_document'] > 0)
{
	$id_document = intval($_GET['id_document']);
	$redDoc = $bdd->prepare("SELECT * FROM DocumentsFourni WHERE id_documents = ? and id_etu=?");
	$redDoc->execute(array($id_document,$_SESSION['id_etudiant']));
	$document = $redDoc->fetch();

	echo $document;
}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>Déposer des fichiers</title>
	<link rel="stylesheet" href="Content/css/nobel.css" />
</head>
<body>
	<!--<?php //echo $formInfo['id_formation'];?>-->
	<main>
		<table>
			<h1>Liste des fichiers déposés</h1>
			<tr>
				<!--<td>
					<STRONG>id</STRONG>
				</td>-->
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
				//echo $lig['id_etudiant'];
				/*$doc=$bdd->prepare('SELECT * from Documents');
				$doc->execute();*/
				$stat=$bdd->prepare('SELECT * from Documents d left join DocumentsFourni df on df.id_documents = d.id_document and df.id_etu=?');
						$stat->execute(array($_GET['id_etudiant']));

				while($lig = $stat->fetch()){
					//echo $formInfo['id_formation'];
					echo "<tr>";
						//echo "<td>".$lig['id_document']."</td>";
						echo "<td>".$lig['libelle']."</td>";
						echo "<td><a target='_blank' href='view.php?id_file=".$lig["id_file"]."'>".$lig["name"]."</a></td>";
						//echo "<td><a href=file.php?id_document=".$lig['id_document']."&id_formation=".$formInfo['id_formation']."> Télécharger un fichier </a></td>";
						//echo "<td><a href=remove.php?id_document=".$lig['id_document']."&id_etudiant=".$_SESSION['id_etudiant']."&id_formation=".$formInfo['id_formation']."> Supprimer le fichier </a></td>";
						
						//$stat=$bdd->prepare('SELECT * from DocumentsFourni df, Utilisateur, Documents d where df.id_etu=u.id_etudiant and df.id_documents=d.id_document');
						/*$stat=$bdd->prepare('SELECT * from DocumentsFourni df, Utilisateur u where df.id_etu=u.id_etudiant');
						$stat->execute();*/
						/*$stat=$bdd->prepare('SELECT * from DocumentsFourni df, Documents d Utilisateur u where df.id_documents = d.id_document and d.id_document=? and df.id_etu=u.id_etudiant and u.id_etudiant=?');//and df.id_formation=?');
						$stat->execute(array($lig['id_document'],17));//,$formInfo['id_formation']));*/
						/*$stat=$bdd->prepare('SELECT * from Documents d right join DocumentsFourni df on df.id_documents = d.id_document and df.id_etu=?');
						$stat->execute(array(38));*/
						//print_r($stat->fetch(PDO::FETCH_ASSOC));
						/*while($row = $stat->fetch())
						{
							echo "<td><a target='_blank' href='view.php?id_file=".$row["id_file"]."'>".$row["name"]."</a></td>";
						}*/
						//print_r($stat->fetch());
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
			<li><a href = "Deindex.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>