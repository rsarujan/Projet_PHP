<?php
$bdd = new PDO('mysql:host=localhost;dbname=Projet_Php', 'root', 'root');
session_start();

function randomPassword() {
	$password = "";
    $charset = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $random_int = mt_rand();
        $password .= $charset[$random_int % strlen($charset)];
    }
    return $password;
}

if(isset($_POST['forminscription']))
{

	/*$tmdp=randomPassword();
	echo $tmdp;*/
	
	//echo $mdp;
	$nom = htmlspecialchars($_POST['Nom']);
	$prenom = htmlspecialchars($_POST['Prenom']);
	$num_tel = htmlspecialchars($_POST['num_tel']);
	$mail = htmlspecialchars($_POST['mail']);

	$mdp = sha1($_POST['mdp']);		//sha1 est un type d'encodage
	

	//echo $mdp;
	//echo bruteforce_sha1($mdp, timestamp);
	
	if(!empty($_POST['Nom']) and !empty($_POST['Prenom']) and !empty($_POST['num_tel'])
		and !empty($_POST['mail'])
		and !empty($_POST['mdp']))
	{
		if(filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
			$reqmail = $bdd->prepare("SELECT * FROM Utilisateur WHERE mail = ?");
			$reqmail->execute(array($mail));
			$mailexist = $reqmail->rowCount();
			if($mailexist == 0)
			{
				$insertion = $bdd->prepare("INSERT INTO Utilisateur(Nom,Prenom,num_tel, mail, mdp, TypeUser) VALUES (?,?,?,?,?,?)");
				$insertion->execute(array($nom,$prenom,$num_tel,$mail,$mdp,2));
				$erreur = "Le compte enseignant à bien été créé ! <a href=\"Enseignants.php\">Liste des enseignants </a>";
				header('Location: Enseignants.php');
				
				//echo $nom,$prenom,$carte_id,$date_naiss,$adresse,$num_tel,$mail,$mail2,$mdp,$mdp2;

					//print_r($insertion);

					//header('Location: inscription.php');
			}
			else
				$erreur = "Adresse mail déjà utilisée !";
		}
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
		<h1>Ajouter un enseignant</h1>
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
						Mot de Passe:
					</td>
					<td>
						<input type="text" id="mdp" name="mdp" placeholder="Votre mot de passe"value="<?php echo randomPassword()?>">
					</td>
				</tr>
				<tr>
					<td align="right">
					</td>
					<td align="center">
						<br>
						<input type="submit" name="forminscription"value="Valider">
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
	</div></main>
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
</html>