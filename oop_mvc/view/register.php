<?php 
$href = "../assets/css/register.css";
	include 'header.php';
	include '../models/user_model.php';
?>
<?php
 $user = new User(); 

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
 	$userregi = $user->userregistration($_POST);
 }
?>
	<section class="panel panel-default">
		<div class="container">
		<div class="panel-heading">
			<h2>Inscription utilisateur</h2>
		</div>
			<div class="panel-body">
				<div class="row">
				<div class="offset-3"></div>
				<div class="col-lg-7">
					<?php 
					if (isset($userregi)) {
						echo $userregi;
					}
					?>
					<form action="" method="POST">
						<div class="form-group">
							<label for="name">Votre nom</label>
							<input type="text" id="name" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" id="username" name="username" class="form-control" >
						</div>
						<div class="form-group">
							<label for="email">Adresse e-mail</label>
							<input type="text" id="email" name="email" class="form-control" >
						</div>
						<div class="form-group">
							<label for="password">Mot de passe</label>
							<input type="password" id="password" name="password" class="form-control">
						</div>
						<button type="submit" name="register" class="btn">Envoyer</button>
						<span class="float-right">Déja inscrit ? <a href="login.php" class="btn">Se connecter</a></span>
					</form>

				</div>
				<div class="offset-2"></div>
			</div>
		</div>
		</div>
	</section>

	<?php
    require_once "footer.php";
	?>
