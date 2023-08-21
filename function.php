<?php 
 session_start();
//koneksi database
$conn = mysqli_connect("localhost","root","","stockbarang");

//insert data
if (isset($_POST['addnewbarang'])) {
	$rak = $_POST['rak'];
	$kodebarang = $_POST['kodebarang'];
	$jenisbarang = $_POST['jenisbarang'];
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stockawal = $_POST['stockawal'];
	$stock = $_POST['stock'];


	//validasi kodebarang apakah sudah ada atau belum
	$cek = mysqli_query($conn,"select * from stock where kodebarang = '$kodebarang' ");
	$hitung = mysqli_num_rows($cek);

	if($hitung>0){
		echo '
		<script>
			alert("Kode Barang Sudah Digunakan, Mohon Periksa Kembali !!!");
			window.location.href = "index.php";
		</script>
		' ;
	}else{
				$addtotable = mysqli_query($conn,"insert into stock (rak,kodebarang,namabarang,jenisbarang,deskripsi,stockawal,stock) values ('$rak','$kodebarang','$namabarang','$jenisbarang','$deskripsi','$stockawal','$stock')");
					if ($addtotable) {
						header('location:index.php');
					}else{
						echo "Gagal tambah data";
						header('location:index.php');
					}
				}
			} ;

//hapus semua isi database
// if(isset($_POST['hapussemuastock'])){
// 	$cek = mysqli_query($conn,"SELECT * FROM stock");
// 	$hitung = mysqli_num_rows($cek);
// 	$deleteall = mysqli_query($conn,"DELETE FROM stock");
// 		if($deleteall){
// 			header('location : index.php');
// 		} else{
// 			echo"Gagal Hapus Data";
// 			header('location : index.php');
// 		}
// }

//menambah barang masuk
if (isset($_POST['barangmasuk'])) {
	$kodebarang = $_POST['kodebarang'];
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang = '$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

	$addtomasuk = mysqli_query ($conn,"insert into masuk (idbarang,kodebarang,keterangan,qty) values ('$barangnya','$kodebarang','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn,"update stock set stock = '$tambahkanstocksekarangdenganquantity' where idbarang = '$barangnya'");

	if ($addtomasuk&&$updatestockmasuk) {
			header('location:masuk.php');
		}else{
			echo "Gagal tambah data";
			header('location:masuk.php');
		}

}

//menambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];
	$kegunaan = $_POST['kegunaan'];

	$cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang = '$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];

	//bila stock mencukupi
	if($stocksekarang >= $qty){
		$tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

		$addtokeluar = mysqli_query ($conn,"insert into keluar (idbarang,penerima,kegunaan,qty) values ('$barangnya','$penerima','$kegunaan','$qty')");
		$updatestockmasuk = mysqli_query($conn,"update stock set stock = '$tambahkanstocksekarangdenganquantity' where idbarang = '$barangnya'");

		if ($addtokeluar&&$updatestockmasuk) {
				header('location:keluar.php');
			}else{
				echo "Gagal tambah data";
				header('location:keluar.php');
			}
	}
	//bila barang yang keluar lebih besar dari stock saat ini 
	else{
		echo '
		<script>
			alert("Stock saat ini tidak mencukupi! Mohon Periksa Lalu Coba Lagi");
			window.location.href = "keluar.php";
		</script>
		' ;
	}
}


//update atau edit data barang
if (isset($_POST['updatebarang'])) {
	$idb = $_POST['idb'];
	$rak = $_POST['rak'];
	$kodebarang = $_POST['kodebarang'];
	$namabarang = $_POST['namabarang'];
	$jenisbarang = $_POST['jenisbarang'];
	$deskripsi = $_POST['deskripsi'];
	$stockawal = $_POST['stockawal'];

	$cek = mysqli_query($conn,"select * from stock where kodebarang = '$kodebarang' ");
	$hitung = mysqli_num_rows($cek);

	// if($hitung==1){
	// 	echo '
	// 	<script>
	// 		alert("Kode Barang Sudah Digunakan, Mohon Periksa Kembali !!!");
	// 		window.location.href = "index.php";
	// 	</script>
	// 	' ;
		
	// }else{ 
		$update = mysqli_query($conn,"update stock set rak='$rak', kodebarang= '$kodebarang',namabarang='$namabarang',jenisbarang='$jenisbarang',deskripsi='$deskripsi',stockawal='$stockawal' where idbarang='$idb' ");
		if($update){
			header('location:index.php');
		}
		else{
			echo 'gagal'; header('location:index.php');
		}
		
	}
//  };

	// //Upload Image
	// $allowed_extension = array('png','jpg'); //ekstensi yg diperbolehkan
	// $nama = $_FILES['file']['name']; //mengambil inputan nama gambar 
	// $dot = explode('.',$nama);
	// $ekstensi = strtolower(end($dot)); //mengambil inputan ekstensi
	// $ukuran = $_FILES['files']['size']; //mengambil inputan ukuran gambar
	// $file_tmp = $_FILES['file']['tmp_name']; //nyari lokasi gambar

	//penamaan file
	// $image = md5(uniqid($nama,true)) . time() . '.' . $ekstensi; //gabungkan nama file yg dienkripsi dgn ekstensi

// 	if($ukuran!==0){
// 		//jika edit dan upload gambar
// 		move_uploaded_file($file_tmp, 'images/'.$image);
// 		$update = mysqli_query($conn,"update stock set rak='$rak', kodebarang= '$kodebarang',namabarang='$namabarang',jenisbarang='$jenisbarang',deskripsi='$deskripsi',stockawal='$stockawal',image='$image' where idbarang='$idb' ");
// 		if($update){
// 			header('location:index.php');
// 		}
// 		else{
// 			echo 'gagal'; header('location:index.php');
// 		}

// 	}

// 	else{
// 		//jika edit tidak mau upload gambar
// 		move_uploaded_file($file_tmp, 'images/'.$image);
// 		$update = mysqli_query($conn,"update stock set namabarang='$namabarang',deskripsi='$deskripsi' where idbarang='$idb' ");
// 		if($update){
// 			header('location:index.php');
// 		}
// 		else{
// 			echo 'gagal'; header('location:index.php');
// 		}

// 	}
// }

//hapus data barang
if (isset($_POST['hapusbarang'])) {
	$idb = $_POST['idb'];

	//hapus gambar pada barang yang dihapus takutnya nyangkut gambarnya
	$gambar = mysqli_query($conn,"select * from stock where idbarang = '$idb' ");
	$get = mysqli_fetch_array($gambar);
	$img = 'images/'.$get['image'];
	unlink($img);

	$hapus = mysqli_query($conn,"delete from stock where idbarang = '$idb'");
	if ($hapus) {
		header('location:index.php');

	}else{
		header('location:index.php');
	}

}

//mengubah data barang masuk

if (isset($_POST['updatebarangmasuk'])) {
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$deskripsi = $_POST['keterangan'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn,"select * from stock where idbarang = '$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn,"select * from masuk where idmasuk = '$idm'");
	$qtynya  = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if ($qty>$qtyskrg) {
		$selisih = $qtyskrg-$qty;
		
		$kurangin = $stockskrg-$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty = '$qty',keterangan = '$deskripsi', namabarang = '$namabarang' where idmasuk = '$idm' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:masuk.php');
			}else{
				echo 'gagal';
				header('location:masuk.php');
			}
		}
	else{

		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg+$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty = '$qty',keterangan = '$deskripsi',namabarang = '$namabarang' where idmasuk = '$idm' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:masuk.php');
			}else{
				echo 'gagal';
				header('location:masuk.php');
			}

	}

}

//hapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idm = $_POST['idm'];

	$getdatastock = mysqli_query($conn,"select * from stock where idbarang = '$idb' ");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selisih = $stok-$qty;

	$update = mysqli_query($conn,"update stock set stock = '$selisih' where idbarang = '$idb' ");
	$hapusdata = mysqli_query($conn,"delete from masuk where idmasuk = '$idm'");

	if ($update&&$hapusdata) {
		header('location:masuk.php');
	}else{
		header('location:masuk.php');
	}
}


//mengubah data barang keluar

if (isset($_POST['updatebarangkeluar'])) {
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$kegunaan = $_POST['kegunaan'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn,"select * from stock where idbarang = '$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn,"select * from keluar where idkeluar = '$idk'");
	$qtynya  = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if ($qty>$qtyskrg) {
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg-$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set qty = '$qty',penerima = '$penerima',kegunaan = '$kegunaan' where idkeluar = '$idk' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else{
				echo 'gagal';
				header('location:keluar.php');
			}
		}
	else{

		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg+$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set qty = '$qty',penerima = '$penerima', kegunaan = '$kegunaan' where idkeluar = '$idk' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else{
				echo 'gagal';
				header('location:keluar.php');
			}

	}

}

//hapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idk = $_POST['idk'];

	$getdatastock = mysqli_query($conn,"select * from stock where idbarang = '$idb' ");
	$data = mysqli_fetch_array($getdatastock);
	$stok = $data['stock'];

	$selisih = $stok+$qty;

	$update = mysqli_query($conn,"update stock set stock = '$selisih' where idbarang = '$idb' ");
	$hapusdata = mysqli_query($conn,"delete from keluar where idkeluar = '$idk'");

	if ($update&&$hapusdata) {
		header('location:keluar.php');
	}else{
		header('location:keluar.php');
	}
}

//Tambah Akun Baru
if (isset($_POST['addadmin'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];
	$level=$_POST['level'];

	$cek = mysqli_query($conn,"select * from login where email = '$email'");
	$cekemail = mysqli_num_rows($cek);

	if($cekemail>0){
		echo'
		<script>
			alert("Email Sudah Digunakan, Mohon Periksa Kembali !!!");
			window.location.href = "admin.php";
		</script>
		';
	}else{
	$queryinsert = mysqli_query($conn,"insert into login (email,password,level) values ('$email','$password','$level') ");

	if($queryinsert){
		header('location:admin.php');
	}

	else{
		header('location:admin.php');
	}
}
};

//edit data Akun
if (isset($_POST['updateadmin'])){
	$emailbaru = $_POST['emailadmin'];
	$passwordbaru = $_POST['passwordbaru'];
	$level=$_POST['level'];
	$idnya = $_POST['id'];

	$queryupdate = mysqli_query($conn,"update login set email = '$emailbaru',password = '$passwordbaru',level = '$level' where iduser='$idnya'");

	if($queryupdate){
		header('location:admin.php');
	}

	else{
		header('location:admin.php');
	}

}

//hapus data Akun

if(isset($_POST['hapusadmin'])){

	$id = $_POST['id'];

	$querydelete = mysqli_query($conn,"delete from login where iduser = '$id'");

	if($querydelete){
		header('location:admin.php');
	}

	else{
		header('location:admin.php');
	}
}

//pinjam barang
if (isset($_POST['pinjam'])) {
	//mengambil id barang,jumlah,penerima dri form
	$idbarang = $_POST['barangnya'];
	$qty = $_POST['qty'];
	$penerima = $_POST['penerima'];

	//memeriksa stok sekarang
	$stok_saat_ini = mysqli_query($conn,"select * from stock where idbarang= '$idbarang' ");
	$stok_nya = mysqli_fetch_array($stok_saat_ini);
	$stok = $stok_nya['stock']; //mendapatkan jumlah stock

	//mengurangi stock sekarang karena dipinjam
	$new_stock = $stok-$qty;

	//query memasukan data ke database
	$insertpinjam = mysqli_query($conn,"INSERT INTO peminjaman (idbarang,qty,peminjam) values ('$idbarang','$qty','$penerima') ");

	//query mengurangi jumlah barang karena dipinjam di tabel stock
	$kurangistok = mysqli_query($conn,"update stock set stock='$new_stock' where idbarang = '$idbarang' ");

	if($insertpinjam&&$kurangistok){
		//jika berhasil
		echo '
		<script>
			alert("Tambah Data Peminjaman Berhasil!");
			window.location.href = "peminjaman.php";
		</script>
		' ;

	}else{
		//jika gagal
		echo '
		<script>
			alert("Gagal Meminjam!");
			window.location.href = "peminjaman.php";
		</script>
		' ;

	}

}

//barang selesai dipinjam

if (isset($_POST['barangkembali'])) {
	$idpinjam = $_POST['idpinjam'];
	$idbarang = $_POST['idbarang'];


	$update_status = mysqli_query($conn,"update peminjaman set status ='Selesai' where idpeminjaman = '$idpinjam' ");

	//memeriksa stok sekarang
	$stok_saat_ini = mysqli_query($conn,"select * from stock where idbarang= '$idbarang' ");
	$stok_nya = mysqli_fetch_array($stok_saat_ini);
	$stok = $stok_nya['stock']; //mendapatkan jumlah stock

	//memeriksa qty sekarang
	$stok_saat_ini1 = mysqli_query($conn,"select * from peminjaman where idpeminjaman= '$idpinjam' ");
	$stok_nya1 = mysqli_fetch_array($stok_saat_ini1);
	$stok1 = $stok_nya1['qty']; //mendapatkan jumlah stock

	//menambahkan stock barang yg sudah dikembalikan
	$new_stock = $stok1+$stok;
	$kembalikan_stock = mysqli_query($conn,"update stock set stock='$new_stock' where idbarang='$idbarang' ");

	if($update_status&&$kembalikan_stock){
		//jika berhasil
		echo '
		<script>
			alert("Berhasil Mengembalikan!");
			window.location.href = "peminjaman.php";
		</script>
		' ;

	}else{
		//jika gagal
		echo '
		<script>
			alert("Gagal Mengembalikan!");
			window.location.href = "peminjaman.php";
		</script>
		' ;

	}

}
//pilih rak 
 if (isset($_POST['pilihrak'])) {
	$rak = $_POST['rak'];
	$lihat_rak = mysqli_query($conn, "select * from stock where rak = '$rak'");
	$filterrak= mysqli_num_rows($lihat_rak);
 }
 ?>

 