<?php 
$href = "../assets/css/chngepas.css";
	include '../models/user_model.php';
	include 'header.php';
	Session::checksession();
?>
<?php 
	if (isset($_GET['id'])) {
		$userid = (int)$_GET['id'];
		$sesionid = Session::get("id");
			if ($sesionid != $userid) {
				header("Location:userlist.php");
			}
	}
	$user = new User();
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
 	$updatepass = $user->updatepass($userid,$_POST);
 }
?>
	<section class="panel panel-default">
		<div class="container">
			<div class="panel-heading">
				<h2>Changement de mot de passe<span class="float-right"><a class="btn"href="profile.php?id=<?php echo $userid; ?>">Retour</a></span></h2>
			</div>

			<div class="panel-body">
				<div class="row">
				<div class="offset-3"></div>
				<div class="col-lg-6">

		<?php if (isset($updatepass)) {
			echo $updatepass;
		} ?>
				
					<form action="" method="POST">
						<div class="form-group">
							<label for="old_pass">Ancien mot de pass</label>
							<input type="password" id="old_pass" name="old_pass" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">Nouveau mot de passe</label>
							<input type="password" id="password" name="password" class="form-control">
						</div>
						
						<button type="submit" name="updatepass" class="btn">Mettre à jour</button>
						
					</form>
				
				</div>
				<div class="offset-3"></div>
			</div>
		</div>
		</div>
	</section>

	<?php
    require_once "footer.php";
	?>
