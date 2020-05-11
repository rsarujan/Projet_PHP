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

if(isset($_POST['formComment']))
{
	$comment = htmlspecialchars($_POST['Commentaire']);

	if(!empty($_POST['Commentaire']))
	{
		$insertion = $bdd->prepare("INSERT INTO Commentaire(id_etudiant,Commentaire) VALUES (?,?)");
		$insertion->execute(array($_SESSION['id_etudiant'],$comment));
		$erreur = "Votre message à bien été envoyé!";
		header("Location: Commentaire.php");
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="Content/css/nobel.css" />

</head>
<body>
	<main><table>
		<h1>Laisser un message à un administrateur</h1>
		<br><br><br>
		<form method="POST" action="">
			<table>
				<tr>
					<td align="right">
						Commentaire / Message :
					</td>
					<td>
						<input type="text" id="Commentaire" name="Commentaire" placeholder="Écrire votre message" value="<?php if(isset($comment)) {echo $comment;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
					</td>
					<td align="center">
						<br>
						<input type="submit" name="formComment"value="Envoyé">
					</td>
				</tr>
			</table>
		</form>
		</table>
		<table>
			<tr>
		<td>
			<STRONG>Commentaire laissé</STRONG>
		</td>
		<td>
			<STRONG></STRONG>
		</td>
	</tr>
			<?php
			echo "<br><br>";
				$doc=$bdd->prepare('SELECT * from Commentaire WHERE id_etudiant = ?');
				$doc->execute(array($_SESSION['id_etudiant']));

				while($lig = $doc->fetch()){
					echo "<br><br><br>";
					echo "<tr>";
						echo "<td>".$lig['Commentaire']."</td>";
						echo "<td><a href=removeComment.php?id_commentaire=".$lig['id_commentaire']."&id_etudiant=".$_SESSION['id_etudiant']."> <img src='Content/img/remove-icon.png' alt='' class='icone'/></a></td>";
					echo "</tr>";
				}
			?>
		</table>
	</main>
	<nav>
		<ul>
			<li><a href = "editerProfile.php">Editer mon profil</a></li><br>
			<li><a href = "formations.php">Afficher les formations</a></li><br>
			<li><a href = "SuiviFormations.php">Suivre candidature</a></li><br>
			<li><a href ="Commentaire.php">Laisser un commentaire</a></li><br>
			<li><a href = "Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>