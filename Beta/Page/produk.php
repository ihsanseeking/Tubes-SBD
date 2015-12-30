<?php include './include/Prosedur-Fungsi.php'; ?>
<section>
	<nav class="sub-nav">
		<u><b>Sub Menu</b></u>
		<ul>
			<li><a href="media.php?menu=produk&act=&order=kode_produk&by=ASC"><button>Lihat Product</button></a></li> 
			<li><a href="media.php?menu=produk&act=input"><button>Tambah</button></a></li>
			<li>
				<form method='POST' action='?menu=produk&act=cari&order=kode&by=ASC' enctype='multipart/form-data'>
					<input type='text' name='cari' size=30 placeholder='Cari Produk'> 
					<select name='filter'>
						<option value='-'>Filter</option>
						<option value='tproduk.kode_produk'>Kode</option>
						<option value='tproduk.nama'>Produk</option>
						<option value='tjenis.nama'>Jenis</option>
						<option value='tsatuan.nama'>Satuan</option>
						<option value='tproduk.harga'>Harga</option>
					</select>
					<input type='submit' value='Cari'>
				</form>
			</li>
		</ul>
	</nav>
	<?php
		switch($_GET['act']){
			default:
				$tampil = mysql_query("SELECT 
									tproduk.kode_produk AS 'Kode',
									tproduk.nama AS 'Produk',
									tproduk.harga AS 'Harga',
									tjenis.nama AS 'Jenis', 
									tsatuan.nama AS 'Satuan'
									FROM tproduk
									LEFT JOIN tjenis
									ON tproduk.Rkode_jenis = tjenis.kode_jenis
									LEFT JOIN tsatuan
									ON tproduk.Rkode_satuan = tsatuan.kode_satuan;
									");
				$colom = array("Kode", "Produk", "Jenis", "Satuan", "=<Rp.=>.-=Harga");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "produk");
				break;
			case 'tampil': // Tampil  Data Order by or Search by where search
				//$tampil = mysql_query("SELECT * FROM tproduk ORDER BY $_GET[order] $_GET[by]");
				$tampil = mysql_query("SELECT 
									tproduk.kode_produk AS 'Kode',
									tproduk.nama AS 'Produk',
									tproduk.harga AS 'Harga',
									tjenis.nama AS 'Jenis', 
									tsatuan.nama AS 'Satuan'
									FROM tproduk
									LEFT JOIN tjenis
									ON tproduk.Rkode_jenis = tjenis.kode_jenis
									LEFT JOIN tsatuan
									ON tproduk.Rkode_satuan = tsatuan.kode_satuan
									ORDER BY $_GET[order] $_GET[by];
									");
				$colom = array("Kode", "Produk", "Jenis", "Satuan", "=<Rp.=>.-=Harga");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "produk");
				break;	
			case 'cari': // Tampil  Data Order by or Search by where search
				if ($_POST['filter'] == '-') {
					$filter = 'tproduk.nama';
				} else {
					$filter = $_POST['filter'] ;
				}
				$tampil = mysql_query("SELECT
									tproduk.kode_produk AS 'Kode',
									tproduk.nama AS 'Produk',
									tproduk.harga AS 'Harga',
									tjenis.nama AS 'Jenis', 
									tsatuan.nama AS 'Satuan'
									FROM tproduk
									LEFT JOIN tjenis
									ON tproduk.Rkode_jenis = tjenis.kode_jenis
									LEFT JOIN tsatuan
									ON tproduk.Rkode_satuan = tsatuan.kode_satuan
									WHERE $filter LIKE '%$_POST[cari]%'
									ORDER BY Produk ASC");
				$colom = array("Kode", "Produk", "Jenis", "Satuan", "=<Rp.=>.-=Harga");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "produk");
				break;
			case 'input': //form Input Data
				$kode = 1;
				?>
				<article>
					<form method='POST' action='?menu=produk&act=simpan' enctype='multipart/form-data'>
						<fieldset>
							<legend><h3>Form Produk : </h3></legend>
							<table>
				                <tr>
				                    <td>Kode</td>
				                    <td> : </td>
				                    <td><input type='text' name='kode_produk' size=15 placeholder='Kode Produk' required></td>
				                </tr>
				                <tr>
				                    <td>Nama</td>
				                    <td> : </td>
				                    <td><input type='text' name='nama' size=50 placeholder='Nama Produk' required></td>
				                </tr>
				                <tr>
				                    <td>Jenis</td>
				                    <td> : </td>
				                    <td>
				                    	<select name='jenis'>
<?php
											$tampil2 = mysql_query("SELECT * FROM tjenis ORDER BY nama");
											while($t2=mysql_fetch_array($tampil2)){ //membuat array,									
?>
												<option value=<?php echo "$t2[kode_jenis]"; ?>>
													<?php echo "$t2[nama]"; ?>
												</option>
<?php
											}
?>				                    						                    		
				                    	</select>
				                    </td>			                    	
				                </tr>
				                <tr>
				                    <td>Harga</td>
				                    <td> : </td>
				                    <td>Rp.<input type='text' name='harga' size=10 placeholder='Harga Produk' required>.-</td>
				                </tr>
				                <tr>
				                    <td>Satuan</td>
				                    <td> : </td>
				                    <td>
				                    	<select name='satuan'>
<?php
											$tampil2 = mysql_query("SELECT * FROM tsatuan ORDER BY nama");
											while($t2=mysql_fetch_array($tampil2)){ //membuat array,									
?>
												<option value=<?php echo "$t2[kode_satuan]"; ?>>
													<?php echo "$t2[nama]"; ?>
												</option>
<?php
											}
?>				                    						                    		
				                    	</select>
				                    </td>	
				                </tr>
				                <tr>
				                    <td colspan=2></td>
				                    <td>
				                    	<input type='submit' value='Simpan'>
				                        <input type='reset' value='Reset'>
				                        <input type='button' value='Batal' onclick='self.history.back()'>
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
									tproduk(
										kode_produk,
										nama,
										Rkode_jenis,
										harga,
										Rkode_satuan
									)VALUES(
                            			'$_POST[kode_produk]',
                            			'$_POST[nama]',
                            			'$_POST[jenis]',
                            			'$_POST[harga]',
                            			'$_POST[satuan]'
                            		)");
		        if($input){
		        	?>
		        	<article>
		            	<?php echo "$_POST[nama] Berhasil Disimpan"; ?>
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
									 tproduk
									 WHERE
									 tproduk.kode_produk = '$_GET[id]'
									 ");
				$t=mysql_fetch_array($tampil);
				?>
				<article>
					<form method='POST' action='?menu=produk&act=update' enctype='multipart/form-data'>
						<h3>Form Edit Produk</h3>
						<table>
			                <tr>
			                    <td>Kode</td>
			                    <td> : </td>
			                    <td><input type='text' name='kode_produk' value=<?php echo "$t[kode_produk]"; ?> size=50 placeholder='Nama Produk' required></td>
			                </tr>
			                <tr>
			                    <td>Nama</td>
			                    <td> : </td>
			                    <td><input type='text' name='nama' value=<?php echo "$t[nama]"; ?> size=50 placeholder='Nama Produk' required></td>
			                </tr>
			                <tr>
			                    <td>Jenis</td>
			                    <td> : </td>
			                    <td>
			                    	<select name='jenis'>
<?php
										$tampil2 = mysql_query("SELECT * FROM tjenis ORDER BY nama");
										while($t2=mysql_fetch_array($tampil2)){ //membuat array,
										$pilih = "";
										if ($t['Rkode_jenis'] == $t2['kode_jenis']){
											$pilih = "selected";
										}									
?>
											<option value=<?php echo "$t2[kode_jenis] $pilih"; ?>>
												<?php echo "$t2[nama]"; ?>
											</option>
<?php
										}
?>				                    						                    		
			                    	</select>
			                    </td>			                    	
			                </tr>
			                <tr>
			                    <td>Harga</td>
			                    <td> : </td>
			                    <td>Rp.<input type='text' name='harga' value=<?php echo "$t[harga]"; ?> size=10 placeholder='Harga Produk' required>.-</td>
			                </tr>
			                <tr>
			                    <td>Satuan</td>
			                    <td> : </td>
			                    <td>
			                    	<select name='satuan'>
<?php
										$tampil2 = mysql_query("SELECT * FROM tsatuan ORDER BY nama");
										while($t2=mysql_fetch_array($tampil2)){ //membuat array,
										$pilih = "";
										if ($t['Rkode_satuan'] == $t2['kode_satuan']){
											$pilih = "selected";
										}									
?>
											<option value=<?php echo "$t2[kode_satuan] $pilih"; ?>>
												<?php echo "$t2[nama]"; ?>
											</option>
<?php
										}
?>				                    						                    		
			                    	</select>
			                    </td>			  
			                    </td>	
			                </tr>
			                <tr>
			                    <td colspan=2></td>
			                    <td>
			                    	<input type='submit' value='Update'>
			                        <input type='reset' value='Reset'>
			                        <input type='button' value='Batal' onclick='self.history.back()'>
			                    </td>
			                </tr>
            			</table>
					</form>
				</article>
				<?php
				break;
			case 'update': // Simpan data Edit
				$update=mysql_query("UPDATE
									tproduk 
									SET
									nama = '$_POST[nama]',
									Rkode_jenis = '$_POST[jenis]',
									harga = '$_POST[harga]',
									Rkode_satuan = '$_POST[satuan]'
									WHERE
									kode_produk = '$_POST[kode_produk]'
                            		");
		        if($update){
		        	?>
		        	<article>
		            	<?php echo "$_POST[nama] Berhasil Dirubah"; ?>
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
									 tproduk
									 WHERE 
									 kode_produk='$_GET[id]'
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