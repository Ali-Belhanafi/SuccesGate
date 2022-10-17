<?php
  define("PAGE", "Accueil");
  include "resources/header.php";
?>

<!-- Start Header -->
  <div class="header">
      <div class="bg">
        <img src="assets/img/cover.png" width=100%>
      </div>
      <div class="search">
        <div class="container">
          <p>Your future career depends on your daily decisions. Start here :</p>
          <form id="searching" action="jobs.php">
            <select class="form-control" name="search" id="search" onchange="changeAction()">
              <option value="jobs.php">Jobs</option>
              <option value="scholarships.php">Scholarships</option>
            </select>
            <input type="text" name="keyword" class="form-control" placeholder="Search by keyword, skill, or interest...">
            <input type="text" name="location" class="form-control" placeholder="Everywhere">

            <button type="submit" name="find" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
          </form>
        </div>
      </div>
  </div>
<!-- End Header -->

<!-- Start Join-us -->
  <div class="join-us">
    <h3 class="text-center">Join Us</h3>
    <p class="text-center">We want to help  build a world where all people can lead free and dignified lives.</p>
    <div class="fields">
    <section>
      <div class="container">
		    <div class="row">
          <div class="col-lg-12">
            <div>
              <div>
                  <h2><i class="fa fa-university"></i> Schools/Universities</h2>
                  <p>Open space to schools and universities
                  so that they can be able to share their scholarships and offers.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
		    <div class="row">
          <div class="col-lg-12">
            <div>
              <div>
                  <h2><i class="fa fa-briefcase"></i> Organisations</h2>
                  <p>Open space to companies so as to allow them
                  to share their job/intership offers.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
		    <div class="row">
          <div class="col-lg-12">
            <div>
              <div>
                  <h2><i class="fa fa-graduation-cap"></i> Students/Trainees</span></h2>
                  <p>Open space to Students where they can share
                  their skills, CVs, as well as their interests.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
    <div class="vector align-self-center">
      <img src="assets/img/join.png" width=535 height=400>
    </div>
  </div>
<!-- End Join-us -->

<!-- Start News -->
  <div class="news">
      <div class="job-offers">
        <div class="top">
          <h3>INTERNSHIPS AND JOB OPPORTUNITIES :</h3>
          <a href="jobs.php"><button class="seemore">See More <i class="fa fa-arrow-right"></i></button></a>
        </div>

        <div class="container">
          <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner row w-100 mx-auto">

              <?php  

            	$requete = mysqli_query($cnx,"SELECT * FROM jobs WHERE premium=1");
            	$active = "active";
            	while ($row1 = mysqli_fetch_assoc($requete)) {
            		$userID = $row1['idUser'];
            		$user = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT * FROM users WHERE idUser = $userID"));
            		$expireDate = date("d/m/Y",strtotime($row1['dateFin']));
            		echo "
            		<div class=\"carousel-item col-md-4 $active\">
		                <div class=\"card\">
							<a href=\"job_details.php?id=".$row1['idJob']."\"><img class=\"card-img-top img-fluid\" src=\"upload/img/{$row1['pic']}\"></a>
							<div class=\"card-body\">
							<div class=\"row\">
								<div class=\"poster-logo col-sm-2\"><img class=\"rounded-circle\" src=\"upload/avatars/{$user['avatar']}\" width=35></div>
								<div class=\"poster-label col-sm-8\"><a href=\"job_details.php?id=".$row1['idJob']."\"><h5>{$user['libelle']}</h5></a></div>
								<div class=\"add-fav col-sm-2\"><a href=\"\"><i class=\"fa fa-heart-o\" id=\"heart\"></i></a></div>
							</div>
							<p class=\"card-text\">{$row1['titre']}</p>
							<hr>
							<p class=\"card-text\"><small class=\"text-muted\">Closing : <span class=\"closing-date\">$expireDate</span></small></p>
							</div>
		                </div>
		            </div>";
		            $active = "";
            	}
              
            ?>

            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
              <span class="arrow fa fa-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
              <span class="arrow fa fa-chevron-right" aria-hidden="true"></span>
            </a>
          </div>
        </div>

      </div>

      <div class="scholarship-offers">
        <div class="top">
          <h3>NEWEST SCHOLARSHIP OPPORTUNITIES :</h3>
          <a href="scholarships.php"><button class="seemore">See More <i class="fa fa-arrow-right"></i></button></a>
        </div>

        <div class="container">
          <div id="myCarousel2" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner row w-100 mx-auto">
              
            <?php  

            	$requete = mysqli_query($cnx,"SELECT * FROM scholarships WHERE premium=1");
            	$active = "active";
            	while ($row2 = mysqli_fetch_assoc($requete)) {
            		$userID = $row2['idUser'];
            		$user = mysqli_fetch_assoc(mysqli_query($cnx,"SELECT * FROM users WHERE idUser = $userID"));
            		$expireDate = date("d/m/Y",strtotime($row2['dateFin']));
            		echo "
            		<div class=\"carousel-item col-md-4 $active\">
		                <div class=\"card\">
							<a href=\"job_details.php?id=".$row2['idBourse']."\"><img class=\"card-img-top img-fluid\" src=\"upload/img/{$row2['pic']}\"></a>
							<div class=\"card-body\">
							<div class=\"row\">
								<div class=\"poster-logo col-sm-2\"><img class=\"rounded-circle\" src=\"upload/avatars/{$user['avatar']}\" width=35></div>
								<div class=\"poster-label col-sm-8\"><a href=\"scholarship_details.php?id=".$row2['idBourse']."\"><h5>{$user['libelle']}</h5></a></div>
								<div class=\"add-fav col-sm-2\"><a href=\"\"><i class=\"fa fa-heart-o\" id=\"heart\"></i></a></div>
							</div>
							<p class=\"card-text\">{$row2['titre']}</p>
							<hr>
							<p class=\"card-text\"><small class=\"text-muted\">Closing : <span class=\"closing-date\">$expireDate</span></small></p>
							</div>
		                </div>
		            </div>";
		            $active = "";
            	}
              
            ?>

            </div>
            <a class="carousel-control-prev" href="#myCarousel2" role="button" data-slide="prev">
              <span class="arrow fa fa-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel2" role="button" data-slide="next">
              <span class="arrow fa fa-chevron-right" aria-hidden="true"></span>
            </a>
          </div>
        </div>

      </div>

  </div>
<!-- End News -->

<!-- Start Sponsors -->
  <div class="sponsors">
    <h3 class="text-center">Our Sponsors</h3>
    <div class="row align-items-center text-center">
      <div class="sp-icon col-2">
        <img src="assets/img/sp1.png" width=80>
      </div>
      <div class="sp-icon col-2">
        <img src="assets/img/sp2.png" width=80>
      </div>
      <div class="sp-icon col-2">
        <img src="assets/img/sp3.png" width=80>
      </div>
      <div class="sp-icon col-2">
        <img src="assets/img/sp4.png" width=80>
      </div>
      <div class="sp-icon col-2">
        <img src="assets/img/sp5.png" width=80>
      </div>
    </div>
  </div>
<!-- End Sponsors -->


<?php include "resources/footer.php"; ?>