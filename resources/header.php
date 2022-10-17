<?php
	include "connexion.php";

	if(isset($_GET['decon'])) {
		unset($_SESSION['user']);
		echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SuccessGate</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php 
	if( defined('PAGE') AND (PAGE == 'Jobs' OR PAGE == 'Scholarships') ) {
		echo "
		<!-- Start Navbar -->
		<div>
		  <!-- Top Nav -->
		  <nav class=\"navbar navbar-light navbar-expand-md top-nav\">
		    <div class=\"container-fluid\">
		      <ul class=\"navbar-nav mr-auto l-nav\">
		        <li class=\"nav-item"; if(PAGE == 'Jobs') {echo " active";}
		        echo "\">
		          <a class=\"nav-link\" href=\"jobs.php\">Jobs<span class=\"sr-only\">(current)</span></a>
		        </li>
		        <li class=\"nav-item"; if(PAGE == 'Scholarships') {echo " active";}
		        echo "\">
		          <a class=\"nav-link\" href=\"scholarships.php\">Scholarships</a>
		        </li>
		        <li class=\"nav-item\">
		          <a class=\"nav-link\" href=\"individuals.php\">Individuals</a>
		        </li>
		        <li class=\"nav-item\">
		          <a class=\"nav-link\" href=\"about_us.php\">About</a>
		        </li>
		        <li class=\"nav-item\">
		          <a class=\"nav-link\" href=\"contact.php\">Contact</a>
		        </li>
		      </ul>

		      <ul class=\"navbar-nav ml-auto r-nav\" style=\"color:#555\">";
		      if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) echo "
		        <li class=\"nav-item\">
		          <a class=\"nav-link\" href=\"favoris.php\"><i class=\"fa fa-heart\"></i> Favorites</a>
		        </li>
		        ";
		       if(isset($_SESSION['user']) AND $_SESSION['user']['type']!=0){
			        $type = $_SESSION['user']['type'];
			        if($type==2)
			        echo "
				        <li class=\"nav-item\" style=\"margin-right:20px;\">
				          <a class=\"nav-link\" href=\"listing.php?type=1\"><i class=\"fa fa-plus-circle\"></i> Post a Listing</a>
				        </li>";
				    if($type==1)
			        echo "
				        <li class=\"nav-item\" style=\"margin-right:20px;\">
				          <a class=\"nav-link\" href=\"listing.php?type=0\"><i class=\"fa fa-plus-circle\"></i> Post a Listing</a>
				        </li>";
		    	}
		        if(!isset($_SESSION['user'])) {
			        echo "<li class=\"nav-item sign-in-btn\">
			          <a class=\"nav-link\" href=\"login.php\"><i class=\"fa fa-user\"></i> Sign In</a>
			        </li>";
		    	}

		    	if(isset($_SESSION['user'])) {
		        	echo " 
		        		<li class=\"nav-item dropdown\">
					        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
					          <img src=\"upload/avatars/{$_SESSION['user']['avatar']}\" width=\"30\" height=\"30\" class=\"rounded-circle profile-circle\">
					        </a>
					        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
					          <a class=\"dropdown-item\" href=\"profile.php?id={$_SESSION['user']['id']}\">Profile</a>";
					          if($_SESSION['user']['type']==1 OR $_SESSION['user']['type']==2) echo "<a class=\"dropdown-item\" href=\"demandes.php\">Demandes</a>";
					          echo "<a class=\"dropdown-item\" href=\"?decon=1\">Log Out</a>
					        </div>
				        </li>   
		        	";
		        }

		    	echo "
		      </ul>
		    </div>
		  </nav>

		  <!-- Mid Nav -->
		  <nav class=\"navbar navbar-expand-lg navbar-light mid-nav\">
		    <div class=\"container\">
		      <a class=\"logo\" href=\"index.php\"><img src=\"assets/img/logo2.png\" width=90></a>
		      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent-4\"
		        aria-controls=\"navbarSupportedContent-4\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		        <span class=\"navbar-toggler-icon\"></span>
		      </button>
		      <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent-4\">
		        <form method=\"post\">
		          <div style=\"float:left;margin-left:35px\">
		            <ul class=\"navbar-nav ml-auto\">
		              <li class=\"nav-item\">
		                <select name=\"category\" class=\"form-control\">
		                ";
		                if(PAGE == 'Scholarships') {
		                	echo "<option value=\"1\">Scholarships</option>
		                  		  <option value=\"0\">Jobs</option>";
		                }
		                if(PAGE == 'Jobs') {
		                	echo "<option value=\"0\">Jobs</option>
		                	<option value=\"1\">Scholarships</option>";
		                }
		                echo "
		                </select>
		              </li>
		              <li class=\"nav-item\">
		                <input class=\"form-control\" type=\"text\" name=\"keyword\" placeholder=\"Search by interests, skills ...\" size=\"45\">
		              </li>
		              <li class=\"nav-item\">
		                <div class=\"input-group\">
		                  <div class=\"input-group-prepend\">
		                    <span class=\"input-group-text bg-transparent\" id=\"basic-addon1\"><i class=\"fa fa-location-arrow\"></i></span>
		                  </div>
		                  <input class=\"form-control\" type=\"text\" name=\"location\" placeholder=\"Everywhere\" size=\"10\" aria-label=\"Username\" aria-describedby=\"basic-addon1\">
		                </div> 
		              </li>
		            </ul>
		          </div>
		          <div>
		            <ul class=\"navbar-nav\">
		              <li class=\"nav-item search-btn\">
		                <button type=\"submit\" name=\"find\" class=\"btn btn-primary text-white\"><a><i class=\"fa fa-search\"></i> Search</a></button>
		              </li>
		            </ul>
		          </div>
		        </form>
		      </div>
		    </div>
		  </nav>
		<!-- End Navbar -->
		";
	}
	else {
		echo "
		<!-- Start Navbar -->
		  <nav class=\"navbar navbar-expand-lg navbar-light mid-nav\">
		    <div class=\"container-fluid\">
		      <a class=\"logo\" href=\"index.php\"><img src=\"assets/img/logo2.png\" width=90></a>
		      <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent-4\"
		        aria-controls=\"navbarSupportedContent-4\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		        <span class=\"navbar-toggler-icon\"></span>
		      </button>
		      <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent-4\">
		        <ul class=\"navbar-nav ml-auto links\">
		          <li class=\"nav-item\">
		            <a class=\"nav-link\" href=\"jobs.php\">Jobs<span class=\"sr-only\">(current)</span></a>
		          </li>
		          <li class=\"nav-item\">
		            <a class=\"nav-link\" href=\"scholarships.php\">Scholarships</a>
		          </li>
		          <li class=\"nav-item\">
		            <a class=\"nav-link\" href=\"individuals.php\">Individuals</a>
		          </li>
		          <li class=\"nav-item\">
		            <a class=\"nav-link\" href=\"\">About</a>
		          </li>
		          <li class=\"nav-item\">
		            <a class=\"nav-link\" href=\"contact.php\">Contact</a>
		          </li>
		        </ul>";

		        if(!isset($_SESSION['user'])) {
		        	echo "<ul class=\"navbar-nav ml-auto\">
		        		<li class=\"nav-item sign-in-btn\">
		            		<a class=\"nav-link\" href=\"login.php\"><i class=\"fa fa-user\"></i> Sign In</a>
		        		</li>
		        	</ul>";
		        }

		        if(isset($_SESSION['user'])) {
		        	echo "<ul class=\"navbar-nav ml-auto\">
		        		<li class=\"nav-item dropdown\">
					        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
					          <img src=\"upload/avatars/{$_SESSION['user']['avatar']}\" width=\"45\" height=\"45\" class=\"rounded-circle profile-circle\">
					        </a>
					        <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
					          <a class=\"dropdown-item\" href=\"profile.php?id={$_SESSION['user']['id']}\">Profile</a>";
					          if($_SESSION['user']['type']==1 OR $_SESSION['user']['type']==2) echo "<a class=\"dropdown-item\" href=\"demandes.php\">Demandes</a>";
					          else echo "<a class=\"dropdown-item\" href=\"favoris.php\">Favorites</a>";
					          echo "
					          <a class=\"dropdown-item\" href=\"?decon=1\">Log Out</a>
					        </div>
				        </li>   
		        	</ul>";
		        }
		        
		        echo "
		      </div>
		    </div>
		  </nav>
		<!-- End Navbar -->
		";
	}
?>
