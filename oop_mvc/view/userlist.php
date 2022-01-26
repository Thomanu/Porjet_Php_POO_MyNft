<?php 
$href = "../assets/css/userlist.css";
	include 'header.php';
	include '../models/user_model.php';
	
	Session::checksession();
	$user = new User();
?>

	<section class="panel panel-default">
		<div class="container">
			<div class="panel-heading">
				<?php
					$loginmsg = Session::get("loginmsg");
					if (isset($loginmsg)) {
						echo $loginmsg;
					}
					Session::set("loginmsg", NULL);
				?>
				<h2> <span class="float-right">Bienvenue ! <strong>
					<?php 
					$name = Session::get("username"); 
					if (isset($name)) {
						echo $name;
					}
					?>	
					</strong></span></h2>
			</div>
		<div class="panel-body">
			<div class="row">
				<table class="table">
					<tr>
						<th>Id</th>
						<th>Nom de la personne</th>
						<th>Nom d'utilisateur</th>
						<th>Adresse e-mail</th>
						<th>Action</th>
					</tr>
					<?php 
					$user = new User();
					$userdata = $user->getuserdata();
					if ($userdata) {
						$i =0;
						foreach ($userdata as $data) {
							$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $data['name']; ?></td>
						<td><?php echo $data['username']; ?></td>
						<td><?php echo $data['email']; ?></td>
						<td><a class="btn" href="profile.php?id=<?php echo $data['id']; ?>">Voir</a></td>
					</tr>
					<?php 	}
					}else{?>
					<tr>
						<td colspan="5"><h3>Données introuvables</h3></td>
					</tr>
					<?php }?>
				</table>
			</div>
		</div>
		</div>
	</section>

	<?php
    require_once "footer.php";
	?>
