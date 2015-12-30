<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset = "UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include "include/koneksi.php"; ?>
		<!--<link rel = "stylesheet" href = "include/style.css">-->
		<link rel="stylesheet" href="include/bootstrap/3.3.6/css/bootstrap.min.css">
  		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
  		<!--
  		<script src="include/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
  		<title>Keranjan Beta 1</title>
	</head>
	<body>

		<div class="container">
			<div>
				<?php 
				 $ip=$_SERVER['REMOTE_ADDR'];
				 //echo "Your IP Address is $ip"; 
				 ?>
				<h2>Masuk</h2>
				<form role="form" method="POST" action="cek_login.php">
					<input type="hidden" name="username" class="form-control" id="usr" value=<?php echo"$ip"; ?> >
					<input type="hidden" name="password" class="form-control" id="pwd" value="">
					<input type="hidden" name="level" class="form-control" id="lvl" value="2">
					<button type="submit" class="btn btn-default">Masuk</button>
				</form>
			</div> 
			<div>
				<h2>Login</h2>
				<form role="form" method="POST" action="cek_login.php">
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="text" name="username" class="form-control" id="usr" placeholder="Enter Username">
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password">
					</div>
					<input type="hidden" name="level" class="form-control" id="lvl" value="">
					<!--<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>-->
					<button type="submit" class="btn btn-default">Login</button>
				</form>
			</div>
		</div>
		<!--
		<header>
			<h1>Keranjang Belanja</h1>
		</header>
		<nav>
			<?php //header('location:media.php?menu=home'); ?>
		</nav>
		<main>
			
		</main>
		<footer>
			<p>
				Copyright &copy; Kelompok 15 
				<br>
				SISTEM KERANJANG BELANJA BERBASIS WEB MOBILE UNTUK PASAR MODERN 
				<br>
				10111302 - Aditya Agung Nugroho, 10112108 - Juni Eko Prabowo, 10113483 - Ihsan Faturohman
			</p>
		</footer>
	-->
	</body>
</html>





