<?php
	include "resources/header.php";

	if(isset($_SESSION['user']) AND $_SESSION['user']['type'] != 0) {
		$userID = $_SESSION['user']['id'];

		if($_SESSION['user']['type'] == 1) {

			//Afficher les applicants au Job
			if(isset($_GET['idjob'])) {
				$request = mysqli_query($cnx,"SELECT * FROM applications INNER JOIN users ON idApplier=users.idUser WHERE idPost = {$_GET['idjob']} AND typePost=0");
			?>
			<div class="featured_candidates_area candidate_page_padding">
        		<div class="container">
            		<div class="row">
                		<div class="col-12">
                  			<h2 style="text-align:center;font-family:'League Spartan',sans-serif;font-size:30px;padding:50px 0;">Liste des applicants au Job :</h2>
                		</div>
                	<?php 
				while($tab = mysqli_fetch_assoc($request)) {
		
					echo "
	                    <div class=\"col-md-6 col-lg-3\">
	                      <div class=\"single_candidates text-center\">
	                          <div class=\"thumb\">
	                              <img src=\"upload/avatars/{$tab['avatar']}\" width=100 height=100>
	                          </div>
	                          <a href=\"profile.php?id={$tab['idUser']}\"><h4>{$tab['nom']} {$tab['prenom']}</h4></a>
	                          <p>{$tab['description']}</p>
	                      </div>
	                    </div>
	                ";
				
				}

				echo "</div>
					</div>
	    		</div>";
			}

			//Afficher les Jobs listés auquels il a été appliqué
			if(!isset($_GET['idjob'])) {
			$SQL = "SELECT * FROM applications INNER JOIN jobs ON idPost=idJob WHERE applications.idUser = $userID AND typePost=0 GROUP BY idPost";
			$req = mysqli_query($cnx,$SQL);



			echo "<div class=\"job_listing_area plus_padding\">
		        <div class=\"container\">
		            <div class=\"row\">
		            	<div class=\"col-12\">
                  			<h2 style=\"text-align:center;font-family:'League Spartan',sans-serif;font-size:30px;padding:50px 0;\">Liste de vos posts : </h2>
                		</div>
		            	<div class=\"col-lg-9\">
							<div class=\"job_lists m-0\">
                       			<div class=\"row\">
            ";

            while($jobs=mysqli_fetch_assoc($req)) {
                $req2 = mysqli_query($cnx,"SELECT * FROM users WHERE idUser=$userID");
                $user = mysqli_fetch_assoc($req2);

                echo "
                    <div class=\"col-lg-12 col-md-12\">
                        <div class=\"single_jobs white-bg d-flex justify-content-between\">
                            <div class=\"jobs_left d-flex align-items-center\">
                                <div class=\"thumb\">
                                    <a href=\"profile.php?id={$user['idUser']}\"><img src=\"upload/avatars/{$user['avatar']}\" width=60 height=60></a>
                                </div>
                                <div class=\"jobs_content\">
                                    <div class=\"listing-type\">
                                      <p><i class=\"fa fa-briefcase\"></i> JOB</p>
                                    </div>
                                    <a href=\"?idjob={$jobs['idJob']}\"><h4>{$jobs['titre']}</h4></a>
                                    <p>{$user['libelle']} | {$jobs['ville']}, {$jobs['pays']}</p>
                                    <div class=\"links_locat d-flex align-items-center\">
                                        <div class=\"enddate\">";
                                        $expireDate = date("d/m/Y",strtotime($jobs['dateFin']));

                                            echo "<p><i class=\"fa fa-clock-o\"></i> Closing date : <span class=\"datefin\">$expireDate</span></p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }


           echo "			</div>
        				</div>
        		</div></div></div></div>";

    		}	

		}

		if($_SESSION['user']['type'] == 2) {

			//Afficher les applicants au Job
			if(isset($_GET['idbourse'])) {
				$request = mysqli_query($cnx,"SELECT * FROM applications INNER JOIN users ON idApplier=users.idUser WHERE idPost = {$_GET['idbourse']} AND typePost=1");
			?>
			<div class="featured_candidates_area candidate_page_padding">
        		<div class="container">
            		<div class="row">
                		<div class="col-12">
                  			<h2 style="text-align:center;font-family:'League Spartan',sans-serif;font-size:30px;padding:50px 0;">Liste des applicants à la Bourse:</h2>
                		</div>
                	<?php 
				while($tab = mysqli_fetch_assoc($request)) {
		
					echo "
	                    <div class=\"col-md-6 col-lg-3\">
	                      <div class=\"single_candidates text-center\">
	                          <div class=\"thumb\">
	                              <img src=\"upload/avatars/{$tab['avatar']}\" width=100 height=100>
	                          </div>
	                          <a href=\"profile.php?id={$tab['idUser']}\"><h4>{$tab['nom']} {$tab['prenom']}</h4></a>
	                          <p>{$tab['description']}</p>
	                      </div>
	                    </div>
	                ";
				
				}

				echo "</div>
					</div>
	    		</div>";
			}

			//Afficher les Jobs listés auquels il a été appliqué
			if(!isset($_GET['idbourse'])) {
				$SQL = "SELECT * FROM applications INNER JOIN scholarships ON idPost=idBourse WHERE scholarships.idUser = $userID AND typePost=1 GROUP BY idPost";
				$req = mysqli_query($cnx,$SQL);

				if(mysqli_num_rows($req)==0) {
					echo "<div style=\"padding:80px;\">
							<h1 class=\"text-center\" style=\"padding:30px;margin-bottom:50px;\">We couldn't find any application to your posts !</h1>
							<center><a href=\"index.php\" class=\"btn btn-primary\"><i class=\"fa fa-home\"></i> Home </a></center>
					</div>
					";
				}



			echo "<div class=\"job_listing_area plus_padding\">
		        <div class=\"container\">
		            <div class=\"row\">
		            	<div class=\"col-12\">
                  			<h2 style=\"text-align:center;font-family:'League Spartan',sans-serif;font-size:30px;padding:50px 0;\">Liste de vos posts : </h2>
                		</div>
		            	<div class=\"col-lg-9\">
							<div class=\"job_lists m-0\">
                       			<div class=\"row\">
            ";

            while($bourses=mysqli_fetch_assoc($req)) {
                $req2 = mysqli_query($cnx,"SELECT * FROM users WHERE idUser=$userID");
                $user = mysqli_fetch_assoc($req2);

                echo "
                    <div class=\"col-lg-12 col-md-12\">
                        <div class=\"single_jobs white-bg d-flex justify-content-between\">
                            <div class=\"jobs_left d-flex align-items-center\">
                                <div class=\"thumb\">
                                    <a href=\"profile.php?id={$user['idUser']}\"><img src=\"upload/avatars/{$user['avatar']}\" width=60 height=60></a>
                                </div>
                                <div class=\"jobs_content\">
                                    <div class=\"listing-type\">
                                      <p><i class=\"fa fa-university\"></i> SCHOLARSHIP</p>
                                    </div>
                                    <a href=\"?idbourse={$bourses['idBourse']}\"><h4>{$bourses['titre']}</h4></a>
                                    <p>{$user['libelle']} | {$bourses['ville']}, {$bourses['pays']}</p>
                                    <div class=\"links_locat d-flex align-items-center\">
                                        <div class=\"enddate\">";
                                        $expireDate = date("d/m/Y",strtotime($bourses['dateFin']));

                                            echo "<p><i class=\"fa fa-clock-o\"></i> Closing date : <span class=\"datefin\">$expireDate</span></p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }


           echo "			</div>
        				</div>
        		</div></div></div></div>";

		}
	}

}

	include "resources/footer.php";
?>