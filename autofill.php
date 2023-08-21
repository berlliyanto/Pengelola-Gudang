<?php
require 'function.php';


$kodebarang = $_GET['kodebarang'];
$sql=mysqli_query($conn,"select * from stock where kodebarang ='$kodebarang'");
$hasil = mysqli_fetch_array($sql);
$data = array(
    'barangnya' => $hasil['idbarang'],
    'namabarang' =>$hasil['namabarang']
);

echo json_encode($hasil);
?>