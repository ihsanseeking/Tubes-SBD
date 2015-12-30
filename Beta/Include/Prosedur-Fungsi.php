<?php
	function tampilData($tampil, $colom, $menu) {
		$iColom = count($colom);
		?>
		<article>
			<h2>Data Produk</h2>

			<table class="data">
			<tr>
				<th>No</th>
				<?php
				for($i = 0; $i < $iColom; $i++) {
					$dpn[$i] = "";
					$blk[$i] = "";
					if (substr($colom[$i],0,1) == "=") {
						$arrColom = str_split("$colom[$i]");
						$j = count($arrColom);
						do {
							$j--;
						} while ($arrColom[$j] != "=");
						$j++;
						$col[$i] = substr($colom[$i],$j);
						do {
							$j--;
							$j2=$j-1;
							do {
								$j--;
							} while ($arrColom[$j] != "=");
							$j2 = $j2-$j;
							$j++;
							$add[$i] = substr($colom[$i],$j,$j2);
							if (substr($add[$i],0,1) == "<") {
								$dpn[$i] = substr($add[$i],1);
							} else if (substr($add[$i],0,1) == ">") {
								$blk[$i] = substr($add[$i],1);
							}
							$isi = $col[$i];
							$add[$i] = $i;
						} while ($j > 1);	
					} else {
						$isi = $colom[$i];
						$add[$i] = $iColom + 1; // Jangan di isi Huruf karena 0 == huruf bernilai (true)
					}
					if ($_GET['by'] == 'DESC') {
						$link = "?menu=$menu&act=tampil&order=$isi&by=ASC";
					} else {
						$link = "?menu=$menu&act=tampil&order=$isi&by=DESC";
					}
					?>
					<th>
						<a class="link" href=<?php echo "$link";?>>
					 		<?php echo "$isi"; ?>
					 	</a>
					</th>
				<?php
				}
				if ($menu != "pengguna"){
					?>
					<th>Opsi</th>
					<?php
					}else{
						if ($_SESSION['level']=="0"){
						?>
						<th>Opsi</th>
						<?php
						}
					}
					?>
			</tr>
			<?php
				$nomor = 0;
				while($t=mysql_fetch_array($tampil)){ //membuat array,	
					//$nomor = $nomor + 1;						
					$nomor++;
					?>
					<tr>
						<td><?php echo "$nomor"; ?></td>
						<?php
						for($i = 0; $i < $iColom; $i++) {
							if ($i == $add[$i]) {
								//$isi = "Harga";
								$isi = $col[$i];
								$isi = $dpn[$i].$t[$isi].$blk[$i];
								/*if(0 == "a"){ //bekas Cek Benar atau salah aja
									$isi = "sama ya?";
								}else{
									$isi = $i." X ".$add[$i];	
								}*/
							} else {
								$isi = $t[$colom[$i]];	
								//$isi = $i." V ".$add[$i];
							}	
							?>
							<td><?php echo"$isi"; ?></td>
						<?php
						}
						$isi = $t[$colom[0]];
						if ($menu != "pengguna"){
						?>
						<td>
							<a href=<?php echo "?menu=$menu&act=edit&id=$isi"; ?> ><button>Edit</button></a> or 
		                	<a href=<?php echo "?menu=$menu&act=hapus&id=$isi"; ?> onclick='yakin()'><button>Hapus</button></a>
						</td>
						<?php
						}else{
							if ($_SESSION['level']=="0"){
							?>
							<td>
								<a href=<?php echo "?menu=$menu&act=edit&id=$isi"; ?> ><button>Edit</button></a> or 
		                		<a href=<?php echo "?menu=$menu&act=hapus&id=$isi"; ?> onclick='yakin()'><button>Hapus</button></a>
							</td>
							<?php
							}
						}
						?>
					</tr>
					<?php	
				}
			?>
			</table>
		</article>
		<?php
	}
?>