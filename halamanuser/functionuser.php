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


	//validasi barang apakah sudah ada atau belum
	$cek = mysqli_query($conn,"select * from stock where namabarang = '$namabarang' ");
	$hitung = mysqli_num_rows($cek);


				$addtotable = mysqli_query($conn,"insert into stock (rak,kodebarang,namabarang,deskripsi,stockawal,stock) values ('$rak','$kodebarang','$namabarang','$deskripsi','$stockawal','$stock')");
					if ($addtotable) {
						header('location:indexuser.php');
					}else{
						echo "Gagal tambah data";
						header('location:index.php');
					}
		
			} ;


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

	$addtomasuk = mysqli_query ($conn,"insert into masuk (idbarang,kodebarangm,keterangan,qty) values ('$barangnya','$kodebarang','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn,"update stock set stock = '$tambahkanstocksekarangdenganquantity' where idbarang = '$barangnya'");

	if ($addtomasuk&&$updatestockmasuk) {
			header('location:masukuser.php');
		}else{
			echo "Gagal tambah data";
			header('location:masukuser.php');
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
				header('location:keluaruser.php');
			}else{
				echo "Gagal tambah data";
				header('location:keluaruser.php');
			}
	}
	//bila barang yang keluar lebih besar dari stock saat ini 
	else{
		echo '
		<script>
			alert("Stock saat ini tidak mencukupi! Mohon Periksa Lalu Coba Lagi");
			window.location.href = "keluaruser.php";
		</script>
		' ;
	}
}


//update data barang
if (isset($_POST['updatebarang'])) {
	$idb = $_POST['idb'];
	$rak = $_POST['rak'];
	$kodebarang = $_POST['kodebarang'];
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stockawal = $_POST['stockawal'];
	//Upload Image
	$allowed_extension = array('png','jpg'); //ekstensi yg diperbolehkan
	$nama = $_FILES['file']['name']; //mengambil inputan nama gambar 
	$dot = explode('.',$nama);
	$ekstensi = strtolower(end($dot)); //mengambil inputan ekstensi
	$ukuran = $_FILES['files']['size']; //mengambil inputan ukuran gambar
	$file_tmp = $_FILES['file']['tmp_name']; //nyari lokasi gambar

	//penamaan file
	$image = md5(uniqid($nama,true)) . time() . '.' . $ekstensi; //gabungkan nama file yg dienkripsi dgn ekstensi

	if($ukuran!==0){
		//jika edit dan upload gambar
		move_uploaded_file($file_tmp, 'images/'.$image);
		$update = mysqli_query($conn,"update stock set rak='$rak', kodebarang= '$kodebarang',namabarang='$namabarang',deskripsi='$deskripsi',stockawal='$stockawal',image='$image' where idbarang='$idb' ");
		if($update){
			header('location:indexuser.php');
		}
		else{
			echo 'gagal'; header('location:indexuser.php');
		}

	}

	else{
		//jika edit tidak mau upload gambar
		move_uploaded_file($file_tmp, 'images/'.$image);
		$update = mysqli_query($conn,"update stock set namabarang='$namabarang',deskripsi='$deskripsi' where idbarang='$idb' ");
		if($update){
			header('location:indexuser.php');
		}
		else{
			echo 'gagal'; header('location:indexuser.php');
		}

	}
}

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
		header('location:indexuser.php');

	}else{
		header('location:indexuser.php');
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
		$selisih = $qty-$qtyskrg;
		$kurangin = $stockskrg-$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty = '$qty',keterangan = '$deskripsi' where idmasuk = '$idm' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:masukuser.php');
			}else{
				echo 'gagal';
				header('location:masukuser.php');
			}
		}
	else{

		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg+$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update masuk set qty = '$qty',keterangan = '$deskripsi' where idmasuk = '$idm' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:masukuser.php');
			}else{
				echo 'gagal';
				header('location:masukuser.php');
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
		header('location:masukuser.php');
	}else{
		header('location:masukuser.php');
	}
}


//mengubah data barang keluar

if (isset($_POST['updatebarangkeluar'])) {
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
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
		$updatenya = mysqli_query($conn,"update keluar set qty = '$qty',penerima = '$penerima' where idkeluar = '$idk' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:keluaruser.php');
			}else{
				echo 'gagal';
				header('location:keluaruser.php');
			}
		}
	else{

		$selisih = $qtyskrg-$qty;
		$kurangin = $stockskrg+$selisih;
		$kurangistocknya = mysqli_query($conn,"update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn,"update keluar set qty = '$qty',penerima = '$penerima' where idkeluar = '$idk' ");

			if ($kurangistocknya&&$updatenya) {
				header('location:keluaruser.php');
			}else{
				echo 'gagal';
				header('location:keluaruser.php');
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
		header('location:keluaruser.php');
	}else{
		header('location:keluaruser.php');
	}
}

//Tambah Admin Baru
if (isset($_POST['addadmin'])) {
	$email=$_POST['email'];
	$password=$_POST['password'];

	$queryinsert = mysqli_query($conn,"insert into login (email,password) values ('$email','$password') ");

	if($queryinsert){
		header('location:adminuser.php');
	}

	else{
		header('location:adminuser.php');
	}
}

//edit data admin
if (isset($_POST['updateadmin'])){
	$emailbaru = $_POST['emailadmin'];
	$passwordbaru = $_POST['passwordbaru'];
	$idnya = $_POST['id'];

	$queryupdate = mysqli_query($conn,"update login set email = '$emailbaru',password = '$passwordbaru' where iduser='$idnya'");

	if($queryupdate){
		header('location:adminuser.php');
	}

	else{
		header('location:adminuser.php');
	}

}

//hapus data admin

if(isset($_POST['hapusadmin'])){

	$id = $_POST['id'];

	$querydelete = mysqli_query($conn,"delete from login where iduser = '$id'");

	if($querydelete){
		header('location:adminuser.php');
	}

	else{
		header('location:adminuser.php');
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
			window.location.href = "peminjamanuser.php";
		</script>
		' ;

	}else{
		//jika gagal
		echo '
		<script>
			alert("Gagal Meminjam!");
			window.location.href = "peminjamanuser.php";
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
			window.location.href = "peminjamanuser.php";
		</script>
		' ;

	}else{
		//jika gagal
		echo '
		<script>
			alert("Gagal Mengembalikan!");
			window.location.href = "peminjamanuser.php";
		</script>
		' ;

	}

}

 ?>