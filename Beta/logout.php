<?php
	include "include/koneksi.php"; 
	session_start();
	$user = $_SESSION['user'];
	$level = $_SESSION['level'];
	echo " $user";
	if ($level == 2) {
		$delete=mysql_query("DELETE FROM
						 tpengguna
						 WHERE 
						 kode_pengguna='$user'
						 ");
		if($delete){
			?>
			<article>
		    	<?php echo "Data Berhasil Dihapu s<br>"; ?>
		    </article>
		    <?php
		}else{
	    	?>
	    	<article>
	        	<?php echo "Data Gagal Dihapus!!.."; ?>
	        </article>
	        <?php
	    }
	} else {
		$update=mysql_query("UPDATE
							tpengguna 
							SET
							status = '0'
							WHERE
							kode_pengguna = '$user'
                    		");
        if($update){
        	?>
        	<article>
            	<?php echo "$user Berhasil Dirubah<br>"; ?>
            </article>
            <?php
        }
        else{
        	?>
        	<article>
            	<?php echo "Data Gagal Dirubah!!..<br>"; ?>
            </article>
            <?php
        }
	}

	session_destroy();
	header('location:index.php');
?>