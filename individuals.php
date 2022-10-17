<?php
  define("PAGE", "Individuals");
  include "resources/header.php";
?>


<!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                  <h2 style="text-align:center;font-family:'League Spartan',sans-serif;font-size:30px;padding:50px 0;">Individuals :</h2>
                </div>

                <?php

                  $nombre_par_page = 8;
                  $nombreTotalReq = mysqli_query($cnx,"SELECT * FROM users WHERE type=0");
                  $nombreTotal = mysqli_num_rows($nombreTotalReq);

                  $nombre_pages = ceil($nombreTotal/$nombre_par_page);

                  if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0 AND $_GET['page']<=$nombre_pages) {
                    $_GET['page'] = intval($_GET['page']);
                    $indice_page = $_GET['page'];
                  }
                  else $indice_page = 1;

                  $depart = ($indice_page-1)*$nombre_par_page;

                  $req = mysqli_query($cnx,"SELECT * FROM users WHERE type=0 LIMIT $depart,$nombre_par_page");

                  while ($tab = mysqli_fetch_assoc($req)) {
                    echo "
                    <div class=\"col-md-6 col-lg-3\">
                      <div class=\"single_candidates text-center\">
                          <div class=\"thumb\">
                              <img src=\"upload/avatars/{$tab['avatar']}\" width=100 height=100>
                          </div>
                          <a href=\"profile.php?id={$tab['idUser']}\"><h4>{$tab['nom']} {$tab['prenom']}</h4></a>
                          <p>{$tab['description']}</p>
                      </div>
                    </div>";
                  }
                ?>
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination_wrap">
                        <ul>
                            <li><a href=""><i class="fa fa-chevron-left"></i> </a></li>
                            <?php 
                              for ($i=1; $i <= $nombre_pages; $i++) { 
                                if($i == $indice_page) echo "<li><a href=\"?page=$i\" class=\"activePage\"><span>$i</span></a></li>";
                                else echo "<li><a href=\"?page=$i\"><span>$i</span></a></li>";
                              }
                              
                            ?>
                            <li><a href=""> <i class="fa fa-chevron-right"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->


<?php
  echo intval("kjsYTFGIQUKLSFQILSFS");
  include "resources/footer.php";
?>