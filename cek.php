<?php

//cek sudah login atau belum

if (isset($_SESSION['log'])) {
	
}else{
	header('location:login.php');
}

 ?>