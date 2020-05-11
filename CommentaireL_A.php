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
		<h1>Message laissé</h1>
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
				<STRONG>Commentaire/message</STRONG>
			</td>
		</tr>
			<?php
			echo "<br><br>";
				$doc=$bdd->prepare('SELECT u.id_etudiant,Nom,Prenom,id_commentaire,Commentaire from Commentaire c, Utilisateur u where u.id_etudiant=c.id_etudiant');
				$doc->execute();

				while($lig = $doc->fetch()){
					
					echo "<tr>";
						echo "<td>".$lig['id_etudiant']."</td>";
						echo "<td>".$lig['Nom']."</td>";
						echo "<td>".$lig['Prenom']."</td>";
						echo "<td>".$lig['Commentaire']."</td>";
						echo "<td><a href=removeCommentA.php?id_commentaire=".$lig['id_commentaire']."&id_etudiant=".$lig['id_etudiant']."> <img src='Content/img/remove-icon.png' alt='' class='icone'/></a></td>";
					echo "</tr>";
				}
			?>
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