<?php

error_reporting(0);
include 'config.php';

if(!isset($_SESSION['username'] )== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: home.php');
}

$username 		 = $_POST['username'];
$email 			 = $_POST['email'];
$password 		 = md5($_POST['password']."ALS52KAO09");
$confirmPassword = md5($_POST['confirmPassword']."ALS52KAO09");

if(isset($username, $email, $password, $confirmPassword)) {
	if(strstr($email, "@")) {
		if($password == $confirmPassword) {
			try {
				$sql = "SELECT * FROM users WHERE username = :username OR email = :email";
				$stmt = $connect->prepare($sql);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':email', $email);
				$stmt->execute();
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}

			$count = $stmt->rowCount();
			if($count == 0) {
				try {
					$sql = "INSERT INTO users SET username = :username, email = :email, password = :password";
					$stmt = $connect->prepare($sql);
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':email', $email);
					$stmt->bindParam(':password', $password);
					$stmt->execute();
				}
				catch(PDOException $e) {
					echo $e->getMessage();
				}
				if($stmt) {
					echo "<div class='notif'>Selamat Anda berhasil menambahkan akun baru, anda dapat Masuk ke halaman selanjutnya</div>";
					header('Location: index.php');
				}
			}else{
				echo "<div class='notif'>Nama Pengguna dan Email sudah pernah digunakan !</div>";
			}
		}else{
			echo "<div class='notif'>Kata Sandi tidak sama<div>";
		}
	}else{
		echo "<div class='notif'>Email Tidak Valid</div>";
	}
}

?>

<!-- FORM UNTUK REGISTRASI -->
<!DOCTYPE HTML>

	<html>
		<head>
				<title>PDO MySQL Log In Register</title>
					<link rel="stylesheet" href="css.css" type="text/css">
		</head>
			<body>
						<div class="content2">
								<div class="title">
									Registrasi akun baru
							</div>
									<form action="" method="post">
											<table class="form">
											<tr>

												<td><input class="input_a" type="text" name="username" placeholder="Nama Pengguna"></td>
											</tr>
											<tr>
												<td><input class="input_b" type="text" name="email" placeholder="E-Mail"></td>
											</tr>
											<tr>
												<td><input class="input_c" type="password" name="password" placeholder="Kata Sandi"></td>
											</tr>
											<tr>
												<td><input class="input_d" type="password" name="confirmPassword" placeholder="Konfirmasi Kata Sandi"></td>
											</tr>
											<tr>
												<td>
													<input class="tombol" type="submit" name="register" value="Registrasi">
													<input class="tombol" type="reset" name="reset" value="Batal">
												</td>
											</tr>
										</table>
									</form>
						</div>
		</body>
	</html>
