<?php
	if ($_GET['menu'] == "home") {
		?>
		<section>
			<article>
				<h2>Wellcome</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
				<p>Proin pharetra nonummy pede. Mauris et orci. Aenean nec lorem. In porttitor. Donec laoreet nonummy augue. Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend.</p>
				<p>Ut nonummy. Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla. Donec blandit feugiat ligula. Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien. Donec ut est in lectus consequat consequat.</p>
			</article>
		</section>
		<?php
	} else if($_GET['menu'] == "pengguna") {
		include "page/pengguna.php";
	} else if($_GET['menu'] == "produk") {
		include "page/produk.php";				
	} else if($_GET['menu'] == "jenis_satuan") {
		include "page/jenis_satuan.php";				
	} else {
		?>
		<section>
			<article>
				<h2>under maintenance</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa.</p>
			</article>
		</section>
		<?php
	}
?>