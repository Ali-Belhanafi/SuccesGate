<?php
  define("PAGE", "Scholarships");
  include "resources/header.php";

// Save Posts
  if(isset($_GET['save']) AND isset($_GET['idbourse'])) {
    $request = mysqli_query($cnx,"SELECT * FROM favoris WHERE idPost={$_GET['idbourse']} AND typePost=1 AND idUser={$_SESSION['user']['id']}");
    $n = mysqli_num_rows($request);
    if($n == 0)
        @mysqli_query($cnx,"INSERT INTO favoris(idPost,typePost,idUser) VALUES({$_GET['idbourse']},1,{$_SESSION['user']['id']})") OR die("Couldn't Save !");
  }

// Apply for a Post
  if(isset($_GET['apply']) AND isset($_GET['idbourse']) AND isset($_GET['poster'])) {
    $request = mysqli_query($cnx,"SELECT * FROM applications WHERE idPost={$_GET['idbourse']} AND typePost=1 AND idApplier={$_SESSION['user']['id']} AND idUser={$_GET['poster']}") or die("err !!");
    $n = mysqli_num_rows($request);
    if($n == 0)
        @mysqli_query($cnx,"INSERT INTO applications(idPost,typePost,idApplier,idUser) VALUES({$_GET['idbourse']},1,{$_SESSION['user']['id']},{$_GET['poster']})") OR die("Couldn't apply !");
    echo '<script>document.location.replace("http://localhost/successgate/scholarships.php");</script>';
  }

//Search for a post  
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
    $nombreTotalReq = mysqli_query($cnx,"SELECT * FROM scholarships
                                        WHERE (titre  LIKE '%{$keyword}%' OR descriptionBourse LIKE '%{$keyword}%' OR specialite LIKE '%{$keyword}%')
                                        AND (ville LIKE '%{$location}%' OR pays LIKE '%{$location}%')");
    $nombreTotal = mysqli_num_rows($nombreTotalReq);

    $nombre_pages = ceil($nombreTotal/$nombre_par_page);

    if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$nombre_pages) {
    $_GET['page'] = intval($_GET['page']);
    $indice_page = $_GET['page'];
    }
    else $indice_page = 1;

    $depart = ($indice_page-1)*$nombre_par_page;



    $SQL = "SELECT * FROM scholarships
            WHERE (titre  LIKE '%{$keyword}%' OR descriptionBourse LIKE '%{$keyword}%' OR specialite LIKE '%{$keyword}%')
            AND (ville LIKE '%{$location}%' OR pays LIKE '%{$location}%') ORDER BY premium DESC";
    $req = mysqli_query($cnx,$SQL);
    $nbBourses = mysqli_num_rows($req);

?>


<!-- Start Scholarship Listing -->
  <!-- scholarship_listing_area_start  -->
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
                                            <label>Scholarship Type</label>
                                            <select class="wide form-control">
                                                <option value="0">All</option>
                                                <option>Full-Scholarships</option>
                                                <option>Half-Scholarships</option>
                                                <option>Transfer-Scholarships</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Degree Level</label>
                                            <select class="wide form-control">
                                                <option value="0">All</option>
                                                <option value="1">Bac</option>
                                                <option value="2">Bac +2</option>
                                                <option value="3">Bac +3</option>
                                                <option value="4">Bac +5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Field of Studies</label>
                                            <select class="wide form-control">
                                                <option value="0">All</option>
                                                <option value="1">Computer Science</option>
                                                <option value="2">Formal Sciences</option>
                                                <option value="9">Medecine</option>
                                                <option value="10">Engineering and Technology</option>
                                                <option value="3">Natural Sciences</option>
                                                <option value="4">History</option>
                                                <option value="5">Economics</option>
                                                <option value="6">Linguistics</option>
                                                <option value="7">Architecture</option>
                                                <option value="8">Law</option>
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
                                    <h4><span class="jobsfound"><?php echo "$nombreTotal"; ?></span> Scholarships Found</h4>
                                </div>
                                <?php if(isset($_SESSION['user']) AND $_SESSION['user']['type']==2)
                                echo "
                                <div class=\"col-md-6\">
                                    <div class=\"serch_cat d-flex justify-content-end\">
                                      <a class=\"post-listing\" href=\"listing.php?type=1\"><i class=\"fa fa-plus-circle\"></i> Post a Scholarship</a>
                                    </div>
                                </div>
                                "; ?>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">
                    <?php 
                        while($bourses=mysqli_fetch_assoc($req)) {
                                    $userID = $bourses['idUser'];
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
                                                        <a href=\"scholarship_details.php?id={$bourses['idBourse']}\"><h4>{$bourses['titre']}</h4></a>
                                                        <p>{$user['libelle']} | {$bourses['ville']}, {$bourses['pays']}</p>
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
                                                      ";
                                                    if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0 ) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"?apply&idbourse={$bourses['idBourse']}&poster=$userID\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"login.php\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }

                                                    if(isset($_SESSION['user'])  AND $_SESSION['user']['type']==0 ) {
                                                        echo "<div class=\"save\">
                                                                <a href=\"?save&idbourse={$bourses['idBourse']}\"><i class=\"fa fa-heart\"></i> Save</a>
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
  <!-- scholarship_listing_area_end  -->
<!-- End Scholarship Listing -->




<?php 
    // End of 'if isset $_POST[find]'
    }

    // Start Listing Scholarships

    if(!isset($_POST['find'])) {

        $nombre_par_page = 8;
        $nombreTotalReq = mysqli_query($cnx,"SELECT * FROM scholarships");
        $nombreTotal = mysqli_num_rows($nombreTotalReq);

        $nombre_pages = ceil($nombreTotal/$nombre_par_page);

        if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$nombre_pages) {
        $_GET['page'] = intval($_GET['page']);
        $indice_page = $_GET['page'];
        }
        else $indice_page = 1;

        $depart = ($indice_page-1)*$nombre_par_page;


        $request = mysqli_query($cnx,"SELECT * FROM scholarships ORDER BY premium DESC LIMIT $depart,$nombre_par_page");
    
?>

<!-- Start Scholarship Listing -->
  <!-- scholarship_listing_area_start  -->
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
                                            <label>Scholarship Type</label>
                                            <select class="wide form-control">
                                                <option value="0">All</option>
                                                <option value="1">Full-Scholarships</option>
                                                <option value="2">Half-Scholarships</option>
                                                <option value="3">Transfer-Scholarships</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Degree Level</label>
                                            <select class="wide form-control">
                                                <option value="0">All</option>
                                                <option value="1">Bac</option>
                                                <option value="2">Bac +2</option>
                                                <option value="3">Bac +3</option>
                                                <option value="4">Bac +5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Field of Studies</label>
                                            <select class="wide form-control">
                                                <option value="0">All</option>
                                                <option value="1">Computer Science</option>
                                                <option value="2">Formal Sciences</option>
                                                <option value="3">Natural Sciences</option>
                                                <option value="4">History</option>
                                                <option value="5">Economics</option>
                                                <option value="6">Linguistics</option>
                                                <option value="7">Architecture</option>
                                                <option value="8">Law</option>
                                                <option value="9">Medicine</option>
                                                <option value="10">Engineering and Technology</option>
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
                                    <h4><span class="jobsfound"><?php echo "$nombreTotal"; ?></span> Scholarships Found</h4>
                                </div>
                                <?php if(isset($_SESSION['user']) AND $_SESSION['user']['type']==2)
                                echo "
                                <div class=\"col-md-6\">
                                    <div class=\"serch_cat d-flex justify-content-end\">
                                      <a class=\"post-listing\" href=\"listing.php?type=1\"><i class=\"fa fa-plus-circle\"></i> Post a Scholarship</a>
                                    </div>
                                </div>
                                "; ?>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">
                    <?php 
                        while($bourses=mysqli_fetch_assoc($request)) {
                                    $userID = $bourses['idUser'];
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
                                                        <a href=\"scholarship_details.php?id={$bourses['idBourse']}\"><h4>{$bourses['titre']}</h4></a>
                                                        <p>{$user['libelle']} | {$bourses['ville']}, {$bourses['pays']}</p>
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
                                                      ";
                                                    if(isset($_SESSION['user'])  AND $_SESSION['user']['type']==0 ) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"?apply&idbourse={$bourses['idBourse']}&poster=$userID\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }
                                                    if(!isset($_SESSION['user'])) {
                                                        echo "<div class=\"apply\">
                                                                <a href=\"login.php\"><i class=\"fa fa-pencil-square\"></i> Apply</a>
                                                            </div>
                                                      ";
                                                    }

                                                    if(isset($_SESSION['user']) AND $_SESSION['user']['type']==0 ) {
                                                        echo "<div class=\"save\">
                                                                <a href=\"?save&idbourse={$bourses['idBourse']}\"><i class=\"fa fa-heart\"></i> Save</a>
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
  <!-- scholarship_listing_area_end  -->
<!-- End Scholarship Listing -->


<?php
}

include "resources/footer.php";
?>