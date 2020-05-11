<?php
$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');
session_start();

if(isset($_POST['forminscription']))
{
	$nom = htmlspecialchars($_POST['Nom']);
	$prenom = htmlspecialchars($_POST['Prenom']);
	$carte_id = htmlspecialchars($_POST['carte_id']);
	$date_naiss = htmlspecialchars($_POST['date_naiss']);
	$adresse = htmlspecialchars($_POST['adresse']);
	$num_tel = htmlspecialchars($_POST['num_tel']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail']);
	$mdp = sha1($_POST['mdp']);		//sha1 est un type d'encodage
	$mdp2 = sha1($_POST['mdp2']);

	
	if(!empty($_POST['Nom']) and !empty($_POST['Prenom'])
		and !empty($_POST['carte_id']) and !empty($_POST['date_naiss'])
		and !empty($_POST['adresse']) and !empty($_POST['num_tel'])
		and !empty($_POST['mail']) and !empty($_POST['mail2'])
		and !empty($_POST['mdp']) and !empty($_POST['mdp2']))
	{

		if($mail == $mail2)
		{

			if(filter_var($mail, FILTER_VALIDATE_EMAIL))
			{

				$reqmail = $bdd->prepare("SELECT * FROM Utilisateur WHERE mail = ?");
				$reqmail->execute(array($mail));
				$mailexist = $reqmail->rowCount();
				if($mailexist == 0)
				{
					if($mdp == $mdp2)
					{

						$insertion = $bdd->prepare("INSERT INTO Utilisateur(Nom,Prenom, carte_id, date_naiss, adresse, num_tel, mail, mdp, TypeUser) VALUES (?,?,?,?,?,?,?,?,?)");
						$insertion->execute(array($nom,$prenom,$carte_id,$date_naiss,$adresse,$num_tel,$mail,$mdp,3));
						$erreur = "Votre compte à bien été créé ! <a href=\"index.php\">Me connecter </a>";
						//echo $nom,$prenom,$carte_id,$date_naiss,$adresse,$num_tel,$mail,$mail2,$mdp,$mdp2;

						//print_r($insertion);

						//header('Location: inscription.php');
					}
					else
						$erreur = "Vos mots de passes ne sont pas identiques !";
				}
				else
					$erreur = "Adresse mail déjà utilisée !";
			}
			else
				$erreur = "Votre adresse mail n'est pas valide !";
		}
		else
			$erreur = "Vos adresses mails ne sont pas indentiques !";
	}
	else
		$erreur = "Tous les champs doivent être remplis !";
}

//echo print_r($insertion);
?>



<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="Content/css/nobel.css" />

</head>
<body>
	<main><table>
		<h1>Inscription</h1>
		<br><br><br>
		<form method="POST" action="">
			<table>
				<tr>
					<td align="right">
						Nom:
					</td>
					<td>
						<input type="text" id="Nom" name="Nom" placeholder="Votre nom" value="<?php if(isset($nom)) {echo $nom;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Prénom:
					</td>
					<td>
						<input type="text" id="Prenom" name="Prenom" placeholder="Votre prénom" value="<?php if(isset($prenom)) {echo $prenom;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Carte ID:
					</td>
					<td>
						<input type="number" id="carte_id" name="carte_id" placeholder="Numéro de carte ID" value="<?php if(isset($carte_id)) {echo $carte_id;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Date de Naissance:
					</td>
					<td>
						<input type="date" id="date_naiss" name="date_naiss" placeholder="jj/mm/aaaa" value="<?php if(isset($date_naiss)) {echo $date_naiss;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Adresse:
					</td>
					<td>
						<input type="text" id="adresse" name="adresse" placeholder="Votre adresse postale" value="<?php if(isset($adresse)) {echo $adresse;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Numéro de téléphone:
					</td>
					<td>
						<input type="number" id="num_tel" name="num_tel" placeholder="Votre numéro Tel." value="<?php if(isset($num_tel)) {echo $num_tel;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Adresse mail:
					</td>
					<td>
						<input type="email" id="mail" name="mail" placeholder="Votre adresse mail" value="<?php if(isset($mail)) {echo $mail;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Confirmation de l'adresse mail:
					</td>
					<td>
						<input type="email" id="mail2" name="mail2" placeholder="Confirmez votre mail" value="<?php if(isset($mail2)) {echo $mail2;}?>">
					</td>
				</tr>
				<tr>
					<td align="right">
						Mot de Passe:
					</td>
					<td>
						<input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe">
					</td>
				</tr>
				<tr>
					<td align="right">
						Confirmation du Mot de Passe:
					</td>
					<td>
						<input type="password" id="mdp2" name="mdp2" placeholder="Confirmez votre mdp">
					</td>
				</tr>
				<tr>
					<td align="right">
					</td>
					<td align="center">
						<br>
						<input type="submit" name="forminscription"value="Je m'inscris">
					</td>
				</tr>
			</table>
		</form>
		<?php 
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur.'</font>';
			}
		?>
	</div>
</body>
</html>