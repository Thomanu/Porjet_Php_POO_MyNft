<?php 

include_once '../helpers/session.php';
include_once 'database.php';

	class User extends Database{
	
        public function __construct()
        {
            parent::__construct();
        }

		public function userregistration($data){
			$name     = $data['name'];
			$username = $data['username'];
			$email    = $data['email'];
			$pass     = $data['password'];
			$password = md5($pass);
			$chk_mail = $this->emailcheck($email);

// Conditions de sécurtités permettant a l'utilisateur de créer un compte sous certaines conditions
			if ($name == "" OR $username == "" OR $email == "" OR $password =="") {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Les dossiers ne doivent pas être vides</div>";
				return $msg;
			}

			if (strlen($username) < 3) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Nom d'utilisateur trop court</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Le nom d'utilisateur doit contenir des caractères alphanumériques, des traits de soulignement et des tirets.</div>";
				return $msg;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>L'adresse e-mail n'est pas valide</div>";
				return $msg;
			}
			if (strlen($pass) < 5) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Le mot de passe doit avoir au moins 5 caracteres</div>";
				return $msg;
			}

			if ($chk_mail == true){
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>L'adresse e-mail existe déjà</div>";
				return $msg;
			}
// 
			$sql = 'INSERT INTO tbl_user(name,username,email,password) VALUES(:name,:username,:email,:password)';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':name', $name);
			$query->bindValue(':username', $username);
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$result = $query->execute();

			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Succès ! </strong>Merci, vous avez été enregistré</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Désolé, il y a un problème pour insérer des données</div>";
				return $msg;
			}
		}

		public function emailcheck($email){
			$sql = 'SELECT email from tbl_user WHERE email=:email';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':email', $email);
			$query->execute();
			if ($query->rowCount()> 0 ) {
				return true;
			}else{
				return false;
			}
		}
//  Ici on recupère les données de login de l'utilisateur 
		public function getloginuser($email,$password){
			$sql = 'SELECT * from tbl_user WHERE email=:email AND password=:password LIMIT 1';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':email', $email);
			$query->bindValue(':password', $password);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
// les données sont annalysées et retournent un message pour specifier si le login est accepté
		public function userlogin($data){
			$email    = $data['email'];
			$pass     = $data['password'];
			$password = md5($pass);
			$chk_mail = $this->emailcheck($email);

			if ($email == "" OR $password =="") {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Les dossiers ne doivent pas être vides</div>";
				return $msg;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>L'adresse e-mail n'est pas valide</div>";
				return $msg;
			}
			if ($chk_mail == false){
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>L'adresse e-mail n'existe pas</div>";
				return $msg;
			}

			$result = $this->getloginuser($email,$password);
			if ($result) {
				Session::init();
				Session::set("login", true);
				Session::set("id", $result->id);
				Session::set("name", $result->name);
				Session::set("username", $result->username);
				Session::set("loginmsg", "<div class='alert alert-success'><strong>Succès ! </strong>Vous etes connectés</div>");
				header("Location: index.php");
			}else{
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Données introuvables</div>";
				return $msg;
			}

		}
		public function getuserdata(){
			$sql = 'SELECT * from tbl_user ORDER BY id DESC';
			$query = $this->conn->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			return $result;
		}

		public function getuserbyid($userid){
			$sql = 'SELECT * from tbl_user WHERE id =:id LIMIT 1';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':id', $userid);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		public function updateuser($id,$data){
			$name     = $data['name'];
			$username = $data['username'];
			$email    = $data['email'];
			
// Permet de de sécuriser l'update de profil via des conditons permettant ou non d'accepter l'update
			if ($name == "" OR $username == "" OR $email == "") {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Les dossiers ne doivent pas être vides</div>";
				return $msg;
			}

			if (strlen($username) < 3) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Le nom d'utilisateur est trop court</div>";
				return $msg;
			}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Le nom d'utilisateur doit contenir des caractères alphanumériques, des traits de soulignement et des tirets.</div>";
				return $msg;
			}

			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>L'adresse e-mail n'est pas valide</div>";
				return $msg;
			}

			$sql = 'UPDATE tbl_user set name=:name,username=:username,email=:email WHERE id=:id';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':name', $name);
			$query->bindValue(':username', $username);
			$query->bindValue(':email', $email);
			$query->bindValue(':id', $id);
			$result = $query->execute();

			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Succès ! </strong>Merci, les données utilisateur ont été mises à jour avec succès</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Désolé, il y a un problème avec la mise à jour des données de l'utilisateur.</div>";
				return $msg;
			}
		}
		private function checkpassword($old_pass,$id){
			$password = md5($old_pass);
			$sql = 'SELECT password from tbl_user WHERE id=:id AND password=:password ';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':password', $password);
			$query->execute();
			if ($query->rowCount()> 0 ) {
				return true;
			}else{
				return false;
			}

		}
		public function updatepass($id,$data){

			$old_pass = $data['old_pass'];
			$new_pass = $data['password'];
			$chk_pass = $this->checkpassword($old_pass,$id);
			if ($old_pass == "" OR $new_pass == "") {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Les dossiers ne doivent pas être vides</div>";
				return $msg;
			}

			if ($chk_pass == false) {
			$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>L'ancien mot de passe ne correspond pas</div>";
				return $msg;
			}
			if (strlen($new_pass) < 5) {
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Le nouveau mot de passe doit avoir au moins cinq caractères</div>";
				return $msg;
			}

			$password = md5($new_pass);

			$sql = 'UPDATE tbl_user set password=:password WHERE id=:id';
			$query = $this->conn->prepare($sql);
			$query->bindValue(':password', $password);
			$query->bindValue(':id', $id);
			$result = $query->execute();

			if ($result) {
				$msg = "<div class='alert alert-success'><strong>Success ! </strong>Merci, le mot de passe a été mis à jour avec succès</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong>Erreur ! </strong>Désolé la mise à jour de mot de passe a echouée</div>";
				return $msg;
			}
		}
		public function delete($id){
			$sql = "DELETE FROM tbl_user WHERE id=:id";
			$query = $this->conn->prepare($sql);
			$query->bindParam(':id',$id);
			return $query->execute();
		}
		
	}
?>