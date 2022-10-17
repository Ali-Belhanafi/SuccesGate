<?php
	include "resources/header.php";

	if(isset($_POST['contact'])) {
		@mysqli_query($cnx,"INSERT INTO contact VALUES(NULL,'{$_POST['name']}','{$_POST['email']}','{$_POST['msg']}')") OR die("ERREUR D'ENVOI !");
	}
?>

<div class="contact-clean">
    <form method="post">
        <h2 class="text-center">Contact us</h2>
        <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name" required></div>
        <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required><small class="form-text text-primary">Please enter a correct email address.</small></div>
        <div class="form-group"><textarea class="form-control" rows="14" name="msg" placeholder="Message" required></textarea></div>
        <div class="form-group"><button class="btn btn-primary" type="submit" name="contact">send </button></div>
    </form>
</div>

<?php include "resources/footer.php" ?>