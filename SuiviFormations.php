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
	<h1> Liste des candidatures </h1>
	<tr>
		<td>
			<STRONG>Formation postulé</STRONG>
		</td>
		<td>
			<STRONG>Statut</STRONG>
		</td>
	</tr>
	<tr>
		<?php 

			$formation=$bdd->prepare('SELECT Intitule_formation, libelle from Formation f, Utilisateur u, Statuts s where u.choixFormation=f.id_formation and u.id_statuts=s.id_statuts and u.id_etudiant=?');
			$formation->execute(array($_SESSION['id_etudiant']));
			while($lig = $formation->fetch(PDO::FETCH_ASSOC)){
				//echo $lig['id_formation'];
				echo "<tr>";
					echo "<td>".$lig['Intitule_formation']."</td>";
					echo "<td>".$lig['libelle']."</td>";

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
			<li><a href = "Deindex.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>