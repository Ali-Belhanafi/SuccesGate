<?php
  define("PAGE", "jobDetails");
  include "resources/header.php";
   if(isset($_GET['save']) AND isset($_GET['idjob'])) {
            $request = mysqli_query($cnx,"SELECT * FROM favoris WHERE idPost={$_GET['idjob']} AND typePost=0 AND idUser={$_SESSION['user']['id']}");
            $n = mysqli_num_rows($request);
            if($n == 0)
                @mysqli_query($cnx,"INSERT INTO favoris(idPost,typePost,idUser) VALUES({$_GET['idjob']},0,{$_SESSION['user']['id']})") OR die("Couldn't Save !");
        } 

    if(isset($_GET['apply']) AND isset($_GET['idjob']) AND isset($_GET['poster'])) {
    $request = mysqli_query($cnx,"SELECT * FROM applications WHERE idPost={$_GET['idjob']} AND typePost=0 AND idApplier={$_SESSION['user']['id']} AND idUser={$_GET['poster']}");
    $n = mysqli_num_rows($request);
    if($n == 0)
        @mysqli_query($cnx,"INSERT INTO applications(idPost,typePost,idApplier,idUser) VALUES({$_GET['idjob']},0,{$_SESSION['user']['id']},{$_GET['poster']})") OR die("Couldn't Apply !");
    echo '<script>document.location.replace("http://localhost/successgate/jobs.php");</script>';
  }
    
  if(isset($_GET['id'])) {

        $jobID = $_GET['id'];

              


        $req = mysqli_query($cnx,"SELECT * FROM jobs WHERE idJob = $jobID");
        $tab = mysqli_fetch_assoc($req);
        $userID = $tab['idUser'];
        $req2 = mysqli_query($cnx,"SELECT * FROM users WHERE idUser = $userID");
        $tab2 = mysqli_fetch_assoc($req2);
  
?>

<!-- Start Job Details -->

<div class="job_details_area">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <?php echo "<img src=\"upload/avatars/{$tab2['avatar']}\" width=60 height=60>"; ?>
                                </div>
                                <div class="jobs_content">
                                    <h4><?php echo $tab['titre'] ; ?></h4>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i><?php echo $tab['ville'].",". $tab['pays'];?></p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> <?= $tab['typeJob'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <?php 
                                if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) {
                                    echo "<div class=\"apply_now\">
                                            <a class=\"apply_mark\" href=\"?apply&idjob=$jobID&poster=$userID\"><i class=\"fa fa-pencil-square\"></i></a>
                                        </div>";
                                }
                                if(!isset($_SESSION['user'])) {
                                    echo "<div class=\"apply_now\">
                                            <a class=\"apply_mark\" href=\"login.php\"><i class=\"fa fa-pencil-square\"></i></a>
                                        </div> ";
                                }
                                
                                if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) {
                                    echo "<div class=\"apply_now\">
                                            <a class=\"heart_mark\" href=\"?save&idjob=$jobID\"><i class=\"fa fa-heart\"></i></a>
                                        </div>";
                                }
                                if(!isset($_SESSION['user'])) {
                                    echo "<div class=\"apply_now\">
                                            <a class=\"heart_mark\" href=\"login.php\"><i class=\"fa fa-heart\"></i></a>
                                        </div> ";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <?= $tab['descriptionJob'] ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="job_summary">
                        <div class="summary_header">
                            <h3>Job Summary</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <?php
                                    $dateCreation = date("d/m/Y",strtotime($tab['dateDebut'])) ;
                                    $expireDate = date("d/m/Y",strtotime($tab['dateFin'])) ;
                                ?>
                                <li>Published on: <span> <?= $dateCreation ?></span></li>
                                <li>Salary: <span><?= $tab['salaire'] ?> Dh</span></li>
                                <li>Location: <span><?= $tab['ville'].",". $tab['pays'] ?></span></li>
                                <li>Job Nature: <span> <?= $tab['typeJob'] ?></span></li>
                                <li>Ends on: <span style="color:#E83E3E;font-weight: bold;"><?= $expireDate ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="share_wrap d-flex">
                        <span>Share at:</span>
                        <ul>
                            <li><a href="#"> <i class="fa fa-facebook"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-linkedin"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-twitter"></i></a> </li>
                            <li><a href="#"> <i class="fa fa-instagram"></i></a> </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

<!-- End Job Details -->



<?php

    }
    else {
        echo '<script>document.location.replace("http://localhost/successgate/index.php");</script>';
    }
  include "resources/footer.php";
?>