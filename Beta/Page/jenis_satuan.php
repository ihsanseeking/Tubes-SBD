<?php include './include/Prosedur-Fungsi.php'; ?>
<section>
	<nav class="sub-nav">
		<u><b>Sub Menu</b></u>
		<ul>
			<li><a href="media.php?menu=jenis_satuan&act=&order=nama&by=ASC"><button>Lihat Jenis</button></a></li> 
			<li><a href="media.php?menu=jenis_satuan&act=tampil_satuan&order=nama&by=ASC"><button>Lihat Satuannya</button></a></li>
			<li><a href="media.php?menu=jenis_satuan&act=input_jenis"><button>Tambah Jenis</button></a></li>
			<li><a href="media.php?menu=jenis_satuan&act=input_satuan"><button>Tambah Satuan</button></a></li>
			<li>
				<form method='POST' action='?menu=jenis_satuan&act=cari' enctype='multipart/form-data'>
					<input type='text' name='cari' size=30 placeholder='Cari Jenis'> 
					<input type='submit' value='Cari'>
				</form>
			</li>
	</nav>
<?php
		switch($_GET['act']){
			default:
				$tampil = mysql_query("SELECT 
										tjenis.nama AS 'Jenis',
										GROUP_CONCAT(tsatuan.nama) AS 'Satuan'
										FROM tjenis_satuan
										LEFT JOIN tjenis
										ON tjenis_satuan.Rkode_jenis = tjenis.kode_jenis
										LEFT JOIN tsatuan
										ON tjenis_satuan.Rkode_satuan = tsatuan.kode_satuan
										GROUP BY tjenis_satuan.Rkode_jenis;
									");
				$colom = array("Jenis", "Satuan");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "jenis_satuan");
				break;
			case 'tampil': // Tampil  Data Order by or Search by where search
				$tampil = mysql_query("SELECT 
										tjenis.nama AS 'Jenis',
										GROUP_CONCAT(tsatuan.nama) AS 'Satuan'
										FROM tjenis_satuan
										LEFT JOIN tjenis
										ON tjenis_satuan.Rkode_jenis = tjenis.kode_jenis
										LEFT JOIN tsatuan
										ON tjenis_satuan.Rkode_satuan = tsatuan.kode_satuan
										GROUP BY tjenis_satuan.Rkode_jenis;
									");
				$colom = array("Jenis", "Satuan");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "jenis_satuan");
				break;
			case 'tampil_satuan': // Tampil  Data Order by or Search by where search
				$tampil = mysql_query("SELECT 
										tjenis.nama AS 'Jenis',
										GROUP_CONCAT(tsatuan.nama) AS 'Satuan'
										FROM tjenis_satuan
										LEFT JOIN tjenis
										ON tjenis_satuan.Rkode_jenis = tjenis.kode_jenis
										LEFT JOIN tsatuan
										ON tjenis_satuan.Rkode_satuan = tsatuan.kode_satuan
										GROUP BY tjenis_satuan.Rkode_jenis;
									");
				$colom = array("Jenis", "Satuan");
				// "=<","=>","=" adalah Format Untuk Menambahkan huruf di awal atau akhir data
				// "=<" menambahkan huruf di depan data cth: "=<Rp."
				// "=>" menambahkan huruf di belakang data cth: "=>.-"
				// "=" tanda ada yang di tambahkan atau data yang di tampilkan(di simpan paling terahir) cth: "=data"
				// jadi contohnya untuk data= Harga : "=<Rp.=>.-=Harga"
				tampilData($tampil, $colom, "jenis_satuan");
				$tampil = mysql_query("SELECT * FROM tsatuan");
				$posisi = 0;
				$nomor = $posisi;
				if ($_GET['by'] == 'DESC') {
					$by1 = "?menu=jenis_satuan&act=tampil_satuab&order=nama&by=ASC";
					//$by2 = "?menu=jenis_satuan&act=tampil&order=jenis&by=ASC";
				} else {
					$by1 = "?menu=jenis_satuan&act=tampil_satuan&order=nama&by=DESC";
					//$by2 = "?menu=jenis_satuan&act=tampil&order=jenis&by=DESC";
				}
?>
				<article>
					<h2>Data Satuan</h2>
					<table class="data">
						<tr>
							<th>No</th>
							<th><a href=<?php echo $by1; ?> >Satuan</a></th>
							<!--<th><a href=<?php //echo $by2; ?> >Satuan</a></th>-->
							<th>Opsi</th>
						</tr>
<?php
						while($t=mysql_fetch_array($tampil)){ //membuat array,	
							$nomor = $nomor + 1;							
?>
							<tr>
								<td><?php echo "$nomor"; ?></td>
								<td><?php echo "$t[nama]"; ?></td>
								<td>
									<a href=<?php echo "?menu=jenis_satuan&act=edit_satuan&id=$t[kode_satuan]"; ?> >
										<button>Edit</button>
									</a> or 
					                <a href=<?php echo "?menu=jenis_satuan&act=hapus_satuan&id=$t[kode_satuan]"; ?> >
					                	<button>Hapus</button>
					                </a>
				            	</td>
							</tr>
<?php	
						}
?>
					</table>
				</article>
<?php
				break;	
			case 'cari': // Tampil  Data Order by or Search by where search
				$tampil = mysql_query("SELECT * FROM tjenis
										WHERE tjenis.nama LIKE '%$_POST[cari]%';
										#ORDER BY $_GET[order] $_GET[by]");
				$posisi = 0;
				$nomor = $posisi ;
				if ($_GET['by'] == 'DESC') {
					$by1 = "?menu=jenis_satuan&act=tampil&order=nama&by=ASC";
					//$by2 = "?menu=jenis_satuan&act=tampil&order=jenis&by=ASC";
				} else {
					$by1 = "?menu=jenis_satuan&act=tampil&order=nama&by=DESC";
					//$by2 = "?menu=jenis_satuan&act=tampil&order=jenis&by=DESC";
				}	
?>
				<article>
					<h2>Data Jenis dan Satuan</h2>
					<table class="data">
						<tr>
							<th>No</th>
							<th><a href=<?php echo $by1; ?> >Jenis</a></th>
							<!--<th><a href=<?php //echo $by2; ?> >Satuan</a></th>-->
							<th>Satuan</th>
							<th>Opsi</th>
						</tr>
<?php
						while($t=mysql_fetch_array($tampil)){ //membuat array,	
							$nomor = $nomor + 1;							
?>
							<tr>
								<td><?php echo "$nomor"; ?></td>
								<td><?php echo "$t[nama]"; ?></td>
								<td>
<?php
									$tampil2 = mysql_query("SELECT tsatuan.nama AS 'nama'
															FROM tjenis_satuan
															LEFT JOIN tsatuan
															ON tjenis_satuan.Rkode_satuan = tsatuan.kode_satuan
															WHERE tjenis_satuan.Rkode_jenis=  '$t[kode_jenis]'
															 ");
									while($t2=mysql_fetch_array($tampil2)){ //membuat array,
										echo "$t2[nama], ";
									}	
?>
								</td>							
								<td>
									<a href=<?php echo "?menu=jenis_satuan&act=edit&id=$t[kode_jenis]"; ?> >
										<button>Edit</button>
									</a> or 
				                	<a href=<?php echo "?menu=jenis_satuan&act=hapus&id=$t[kode_jenis]"; ?> >
				                		<button>Hapus</button>
				                	</a>
				                </td>
							</tr>
<?php	
						}
?>
					</table>
				</article>
<?php
				break;
			case 'input_jenis': //form Input Data
				$status = "";
				?>
				<article>
					<form method='POST' action='?menu=jenis_satuan&act=simpan_jenis' enctype='multipart/form-data'>
						<fieldset>
    						<legend><h3>Form Jenis dan Satuan : </h3></legend>
							<table>
				                <tr>
				                    <td>
				                    	<label>Nama</label>
				                    </td>
				                    <td> : </td>
				                    <td><input type='text' name='nama' size=50 placeholder='Nama Jenis' required></td>
				                </tr>
				                <tr>
				                	<td>
				                		<label>Satuan</label>
				                	</td>
				                	<td> : </td>
				                	<td>
				                		<div class="list_data">
						                	<?php
						                	$tampil = mysql_query("SELECT
						                							kode_satuan AS 'Kode',
						                							nama AS 'Nama'
						                							FROM tsatuan
						                						");
											while($t=mysql_fetch_array($tampil))
											{ //membuat array,
												?>
						                		<input type="checkbox" name="satuan[]" value=<?php echo "$t[Kode]"; ?>> 
						                		<?php echo "$t[Nama]"; ?>
						                		<br>
						                		<?php
						                	}
						                	?>
					                	</div>
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
			case 'input_satuan': //form Input Data
				$status = "";
				?>
				<article>
					<form method='POST' action='?menu=jenis_satuan&act=simpan_satuan' enctype='multipart/form-data'>
						<fieldset>
    						<legend><h3>Form Satuan : </h3></legend>
							<table>
				                <tr>
				                    <td>
				                    	<label>Nama</label>
				                    </td>
				                    <td> : </td>
				                    <td><input type='text' name='nama' size=50 placeholder='Nama satuan' required></td>
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
			case 'simpan_jenis': // Simpan data baru

				$nama = $_POST['nama'];
				$satuan = $_POST['satuan'];
				
				$input=mysql_query("INSERT INTO 
									tjenis(
										nama
									)VALUES(
                            			'$nama'
                            		)");
				if($input){
					?>
			        	<article>
			            	<?php echo "Jenis $nama Berhasil Disimpan<br>"; ?>
		            <?php
					$tampil=mysql_query("SELECT * FROM tjenis WHERE nama = '$nama'");
					$t=mysql_fetch_array($tampil);
					foreach( $satuan as $key => $kode_satuan ) {
						$input=mysql_query("INSERT INTO 
											tjenis_satuan(
												Rkode_jenis,
												Rkode_satuan
											)VALUES(
		                            			'$t[kode_jenis]',
		                            			'$kode_satuan'
		                            		)");
						if($input){
				        	?>
				            	<?php echo "satuan $key Berhasil Disimpan<br>"; ?>
			            	<?php
			        	}else{
				        	?>
				            	<?php echo "Data satuan gagal Disimpan!!..<br>"; ?>
				            <?php
			        	}
					}

				}else{
		        	?>
		        	<article>
		            	<?php echo "Data Gagal Disimpan!!.."; ?>
		            <?php
		        }
		       	?>
		       	</article>
		       	<?php
				break;
			case 'simpan_satuan': // Simpan data baru
				$input=mysql_query("INSERT INTO 
									tsatuan(
										nama
									)VALUES(
                            			'$_POST[nama]'
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
			case 'edit_jenis':
				$tampil = mysql_query("SELECT * FROM
									 tjenis
									 WHERE
									 tjenis.kode_jenis = '$_GET[id]'
									 ");
				$t=mysql_fetch_array($tampil);
				?>
				<article>
					<form method='POST' action='?menu=jenis_satuan&act=update_jenis' enctype='multipart/form-data'>
						<input type='hidden' name='kode_jenis' value=<?php echo "$t[kode_jenis]"; ?>></td>	
						<h3>Form Edit Produk</h3>
						<table>		        
			                <tr>
			                    <td>Nama</td>
			                    <td> : </td>
			                    <td><input type='text' name='nama' value=<?php echo "$t[nama]"; ?> size=50 placeholder='Nama Produk' required></td>
			                </tr>	
			                <tr>
			                	<td>
			                		<label>Satuan</label>
			                	</td>
			                	<td> : </td>
			                	<td>
			                		<div class="list_data">
					                	<?php
					                	$tampil = mysql_query("SELECT
					                							kode_satuan AS 'Kode',
					                							nama AS 'Nama'
					                							FROM tsatuan
					                						");
										while($t=mysql_fetch_array($tampil))
										{ //membuat array,
											?>
					                		<input type="checkbox" name="satuan[]" value=<?php echo "$t[Kode]"; ?>
					                		<?php
					                		$ada=mysql_query("SELECT * 
					                						FROM tjenis_satuan 
					                						WHERE Rkode_jenis = '$_GET[id]'
					                						AND Rkode_satuan = '$t[Kode]'"
					                						);
					                		if ($t2=mysql_fetch_array($ada)) {
					                			echo "checked";
					                		}
					                		?>
					                		>
					                		<?php echo "$t[Nama]"; ?>
					                		<br>
					                		<?php
					                	}
					                	?>
				                	</div>
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
			case 'edit_satuan':
				$tampil = mysql_query("SELECT * FROM
									 tsatuan
									 WHERE
									 tsatuan.kode_satuan = '$_GET[id]'
									 ");
				$t=mysql_fetch_array($tampil);
				?>
				<article>
					<form method='POST' action='?menu=jenis_satuan&act=update_satuan' enctype='multipart/form-data'>
						<input type='hidden' name='kode_satuan' value=<?php echo "$t[kode_satuan]"; ?>></td>	
						<h3>Form Edit Produk</h3>
						<table>		        
			                <tr>
			                    <td>Nama</td>
			                    <td> : </td>
			                    <td><input type='text' name='nama' value=<?php echo "$t[nama]"; ?> size=50 placeholder='Nama Produk' required></td>
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
			case 'update_jenis': // Simpan data Edit
				$kode = $_POST['kode_jenis'];
				$nama = $_POST['nama'];
				$satuan = $_POST['satuan'];
				$update=mysql_query("UPDATE
									tjenis 
									SET
									nama = '$nama'
									WHERE
									kode_jenis = 'kode'
                            		");
		        if($update){
					?>
			        	<article>
			            	<?php echo "Jenis $nama Berhasil Disimpan<br>"; ?>
		            <?php
					mysql_query("DELETE FROM tjenis_satuan WHERE Rkode_jenis = '$kode'");

					foreach( $satuan as $key => $kode_satuan ) {
						$update=mysql_query("INSERT INTO 
											tjenis_satuan(
												Rkode_jenis,
												Rkode_satuan
											)VALUES(
		                            			'$kode',
		                            			'$kode_satuan'
		                            		)");
						if($update){
				        	?>
				            	<?php echo "satuan $key Berhasil Disimpan<br>"; ?>
			            	<?php
			        	}else{
				        	?>
				            	<?php echo "Data satuan gagal Disimpan!!..<br>"; ?>
				            <?php
			        	}
					}

				}else{
		        	?>
		        	<article>
		            	<?php echo "Data Gagal Disimpan!!.."; ?>
		            <?php
		        }
		       	?>
		       	</article>
		       	<?php
				break;
			case 'update_satuan': // Simpan data Edit
				$update=mysql_query("UPDATE
									tstatus 
									SET
									nama = '$_POST[nama]'
									WHERE
									kode_satuan = '$_POST[kode_satuan]'
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
			case 'hapus_jenis':
				$delete=mysql_query("DELETE FROM
									 tjenis_satuan
									 WHERE 
									 Rkode_jenis='$_GET[id]'
									 ");
		        if($delete){
		        	$delete=mysql_query("DELETE FROM
									 tjenis
									 WHERE 
									 kode_jenis='$_GET[id]'
									 ");
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
			case 'hapus_satuan':
				$delete=mysql_query("DELETE FROM
									 tsatuan
									 WHERE 
									 kode_satuan='$_GET[id]'
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