<?php
include 'config.php';

/* Halaman ini tidak dapat diakses jika belum ada yang login(masuk) */
if(isset($_SESSION['username'])== 0) {
	header('Location: index.php');
}

?>

<!DOCTYPE HTML>
<html>
	<head>
			<title>PDO MySQL Log In Register</title>
				<link rel="stylesheet" href="css.css" type="text/css">
	</head>
		<body>
						<div class="content">
						<div class="title">
						<h1><p>Selamat Datang <?php echo $_SESSION['username']; ?></p></h1>
</div>
	<a href="logout.php"><input class="button" type="submit"  value="Keluar"></a>
</div>
				</body>
</html>
