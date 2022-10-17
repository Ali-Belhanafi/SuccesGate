<?php 
	include "resources/header.php";
	if(isset($_SESSION['user'])) {
		echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
	}


	if(!isset($_SESSION['user'])) {

		if(isset($_GET['type'])) {
			$type = $_GET['type'];


			if(isset($_POST['send'])) {
				$desc = $_POST['description'];
				$mail = $_POST['mail'];
				$pwd = $_POST['pwd'];
				$tel = $_POST['tel'];
				$addr = $_POST['adresse'];
				$ville = $_POST['ville'];
				$pays = $_POST['pays'];
				$codep = $_POST['codeP'];
				if($type == 0) {
					$nom = $_POST['nom'];
					$prenom = $_POST['prenom'];

					$SQL = "INSERT INTO users(nom,prenom,telephone,adresse,ville,pays,codePost,email,password,description,type)
							VALUES('$nom','$prenom',$tel,'$addr','$ville','$pays',$codep,'$mail','$pwd','$desc',$type)";
				}
				if($type==1 OR $type==2) {
					$lib = $_POST['libelle'];
					$secteur = $_POST['secteur'];

					$SQL = "INSERT INTO users(libelle,telephone,adresse,ville,pays,codePost,email,password,description,type,secteur)
							VALUES('$lib',$tel,'$addr','$ville','$pays',$codep,'$mail','$pwd','$desc',$type,$secteur)";
				}

				@mysqli_query($cnx,$SQL) OR die("Erreur d'inscription !");
				echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
			}

			/* Inscription Form */
			echo "
			<div class=\"login-clean\">
		        <form method=\"post\">
		            <div class=\"illustration\">
		                <img src=\"assets/img/logo.jpg\" style=\"width:200px;\">
		            </div>
		            <p class=\"text-capitalize text-center\" style=\"color:#2070e0;font-size:16px;font-family:Ubuntu, sans-serif;font-weight:bold;\">Inscrivez-vous</p>";

		            if($type == 0) {
		            	echo "
		            		<div class=\"form-group\">
		                		<input class=\"form-control\" type=\"text\" name=\"nom\" placeholder=\"Nom\" required>
		            		</div>
		            		<div class=\"form-group\">
		                		<input class=\"form-control\" type=\"text\" name=\"prenom\" placeholder=\"Prénom\" required>
		            		</div>
		            	";
		            }
		            if($type == 1) {
		            	echo "
		            		<div class=\"form-group\">
		                		<input class=\"form-control\" type=\"text\" name=\"libelle\" placeholder=\"Nom d'Entreprise\" required>
		            		</div>
		            		<div class=\"form-group\">
		            			<select name=\"secteur\" class=\"form-control\">
		            				<option selected disabled>Secteur</option>
		            				<option value=\"0\">Public</option>
		            				<option value=\"1\">Privé</option>
		                		</select>
		            		</div>
		            	";
		            }
		           	if($type == 2) {
		            	echo "
		            		<div class=\"form-group\">
		                		<input class=\"form-control\" type=\"text\" name=\"libelle\" placeholder=\"Nom d'Ecole\" required>
		            		</div>
		            		<div class=\"form-group\">
		            			<select name=\"secteur\" class=\"form-control\">
		            				<option selected disabled>Secteur</option>
		            				<option value=\"0\">Public</option>
		            				<option value=\"1\">Privé</option>
		                		</select>
		            		</div>
		            	";
		            }

		            echo "
		            <div class=\"form-group\">
		                <textarea class=\"form-control\" name=\"description\" rows=3 max=500 placeholder=\"Description\" required style=\"height:100px;\"></textarea>
		            </div>
		            <div class=\"form-group\">
		                <input class=\"form-control\" type=\"email\" name=\"mail\" placeholder=\"Email\" required>
		            </div>
		            <div class=\"form-group\">
		                <input class=\"form-control\" type=\"password\" name=\"pwd\" placeholder=\"Mot de passe\" required>
		            </div>
		            <div class=\"form-group\">
                		<input class=\"form-control\" type=\"number\" name=\"tel\" placeholder=\"Téléphone\" required>
            		</div>
            		<div class=\"form-group\">
                		<input class=\"form-control\" type=\"text\" name=\"adresse\" placeholder=\"Adresse\" required>
            		</div>
            		<div class=\"form-group\">
                		<input class=\"form-control\" type=\"text\" name=\"ville\" placeholder=\"Ville\" required>
            		</div>
            		<div class=\"form-group\">
                		<input class=\"form-control\" type=\"text\" name=\"pays\" placeholder=\"Pays\" required>
            		</div>
            		<div class=\"form-group\">
                		<input class=\"form-control\" type=\"number\" name=\"codeP\" placeholder=\"Code Postal\" required>
            		</div>
		            <div class=\"form-group\">
		                <button class=\"btn btn-primary btn-block\" name=\"send\" type=\"submit\" style=\"background-color:#2070e0;\">S'inscrire</button>
		            </div>
		            <p class=\"signin\">Vous avez déjà un compte? <a href=\"login.php\"> Connectez-vous</a></p>
		        </form>
		    </div>
			";
		}


		if(!isset($_GET['type'])) {
			/* Choose Type of user */
			echo "
			<div class=\"chooseType col-12\">
				<div class=\"container\">
					<h3 class=\"text-center\">Choose your type :</h3>
					<hr>
					<div class=\"row typesList\">
						<div class=\"col-4\">
							<a class=\"userType\" href=\"?type=0\"><i class=\"fa fa-user\"></i>Individu</a>
						</div>
						<div class=\"col-4\">
							<a class=\"userType\" href=\"?type=1\"><i class=\"fa fa-briefcase\"></i>Entreprise</a>
						</div>
						<div class=\"col-4\">
							<a class=\"userType\" href=\"?type=2\"><i class=\"fa fa-university\"></i> Ecole</a>
						</div>
					</div>
				</div>
			</div>
			";
		}

	}


	include "resources/footer.php";
?>