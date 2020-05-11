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
	<h1> Liste des formations </h1>
	<tr>
		<td>
			<STRONG>Nom des formations</STRONG>
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
				echo "</tr>";
			}
			?>
	</tr>
</table>
</main>
	<nav>
		<ul>
			<li><a href = "formationsA.php">Afficher les formations</a></li><br>
			<li><a href = "Etudiants.php">Liste des étudiants</a></li><br>
			<li><a href = "Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>			
</body>
</html>