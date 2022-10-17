<?php
  define("PAGE", "Jobs");
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

  if(isset($_POST['find'])) {
    if(!empty($_POST['keyword']))
        $keyword = $_POST['keyword'];
    else 
        $keyword = "";
    if(!empty($_POST['location']))
        $location = $_POST['location'];
    else
        $location = "";


    $nombre_par_page = 8;
    $nombreTotalReq = mysqli_query($cnx,"SELECT * FROM jobs
                                        WHERE (titre  LIKE '%{$keyword}%' OR descriptionJob LIKE '%{$keyword}%' OR domaine LIKE '%{$keyword}%')
                                        AND (ville LIKE '%{$location}%' OR pays LIKE '%{$location}%')");
    $nombreTotal = mysqli_num_rows($nombreTotalReq);

    $nombre_pages = ceil($nombreTotal/$nombre_par_page);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$nombre_pages) {
    $_GET['page'] = intval($_GET['page']);
    $indice_page = $_GET['page'];
    }
    else $indice_page = 1;

    $depart = ($indice_page-1)*$nombre_par_page;

    $SQL = "SELECT * FROM jobs
            WHERE (titre  LIKE '%{$keyword}%' OR descriptionJob LIKE '%{$keyword}%' OR domaine LIKE '%{$keyword}%')
            AND (ville LIKE '%{$location}%' OR pays LIKE '%{$location}%') ORDER BY premium DESC LIMIT $depart,$nombre_par_page";
    $req = mysqli_query($cnx,$SQL);
    $nbJobs = mysqli_num_rows($req);

?>

<!-- Start Job Listing -->
  <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Filters</h3>
                            <form method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Sort by</label>
                                            <select class="wide form-control">
                                                <option value="1">Relevance</option>
                                                <option value="2">Closing Date</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Job Type</label>
                                            <select class="wide form-control">
                                                <option value="1">Full-Time</option>
                                                <option value="2">Part-Time</option>
                                                <option value="3">Remote-Work</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Industry</label>
                                            <select class="wide form-control">
                                                <option value="1">All</option>
                                                <option value="2">Design</option>
                                                <option value="3">Informatique</option>
                                                <option value="4">Comptabilité</option>
                                                <option value="5">Gestion</option>
                                                <option value="6">Commerce</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4><span class="jobsfound"><?php echo "$nombreTotal"; ?></span> Jobs Found</h4>
                                </div>

                                <?php if(isset($_SESSION['user']) AND $_SESSION['user']['type']==1)
                                echo "
                                <div class=\"col-md-6\">
                                    <div class=\"serch_cat d-flex justify-content-end\">
                                      <a class=\"post-listing\" href=\"listing.php?type=0\"><i class=\"fa fa-plus-circle\"></i> Post a Job</a>
                                    </div>
                                </div>
                                "; ?>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">

                            <?php

                                while($jobs=mysqli_fetch_assoc($req)) {
                                    $userID = $jobs['idUser'];
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
                                                        <a href=\"job_details.php?id={$jobs['idJob']}\"><h4>{$jobs['titre']}</h4></a>
                                                        <p>{$user['libelle']} | {$jobs['ville']}, {$jobs['pays']}</p>
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
                                                    if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"?apply&idjob={$jobs['idJob']}&poster=$userID\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"login.php\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }

                                                    if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) {
                                                        echo "<div class=\"save\">
                                                                <a href=\"?save&idjob={$jobs['idJob']}\"><i class=\"fa fa-heart\"></i> Save</a>
                                                            </div>";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"save\">
                                                                <a href=\"login.php\"><i class=\"fa fa-heart\"></i> Save</a>
                                                            </div> ";
                                                    }
                                                        echo " 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }

                            ?>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination_wrap">
                                    <ul>
                                        <li><?php echo "<a href=\"?page=1\">";?> <i class="fa fa-chevron-left"></i> </a></li>
                                        <?php 
                                          for ($i=1; $i <= $nombre_pages; $i++) { 
                                            if($i == $indice_page) echo "<li><a href=\"?page=$i\" class=\"activePage\"><span>$i</span></a></li>";
                                            else echo "<li><a href=\"?page=$i\"><span>$i</span></a></li>";
                                          }
                                        ?>
                                        <li><?php echo "<a href=\"?page=$nombre_pages\">";?> <i class="fa fa-chevron-right"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- job_listing_area_end  -->
<!-- End Job Listing -->

<?php 
    // End of 'if isset $_POST[find]'
    }

    // Start Listing Jobs

    if(!isset($_POST['find'])) {

        $nombre_par_page = 8;
        $nombreTotalReq = mysqli_query($cnx,"SELECT * FROM jobs");
        $nombreTotal = mysqli_num_rows($nombreTotalReq);

        $nombre_pages = ceil($nombreTotal/$nombre_par_page);

        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$nombre_pages) {
        $_GET['page'] = intval($_GET['page']);
        $indice_page = $_GET['page'];
        }
        else $indice_page = 1;

        $depart = ($indice_page-1)*$nombre_par_page;


        $request = mysqli_query($cnx,"SELECT * FROM jobs ORDER BY premium DESC LIMIT $depart,$nombre_par_page");
    
?>

<!-- Start Job Listing -->
  <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Filters</h3>
                            <form method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Sort by</label>
                                            <select class="wide form-control">
                                                <option value="1">Relevance</option>
                                                <option value="2">Closing Date</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Job Type</label>
                                            <select class="wide form-control">
                                                <option value="1">Full-Time</option>
                                                <option value="2">Part-Time</option>
                                                <option value="3">Remote-Work</option>
                                                <option value="4">Internship</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Industry</label>
                                            <select class="wide form-control">
                                                <option value="1">All</option>
                                                <option value="2">Design</option>
                                                <option value="3">Informatique</option>
                                                <option value="4">Comptabilité</option>
                                                <option value="5">Gestion</option>
                                                <option value="6">Commerce</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4><span class="jobsfound"><?php echo "$nombreTotal"; ?></span> Jobs Found</h4>
                                </div>

                                <?php if(isset($_SESSION['user']) AND $_SESSION['user']['type']==1)
                                echo "
                                <div class=\"col-md-6\">
                                    <div class=\"serch_cat d-flex justify-content-end\">
                                      <a class=\"post-listing\" href=\"listing.php?type=0\"><i class=\"fa fa-plus-circle\"></i> Post a Job</a>
                                    </div>
                                </div>
                                "; ?>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">

                            <?php

                                while($jobs=mysqli_fetch_assoc($request)) {
                                    $userID = $jobs['idUser'];
                                    $request2 = mysqli_query($cnx,"SELECT * FROM users WHERE idUser=$userID");
                                    $user = mysqli_fetch_assoc($request2);

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
                                                        <a href=\"job_details.php?id={$jobs['idJob']}\"><h4>{$jobs['titre']}</h4></a>
                                                        <p>{$user['libelle']} | {$jobs['ville']}, {$jobs['pays']}</p>
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
                                                    if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"?apply&idjob={$jobs['idJob']}&poster=$userID\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"login.php\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }

                                                    if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0) {
                                                        echo "<div class=\"save\">
                                                                <a href=\"?save&idjob={$jobs['idJob']}\"><i class=\"fa fa-heart\"></i> Save</a>
                                                            </div>";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"save\">
                                                                <a href=\"login.php\"><i class=\"fa fa-heart\"></i> Save</a>
                                                            </div> ";
                                                    }
                                                        echo "
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }

                            ?>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination_wrap">
                                    <ul>
                                        <li><?php  echo "<a href=\"?page=1\">";?> <i class="fa fa-chevron-left"></i> </a></li>
                                        <?php 
                                          for ($i=1; $i <= $nombre_pages; $i++) { 
                                            if($i == $indice_page) echo "<li><a href=\"jobs.php?page=$i\" class=\"activePage\"><span>$i</span></a></li>";
                                            else echo "<li><a href=\"jobs.php?page=$i\"><span>$i</span></a></li>";
                                          }
                                        ?>
                                        <li><?php  echo "<a href=\"?page=$nombre_pages\">";?> <i class="fa fa-chevron-right"></i> </a></li>
                                    </ul>
                                </div>
                            </div>
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

include "resources/footer.php"
?>