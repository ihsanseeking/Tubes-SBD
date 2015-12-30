<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include "include/koneksi.php"; ?>
		<link rel="stylesheet" href="include/style.css">
		<!--<link rel="stylesheet" href="include/bootstrap/3.3.6/css/bootstrap.min.css">-->
  		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
  		<!--<script src="include/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
		<script>
	    	function yakin(){
				var x=confirm('Anda yakin??');
				if (x=false){s
					self.history.back();
				}
	    	}
		</script>
		<title>Keranjan Beta 3</title>
	</head>
	<body>
		<header>
			<h1>Keranjang Belanja</h1>
		</header>
		<?php
		session_start();
		if (empty($_SESSION['user']) and empty($_SESSION['pass'])){
			header('location:index.php');
		}else{	
		?>
			<nav>
				<h3>Menu</h3>
				<ul>
					<li><a href="media.php?menu=home"><button>Home</button></a></li> 
					<?php
					if ($_SESSION['level']==0){
					?>
						<li><a href="media.php?menu=pengguna&act=&order=level&by=ASC"><button>Data Pengguna</button></a></li>
						<li><a href="media.php?menu=produk&act=&order=kode_produk&by=ASC"><button>Data Product</button></a></li>
						<li><a href="media.php?menu=jenis_satuan&act=&order=nama&by=ASC"><button>Jenis dan Satuan</button></a></li>
		        		<li><a href="media.php?menu=tempat&act=&order=nama&by=ASC"><button>Tempat</button></a></li>		        		
					<?php
					}elseif ($_SESSION['level']==1){
					?>
						<li><a href="media.php?menu=pengguna&act=&order=level&by=ASC"><button>Data Pengguna</button></a></li>
						<li><a href="media.php?menu=produk&act=&order=kode_produk&by=ASC"><button>Data Product</button></a></li>
						<li><a href="media.php?menu=jenis_satuan&act=&order=nama&by=ASC"><button>Jenis dan Satuan</button></a></li>
		        		<li><a href="media.php?menu=tempat&act=&order=nama&by=ASC"><button>Tempat</button></a></li>
					<?php
					}else{
					?>
						<li><a href="media.php?menu=pengguna&act=&order=level&by=ASC"><button>Keranjang</button></a></li>
					<?php
					}
					?>
					<li><a href="logout.php"><button>Logout</button></a></li>
				</ul>
			</nav>
			<main>
				<?php include "main.php"; ?>
			</main>
		<?php
		}
		?>
		<footer>
			<p>
				Copyright &copy; Kelompok 15 
				<br>
				SISTEM KERANJANG BELANJA BERBASIS WEB MOBILE UNTUK PASAR MODERN 
				<br>
				10111302 - Aditya Agung Nugroho, 10112108 - Juni Eko Prabowo, 10113483 - Ihsan Faturohman
			</p>
		</footer>
	</body>
</html>