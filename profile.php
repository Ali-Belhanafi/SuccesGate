<?php
  define("PAGE", "Profile");
  include "resources/header.php";

  if(isset($_GET['id'])) { 
        $req = mysqli_query($cnx,"SELECT * FROM users WHERE idUser={$_GET['id']}");
        while($mb = mysqli_fetch_assoc($req)) {

?>

<div class="container emp-profile" style="margin-top:80px;box-shadow:0 0 30px #2070e030;padding:50px;">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img class="rounded-circle" <?= "src=\"upload/avatars/{$mb['avatar']}\""; ?> width=120 height=120>
                        </div>
                    </div>
                    <div class="col-md-6" style="margin-top:50px;">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                                </li>
                            </ul>
                    </div>
                    <div class="col-md-2 editProfile">
                        <?php if(isset($_SESSION['user']) AND $_SESSION['user']['id']===$_GET['id']) echo "<a href=\"\" class=\"btn btn-outline-primary\">Edit Profile</a>";?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        
                    </div>
                    <div class="col-md-8" style="margin-top:-30px;">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            		<?php if($mb['type']==0) { ?>
                            			<div class="row">
                                            <div class="col-md-4">
                                                <label>Full Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?= "{$mb['nom']} {$mb['prenom']}"; ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?= "{$mb['email']}"; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Ville</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?= "{$mb['ville']}"; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Pays</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p><?= "{$mb['pays']}"; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Téléphone</label>
                                            </div>
                                            <div class="col-md-8">
                                                <p>0<?= $mb['telephone'] ?></p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
	                                <div class="col-md-3">
	                                    <label>Bio</label>
	                                </div>
	                                <div class="col-md-9">
	                                    <p><?= $mb['description'] ?></p>
	                                </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
        <div style="padding-bottom: 50px;"></div>
<?php
	}
}

	include "resources/footer.php";
?>