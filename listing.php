<?php 
	include "resources/header.php";

	if(isset($_SESSION['user']) AND ($_SESSION['user']['type']==1 OR $_SESSION['user']['type']==2)) {

		if(isset($_GET['type'])) {
			$type = $_GET['type'];

			if(isset($_POST['send'])) {
				$titre = mysqli_real_escape_string($cnx,$_POST['titre']);
				$description = mysqli_real_escape_string($cnx,$_POST['description']);
				$ville = $_POST['ville'];
				$pays = $_POST['pays'];
				$datef = $_POST['datef'];

/* UPLOAD */
				//Extraire le nom du fichier
				$nom_image = $_FILES['pic']['name'];
				$fichier = basename($_FILES['pic']['name']);
				$dossier = 'upload/img/';

				//Extraire l'extension du fichier
					//end() déplace le pointeur interne du tableau array jusqu'au dernier élément et retourne sa valeur.

				$temp = explode('.', $nom_image);
				$extension = end($temp);

				// Extensions permises
				$extension_autor = array('jpg','jpeg','png','bmp','gif');

				//Chaînes non valides
				$e_accent = array('é','ê','ë','è');
				$espace = array(' ');
				$fichier=str_replace($e_accent, 'e', $fichier);
				$fichier=str_replace($espace, '_', $fichier);

			
/* UPLOAD */

				if($type == 0) {
					$type = $_POST['typejob'];
					$domaine = $_POST['domaine'];
					$salaire = $_POST['salaire'];
					

					$SQL = "INSERT INTO jobs(titre,descriptionJob,typeJob,domaine,salaire,ville,pays,dateFin,pic,idUser)
							VALUES('$titre','$description','$type','$domaine',$salaire,'$ville','$pays','$datef','$nom_image','{$_SESSION['user']['id']}')";
				}

				if($type==1) {
					$type = $_POST['typebourse'];
					$nivEtudes = $_POST['nivEtudes'];
					$specialite = $_POST['specialite'];


					$SQL = "INSERT INTO scholarships(titre,descriptionBourse,typeBourse,specialite,ville,pays,dateFin,nivEtudes,pic,idUser)
							VALUES('$titre','$description','$type','$specialite','$ville','$pays','$datef','$nivEtudes','$nom_image','{$_SESSION['user']['id']}')";
				}

				@mysqli_query($cnx,$SQL) OR die("Erreur ! $nom_image");
				//Tests pour uploader

				if(in_array($extension , $extension_autor)) {
					//Executer l'upload
					if(move_uploaded_file($_FILES['pic']['tmp_name'], $dossier.$fichier))
						echo "Uploaded Successfully<br>";
				}

				else echo "Fichier non valide<br>";
				echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
			}

			/* List Posting Form */
			echo "
			<div class=\"login-clean\">
		        <form method=\"post\" enctype=\"multipart/form-data\" style=\"max-width:800px !important;\">
		            <h3 class=\"text-center\" style=\"font-weight:bold;padding:20px 10px;\">Post a Listing :</h3>

		            <div class=\"form-group\">
		                <input class=\"form-control\" type=\"text\" name=\"titre\" placeholder=\"Listing Title\" required>
		            </div>
		            <div class=\"form-group\">
		                <textarea class=\"form-control\" name=\"description\" placeholder=\"Listing Description\"
		                required style=\"height:300px;\"></textarea>
		            </div>
		            ";
		            
		            if($type == 0) {
		            	echo "
		            		<div class=\"form-group\">
		                		<select class=\"form-control\" name=\"typejob\" required>
		                			<option selected disabled>Listing Type</option>
		                			<option>Full-Time</option>
		                			<option>Part-Time</option>
		                			<option>Remote-Work</option>
		                			<option>Internship</option>
		                		</select>
		            		</div>
		            		<div class=\"form-group\">
		                		<select class=\"form-control\" name=\"domaine\" required>
		                			<option selected disabled>Domain</option>
                                    <option>Computer Science</option>
                                    <option>Medecine</option>
                                    <option>Engineering and Technology</option>
                                    <option>Mathematics</option>
                                    <option>History</option>
                                    <option>Economics</option>
                                    <option>Linguistics</option>
                                    <option>Architecture</option>
                                    <option>Law</option>
		                		</select>
		            		</div>
		            		<div class=\"form-group\">
		                		<input type=\"number\" class=\"form-control\" name=\"salaire\" min=0 placeholder=\"Salary ($/Month)\" required>
		            		</div>
		            	";
		            }
		            if($type == 1) {
		            	echo "
		            		<div class=\"form-group\">
		                		<select class=\"form-control\" name=\"typebourse\" required>
		                			<option selected disabled>Listing Type</option>
		                			<option>Full-Scholarship</option>
		                			<option>Half-Scholarship</option>
		                			<option>Transfer-Scholarship</option>
		                		</select>
		            		</div>
		            		<div class=\"form-group\">
		                		<select class=\"form-control\" name=\"nivEtudes\" required>
		                			<option selected disabled>Degree Level</option>
		                			<option>Bac</option>
		                			<option>Bac +2</option>
		                			<option>Bac +3</option>
		                			<option>Bac +5</option>
		                		</select>
		            		</div>
		            		<div class=\"form-group\">
		                		<select class=\"form-control\" name=\"specialite\" required>
		                			<option selected disabled> Field of Studies </option>
                                    <option>Computer Science</option>
                                    <option>Formal Sciences</option>
                                    <option>Medicine</option>
                                    <option>Engineering and Technology</option>
                                    <option>Natural Sciences</option>
                                    <option>History</option>
                                    <option>Economics</option>
                                    <option>Linguistics</option>
                                    <option>Architecture</option>
                                    <option>Law</option>
		                		</select>
		            		</div>
		            	";
		            }
		           	
		            echo "
		            <div class=\"form-group\">
		                <input class=\"form-control\" type=\"text\" name=\"ville\" placeholder=\"Ville\" required>
		            </div>
		            <div class=\"form-group\">
		                <input class=\"form-control\" type=\"text\" name=\"pays\" placeholder=\"Pays\" required>
		            </div>
		            <div class=\"form-group\">
		           		<label for=\"datef\" style=\"font-size:12px;margin-top:20px;\">Expire Date</label>
		                <input class=\"form-control\" id=\"datef\" type=\"date\" name=\"datef\" required>
		            </div>
		            <div class=\"form-group\">
		            	<label for=\"pic\" style=\"font-size:12px;margin-top:20px;\">Picture</label>
		                <input class=\"form-control\" type=\"file\" id=\"pic\" name=\"pic\" required>
		            </div>


		            <div class=\"form-group\">
		                <button class=\"btn btn-primary btn-block\" name=\"send\" type=\"submit\" style=\"background-color:#2070e0;\">Post Listing</button>
		            </div>
		        </form>
		    </div>
			";
		}

	}


	include "resources/footer.php";
?>