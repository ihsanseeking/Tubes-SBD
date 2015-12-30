<?php
    //inisialisasi
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "dbkeranjang";
    //koneksi ke MySQL
    mysql_connect($server,$username,$password) or die("Koneksi Gagal!!");
    //memilih database
    mysql_select_db($database) or die("Database tidak bisa dibuka");
?> 	