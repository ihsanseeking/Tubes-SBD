<?php 
	include "include/koneksi.php"; 

	echo" 	username 	: $_POST[username]<br>
			password 	: $_POST[password]<br>
			Level 		: $_POST[level]<br>
		";

	$user = $_POST['username'];
	$pass = $_POST['password'];
	$level = $_POST['level'];

	if ($level == 2) {
		$delete=mysql_query("DELETE FROM
							 tpengguna
							 WHERE 
							 kode_pengguna='$user'
							 ");
        if($delete){
        	?>
        	<article>
            	<?php echo "Data Berhasil Dihapus<br>"; ?>
            </article>
            <?php
        }else{
        	?>
        	<article>
            	<?php echo "Data Gagal Dihapus!!.."; ?>
            </article>
            <?php
        }
		$input=mysql_query("INSERT INTO 
							tpengguna(
								kode_pengguna,
								password,
								level,
								status
							)VALUES(
                    			'$user',
                    			'$pass',
                    			'$level',
                    			'0'
                    		)");
		if($input){
        	?>
        	<article>
            	<?php echo "$user Berhasil Disimpan<br>"; ?>
            </article>
            <?php
	        }
	    else{
	    	?>
	    	<article>
	        	<?php echo "Data Gagal Disimpan!!..<br>"; ?>
	        </article>
        <?php
		}
		$login=mysql_query("SELECT * 
					FROM tpengguna 
					WHERE kode_pengguna='$_POST[username]' 
					");
	} else {
		$login=mysql_query("SELECT * 
					FROM tpengguna 
					WHERE kode_pengguna='$_POST[username]' 
					AND password=MD5('$_POST[password]')
					");
	}
	$ketemu=mysql_num_rows($login);
	// Apabila username dan password ditemukan
	if ($ketemu > 0){
		$update=mysql_query("UPDATE
							tpengguna 
							SET
							status = '1'
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
		$r=mysql_fetch_array($login);
		session_start();

		$_SESSION['user']=$r['kode_pengguna'];
		$_SESSION['pass']=$r['password'];
		$_SESSION['level']=$r['level'];
		header('location:media.php?menu=home');
	}
	else{
		echo"<link href=./themes/style.css rel=stylesheet type=text/css>";
		echo "<center>Login gagal! username & password tidak benar<br>";
		echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
	}
?>	