<?php
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
	<title>Dépôt de fichier</title>
</head>
<body>
	<?php 
	if(isset($_POST['btn']))
	{
		$name = $_FILES['myfile']['name'];
		$type=$_FILES['myfile']['type'];
		$data=file_get_contents($_FILES['myfile']['tmp_name']);
		$stnt=$bdd->prepare('INSERT INTO DocumentsFourni(name,mime,data, id_documents, id_etu, id_formation, status) VALUES(?,?,?,?,?,?,?)');
		$stnt->execute(array($name,$type,$data, 1,9,1,1));
	}
	?>
	<p></p>
	<ol>
		<?php
		$stat=$bdd->prepare('SELECT * from DocumentsFourni');
		$stat->execute();
		while($row = $stat->fetch())
		{
			echo "<li><a target='_blank' href='view.php?id_file=".$row["id_file"]."'>".$row["name"]."</a></li>";
		}
		?>
	</ol>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="myfile">
		<button name="btn">Upload</button>
	</form>
</body>
</html>