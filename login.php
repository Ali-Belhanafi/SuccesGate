<?php 
	include "resources/header.php";
	if(isset($_SESSION['user'])) {
		echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
	}

	if(!isset($_SESSION['user'])) {

		$flag = "test";

		if(isset($_POST['log'])) {
			$req = mysqli_query($cnx,"SELECT idUser,email,password,type,avatar FROM users");
			$email = $_POST['mail'];
			$mdp = $_POST['pwd'];
			$flag = 0;

			while($tab = mysqli_fetch_assoc($req)) {
				if($email === $tab['email'] AND $mdp === $tab['password']) {
					$flag = 1;
					$_SESSION['user']['id']=$tab['idUser'];
					$_SESSION['user']['type']=$tab['type'];
					$_SESSION['user']['avatar']=$tab['avatar'];
				}
			}

			if($flag == 1) {
				echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
			}

		}

		echo "
			<div class=\"login-clean\">
		";

		if($flag === 0) {
			echo "
					<!-- Error Alert -->
					<div class=\"alert alert-danger alert-dismissible fade show\" style=\"margin-bottom:80px;\">
					    <b>ERREUR : </b> Email / Mot de passe invalide !
					    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
					</div>
			";
		}

		echo "
			        <form method=\"post\" style=\"width:400px;\">
			            <div class=\"illustration\">
			                <img src=\"assets/img/logo.jpg\" style=\"width:200px;\">
			            </div>
			            <p class=\"text-capitalize text-center\" style=\"color:#2070e0;font-size:16px;font-family:Ubuntu, sans-serif;font-weight:bold;\">Connectez-vous</p>
			            <div class=\"form-group\">
			                <input class=\"form-control\" type=\"email\" name=\"mail\" placeholder=\"Email\" required>
			            </div>
			            <div class=\"form-group\">
			                <input class=\"form-control\" type=\"password\" name=\"pwd\" placeholder=\"Mot de passe\" required>
			            </div>
			            <div class=\"form-group\">
			                <button class=\"btn btn-primary btn-block\" name=\"log\" type=\"submit\" style=\"background-color:#2070e0;\">Se Connecter</button>
			            </div>
			            <a href=\"#\" class=\"forgot\">Mot de passe oublié ?</a>
			            <p class=\"signup\">Vous n'avez pas de compte? <a href=\"signup.php\"> Inscrivez-vous</a></p>
			        </form>
			    </div>
		";
	}


	include "resources/footer.php";
?>