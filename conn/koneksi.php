<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "kasirdias";
	$koneksi = mysqli_connect($host,$user,$pass,$db);

	if (!$koneksi) { die('Maaf koneksi gagal:'. $connect->connect_error);	
	}

	else{
		//echo 'Tahu';
		//echo $_SESSION['viewnya'];
	}	
?>