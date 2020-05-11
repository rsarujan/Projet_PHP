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

/*if(isset($_POST['formComment']))
{
	$comment = htmlspecialchars($_POST['Commentaire']);

	if(!empty($_POST['Commentaire']))
	{
		$insertion = $bdd->prepare("INSERT INTO Commentaire(id_etudiant,Commentaire) VALUES (?,?)");
		$insertion->execute(array($_SESSION['id_etudiant'],$comment));
		$erreur = "Votre message à bien été envoyé!";
		header("Location: Commentaire.php");
	}
}*/
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
				$doc=$bdd->prepare('SELECT u.id_etudiant,Nom,Prenom,Commentaire from Commentaire c, Utilisateur u where u.id_etudiant=c.id_etudiant');
				$doc->execute();

				while($lig = $doc->fetch()){
					echo "<br><br>";
					echo "<tr>";
						echo "<td>".$lig['id_etudiant']."</td>";
						echo "<td>".$lig['Nom']."</td>";
						echo "<td>".$lig['Prenom']."</td>";
						echo "<td>".$lig['Commentaire']."</td>";
						//echo "<td>".$lig['Commentaire']."</td>";
						//echo "<td><a href=removeComment.php?id_commentaire=".$lig['id_commentaire']."&id_etudiant=".$_SESSION['id_etudiant']."> Supprimer le commentaire </a></td>";
					echo "</tr>";
				}
			?>
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