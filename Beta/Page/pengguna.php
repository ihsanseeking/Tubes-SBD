<?php include './include/Prosedur-Fungsi.php'; ?>
<section>
	<nav class="sub-nav">
		<u><b>Sub Menu</b></u>
		<ul>
			<?php
			if ($_SESSION['level']==2){
				header('location:media.php?menu=home');
			} elseif($_SESSION['level']==0) {
			?>
				<li><a href="media.php?menu=pengguna&act=input"><button>Tambah Petugas</button></a></li>
			<?php	
			}
			?>
			<li><a href="media.php?menu=pengguna&act=&order=level&by=ASC"><button>Lihat Pengguna</button></a></li> 				
			<li><a href="media.php?menu=pengguna&act=edit"><button>Ganti Password</button></a></li> 				
			<li>
				<form method="POST" action="?menu=pengguna&act=cari&order=level&by=ASC" enctype="multipart/form-data">
					<input type="text" name="cari" size=30 placeholder="Cari Produk"> 
					<select name="filter">
						<option value="-">Filter</option>
						<option value="tpengguna.kode_pengguna">user</option>
						<!--<option value="tpengguna.level">level</option>-->
						<option value="tpengguna.status">status</option>
					</select>
					<input type="submit" value="Cari">
				</form>
			</li>
		</ul>
	</nav>
	<?php
		switch($_GET['act']){
			default:
				$tampil = mysql_query("SELECT 
									kode_pengguna AS 'User',
									level AS 'Level',
									status AS 'Status'
									FROM tpengguna
									;");
				$colom = array("User", "Level", "Status");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "pengguna");
				break;
			case 'tampil': // Tampil  Data Order by or Search by where search
				//$tampil = mysql_query("SELECT * FROM tproduk ORDER BY $_GET[order] $_GET[by]");
				$tampil = mysql_query("SELECT 
									kode_pengguna AS 'User',
									level AS 'Level',
									status AS 'Status'
									FROM tpengguna
									ORDER BY $_GET[order] $_GET[by];
									");
				$colom = array("User", "Level", "Status");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "pengguna");
				break;	
			case 'cari': // Tampil  Data Order by or Search by where search
				if ($_POST['filter'] == '-') {
					$filter = 'tpengguna.kode_pengguna';
				} else {
					$filter = $_POST['filter'] ;
				}
				$tampil = mysql_query("SELECT 
									kode_pengguna AS 'User',
									level AS 'Level',
									status AS 'Status'
									FROM tpengguna
									WHERE $filter LIKE '%$_POST[cari]%'
									ORDER BY user ASC");
				$colom = array("User", "Level", "Status");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "pengguna");
				break;	
			case 'input': //form Input Data
				$kode = 1;
				?>
				<article>
					<form method="POST" action="?menu=pengguna&act=simpan" enctype="multipart/form-data">
						<input type="hidden" name="level" value="1">
						<input type="hidden" name="status" value="0">
						<fieldset>
							<legend><h3>Form Pengguna : </h3></legend>
							<table>
				                <tr>
				                    <td>Username</td>
				                    <td> : </td>
				                    <td><input type="text" name="kode_pengguna" size=15 placeholder="Username" required></td>
				                </tr>
				                <tr>
				                    <td>Password</td>
				                    <td> : </td>
				                    <td><input type="password" name="password" size=50 placeholder="Password" required></td>
				                </tr>
								<tr>
				                    <td>Ulangi Password</td>
				                    <td> : </td>
				                    <td><input type="password" name="password_konfirmasi" size=50 placeholder="Ulangi Password" required></td>
				                </tr>
				                <tr>
				                    <td colspan=2></td>
				                    <td>
				                    	<input type="submit" value="Simpan">
				                        <input type="reset" value="Reset">
				                        <input type="button" value="Batal" onclick="self.history.back()">
				                    </td>
				                </tr>
	            			</table>
            			</fieldset>
					</form>
				</article>
				<?php
				break;
			case 'simpan': // Simpan data baru
				$input=mysql_query("INSERT INTO 
									tpengguna(
										kode_pengguna,
										password,
										level,
										status
									)VALUES(
                            			'$_POST[kode_pengguna]',
                            			MD5('$_POST[password]'),
                            			'$_POST[level]',
                            			'$_POST[status]'
                            		)");
		        if($input){
		        	?>
		        	<article>
		            	<?php echo "$_POST[kode_pengguna] Berhasil Disimpan"; ?>
		            </article>
		            <?php
		        }
		        else{
		        	?>
		        	<article>
		            	<?php echo "Data Gagal Disimpan!!.."; ?>
		            </article>
		            <?php
		        }
				break;
			case 'edit':
				$tampil = mysql_query("SELECT * FROM
									 tpengguna
									 WHERE
									 tpengguna.kode_pengguna = '$_SESSION[user]'
									 ");
				$t=mysql_fetch_array($tampil);
				?>
				<article>
					<form method="POST" action="?menu=pengguna&act=update" enctype="multipart/form-data">
						<h3>Form Edit Data Pengguna</h3>
						<table>
			                <tr>
			                    <td>Username</td>
			                    <td> : </td>
			                    <td><input type="text" name="kode_Pengguna" value=<?php echo"$t[kode_pengguna]"; ?> size=50 placeholder="Username" required></td>
			                </tr>
			                <tr>
			                    <td>Password Lama</td>
			                    <td> : </td>
			                    <td><input type="text" name="password_l" value="" size=50 placeholder="Password" required></td>
			                </tr>
			                <tr>
			                    <td>Password Baru</td>
			                    <td> : </td>
			                    <td><input type="text" name="password_b" value="" size=50 placeholder="Password" required></td>
			                </tr>
			                <tr>
			                    <td>Konfirmasi Password Baru</td>
			                    <td> : </td>
			                    <td><input type="text" name="password_k" value="" size=50 placeholder="Password" required></td>
			                </tr>
			                <tr>
			                    <td colspan=2></td>
			                    <td>
			                    	<input type="submit" value="Update">
			                        <input type="reset" value="Reset">
			                        <input type="button" value="Batal" onclick="self.history.back()">
			                    </td>
			                </tr>
            			</table>
					</form>
				</article>
				<?php
				break;
			case 'update': // Simpan data Edit
				$update=mysql_query("UPDATE
									tpengguna 
									SET
									tpengguna.password = MD5('$_POST[password_k]'),
									WHERE
									tpengguna.kode_Pengguna = '$_SESSION[user]'
									                          		");
		        if($update){
		        	?>
		        	<article>
		            	<?php echo "password $_POST[pengguna] Berhasil Dirubah"; ?>
		            </article>
		            <?php
		        }
		        else{
		        	?>
		        	<article>
		            	<?php echo "Data Gagal Dirubah!!.."; ?>
		            </article>
		            <?php
		        }
				break;
			case 'hapus':

				$delete=mysql_query("DELETE FROM
									 tpengguna
									 WHERE 
									 kode_pengguna='$_GET[id]'
									 ");
		        if($delete){
		        	?>
		        	<article>
		            	<?php echo "Data Berhasil Dihapus"; ?>
		            </article>
		            <?php
		        }
		        else{
		        	?>
		        	<article>
		            	<?php echo "Data Gagal Dihapus!!.."; ?>
		            </article>
		            <?php
		        }
				break;
		}
	?>
</section>