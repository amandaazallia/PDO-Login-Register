<?php
//error_reporting(0);
include 'config.php';

if(!isset($_SESSION['username'] )== 0) {
	header('Location: home.php');
}

if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']."ALS52KAO09");

	try {
		$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
		$stmt = $connect->prepare($sql);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count == 1) {
			$_SESSION['username'] = $username;
			header("Location: home.php");
			return;
		}else{
			echo "<div class='notif'>Silahkan Lengkapi Data !</div>";
		}
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
}

?>

<!-- FORM LOGIN -->
<!DOCTYPE HTML>
<html>
	<head>
			<title>PDO MySQL Log In Register</title>
				<link rel="stylesheet" href="css.css" type="text/css">
	</head>
		<body>
								<div class="content">
									<div class="title">
								Masuk
								</div>
										<form action="" method="post">
											<table class="form">
												<tr>
													<td><input class="input" type="text" name="username" placeholder="Nama Pengguna"></td>
												</tr>
												<tr>
													<td><input class="input" type="password" name="password" placeholder="Kata Sandi"></td>
												</tr>
												<tr>
													<td>
														<input class="tombol" type="submit" name="login" value="Masuk">
														<input class="tombol" type="reset" name="reset" value="Batal">
													</td>
												</tr>

											</table>
										</form>
										<a href="register.php">Buat akun baru</a>
										<br>
								</div>
		</body>
</html>
