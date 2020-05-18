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

if (isset($_POST['choixFormation'])) {
	$reqForm = $bdd->prepare("SELECT DISTINCT id_etudiant,Nom,Prenom,choixFormation,Intitule_formation,libelle, u.id_statuts from Utilisateur u, DocumentsFourni df, Formation f, Statuts s where u.TypeUser=3 and u.choixFormation=f.id_formation and u.id_statuts=s.id_statuts and u.choixFormation=?");
	$reqForm->execute(array($_POST['choixFormation']));
	//return $reqForm;
	//$docInfo = $reqForm->fetch();
	//var_dump($docInfo);

	$filename = "Liste_individus_postule" . date('Y-m-d') . ".csv"; 
	$delimiter = ","; 
	 
	// Create a file pointer 
	$f = fopen('php://memory', 'w'); 
	 
	// Set column headers 
	$fields = array('id_etudiant','Nom','Prenom','Formation postulé', 'Statut');

	fputcsv($f, $fields, $delimiter); 
	 
	// Get records from the database 
	
	 //var_dump($docInfo[0]);
    // Output each row of the data, format line as csv and write to file pointer 
    while($docInfo=$reqForm->fetch())
    { 
        $lineData = array($docInfo['id_etudiant'], $docInfo['Nom'],$docInfo['Prenom'], $docInfo['Intitule_formation'], $docInfo['libelle']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
	
	// Move back to beginning of file 
	fseek($f, 0); 
	 
	// Set headers to download file rather than displayed 
	header('Content-Type: text/csv'); 
	header('Content-Disposition: attachment; filename="' . $filename . '";'); 
	 
	// Output all remaining data on a file pointer 
	fpassthru($f); 
	 
	// Exit from file 
	exit();
	/*$this->render('list_appartenir',$data);*/

}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP</title>
	<link rel="stylesheet" href="../Content/css/nobel.css" />
</head>
<body>
<main>
<table>
	<h1> Liste des étudiants </h1>
	<tr>
		<td>
	    <div class="col-md-12 head">
	    	<form action ="" method="post">
				<p>
					<label for="choixFormation"><STRONG>Exporter:</STRONG></label> 
					<select name="choixFormation" onchange="document.getElementsByTagName('form').submit();">
					    <option value="">--Choisir une option--</option>
					    <option value="1">Licence MIAGE</option>
					    <option value="2">Master 1 MIAGE</option>
					    <option value="3">Master 2 MIAGE</option>
					</select>
				<p> <input type="submit" value="Exporter" /> </p>
			</form>
	    </div></td>
	</tr>
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
			<STRONG>Formation postulé</STRONG>
		</td>
		<td>
			<STRONG>Statut</STRONG>
		</td>
	</tr>
	<tr>
		<?php 
		//affiche la liste des étudiants ayant postulé à une candidature
			echo "<br><br>";
			$formation=$bdd->prepare('SELECT DISTINCT id_etudiant,Nom,Prenom,choixFormation,Intitule_formation,libelle, u.id_statuts from Utilisateur u, DocumentsFourni df, Formation f, Statuts s where u.TypeUser=3 and u.choixFormation=f.id_formation and u.id_statuts=s.id_statuts ORDER BY choixFormation,id_etudiant ASC');
			$formation->execute();
			while($lig = $formation->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
					echo "<td>".$lig['id_etudiant']."</td>";
					echo "<td><a href='AddFilesE.php?id_etudiant=".$lig['id_etudiant']."'>";
					echo $lig['Nom']."</td>";
					echo "<td>".$lig['Prenom']."</td>";
					echo "<td>".$lig['Intitule_formation']."</td>";
					echo "<td>".$lig['libelle']."</td>";
					echo "<td><a href='EditEtudiant.php?id_statut=".$lig["id_statuts"]."&id_etudiant=".$lig["id_etudiant"]."'><img src='../Content/img/edit-icon.png' alt='' class='icone'/></a></td>";
				echo "</tr>";
			}
			?>
	</tr>
</table>
</main>
	<nav>
		<ul>
			<li><a href = "editerProfileP.php">Editer mon profil</a></li><br>
			<li><a href = "formationsP.php">Afficher les formations</a></li><br>
			<li><a href = "Etudiants.php">Liste des étudiants</a></li><br>
			<li><a href ="CommentaireL.php">Commentaire laissé</a></li><br>
			<li><a href = "../Deconnexion.php">Se déconnecter</a></li><br>
		</ul>
	</nav>
</body>
</html>