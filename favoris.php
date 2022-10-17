<?php 
	include "resources/header.php";

	if(isset($_SESSION['user'])) {
		$userID = $_SESSION['user']['id'];

		$req = mysqli_query($cnx,"SELECT * FROM favoris WHERE idUser = $userID AND typePost=0");
?>

<!-- Start Job Listing -->
  <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
        	<h1 class="text-center" style="text-transform: uppercase;padding:20px;font-size:30px;font-family:'League Spartan',sans-serif;">Your Favorite Posts : </h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="job_lists m-0">
                        <div class="row">

                            <?php

                                while($fav1 = mysqli_fetch_assoc($req)) {
									$jobs = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT * FROM jobs WHERE idJob={$fav1['idPost']}"));
									$userPosted = $jobs['idUser'];
									$jobPoster = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT * FROM users WHERE idUser=$userPosted"));

								// List All Saved Jobs

                                    echo "
                                        <div class=\"col-lg-12 col-md-12\">
                                            <div class=\"single_jobs white-bg d-flex justify-content-between\">
                                                <div class=\"jobs_left d-flex align-items-center\">
                                                    <div class=\"thumb\">
                                                        <a href=\"profile.php?id={$jobPoster['idUser']}\"><img src=\"upload/avatars/{$jobPoster['avatar']}\" width=60 height=60></a>
                                                    </div>
                                                    <div class=\"jobs_content\">
                                                        <div class=\"listing-type\">
                                                          <p><i class=\"fa fa-briefcase\"></i> JOB</p>
                                                        </div>
                                                        <a href=\"job_details.php?id={$jobs['idJob']}\"><h4>{$jobs['titre']}</h4></a>
                                                        <p>{$jobPoster['libelle']} | {$jobs['ville']}, {$jobs['pays']}</p>
                                                        <div class=\"links_locat d-flex align-items-center\">
                                                            <div class=\"enddate\">";
                                                            $expireDate = date("d/m/Y",strtotime($jobs['dateFin']));

                                                                echo "<p><i class=\"fa fa-clock-o\"></i> Closing date : <span class=\"datefin\">$expireDate</span></p> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"jobs_right\">
                                                    <div class=\"apply_now\">
                                                    ";
                                                    if(isset($_SESSION['user'])) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"job_details.php?id={$jobs['idJob']}\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"login.php\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }

                                                    echo "
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }

                            ?>

<?php 

	$req2 = mysqli_query($cnx,"SELECT * FROM favoris WHERE idUser = $userID AND typePost=1");
?>


                            <?php

                               while($fav2 = mysqli_fetch_assoc($req2)) {
									$bourses = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT * FROM scholarships WHERE idBourse={$fav2['idPost']}"));
									$userPosted = $bourses['idUser'];
									$boursePoster = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT * FROM users WHERE idUser=$userPosted"));

								// List All Saved Scholarships

                                    echo "
                                        <div class=\"col-lg-12 col-md-12\">
                                            <div class=\"single_jobs white-bg d-flex justify-content-between\">
                                                <div class=\"jobs_left d-flex align-items-center\">
                                                    <div class=\"thumb\">
                                                        <a href=\"profile.php?id={$boursePoster['idUser']}\"><img src=\"upload/avatars/{$boursePoster['avatar']}\" width=60 height=60></a>
                                                    </div>
                                                    <div class=\"jobs_content\">
                                                        <div class=\"listing-type\">
                                                          <p><i class=\"fa fa-university\"></i> SCHOLARSHIP</p>
                                                        </div>
                                                        <a href=\"scholarship_details.php?id={$bourses['idBourse']}\"><h4>{$bourses['titre']}</h4></a>
                                                        <p>{$boursePoster['libelle']} | {$bourses['ville']}, {$bourses['pays']}</p>
                                                        <div class=\"links_locat d-flex align-items-center\">
                                                            <div class=\"enddate\">";
                                                            $expireDate = date("d/m/Y",strtotime($bourses['dateFin']));

                                                                echo "<p><i class=\"fa fa-clock-o\"></i> Closing date : <span class=\"datefin\">$expireDate</span></p> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"jobs_right\">
                                                    <div class=\"apply_now\">
                                                    	<div class=\"apply\">
                                                            <a href=\"scholarship_details.php?id={$bourses['idBourse']}\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- job_listing_area_end  -->
<!-- End Job Listing -->

<?php 

}

include "resources/footer.php";

?>