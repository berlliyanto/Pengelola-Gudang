<?php
    require 'function.php';
    require 'cek.php';
?>
<html>
<head>
<link rel ="icon"
                type="image/png"
                href="image/RRM.png"/>
  <title>Export Data Barang Keluar (admin)</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Stock Gudang ORM</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
                <div class="sb-nav-link-icon"><h4><a href="keluar.php"><i class="fas fa-arrow-left">Kembali</i></a></h4></div>
                <form method="post">
                                <table>
                                    <tr>
                                        <td> Dari Tanggal </td>
                                        <td><input type="date" name = "dari_tgl" class = "form-control" required="required"></td>
                                        <td> Sampai Tanggal </td>
                                        <td><input type="date" name = "sampai_tgl" class="form-control" required="required"></td>
                                        <td><button type="submit" class="btn btn-primary" name="filter" required="required"><i class="fas fa-filter"></i>Filter</button></td>
                                        <td>
                                                <?php
                                                        if(isset($_POST['filter'])){
                                                            $dari=$_POST['dari_tgl'];
                                                            $sampai=$_POST['sampai_tgl'];
                                                        echo "Tanggal : " ."[ ". $dari." ]"." - "."[".$sampai."]";
                                                ?><?php }?></td>
                                        <td><a class="nav-link" href="exportkeluar.php">
                                            Reset Filter
                                        </a></td>
                                    </tr>
                                </table>
                            </form>
					 <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Penerima</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>

                                            <?php
                                            if(isset($_POST['filter'])){
                                                $dari=mysqli_real_escape_string($conn,$_POST['dari_tgl']);
                                                $sampai=mysqli_real_escape_string($conn,$_POST['sampai_tgl']);
                                                
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM keluar  m, stock s where s.idbarang = m.idbarang 
                                                AND tanggal BETWEEN '$dari' AND DATE_ADD('$sampai',INTERVAL 1 DAY)");
                                                }else{
                                                $ambilsemuadatastock = mysqli_query($conn,"select * from keluar k, stock s where s.idbarang = k.idbarang");
                                                }
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                                    $idk = $data['idkeluar'];
                                                    $idb = $data['idbarang'];
                                                    $tanggal=$data['tanggal'];
                                                    $kodebarang = $data['kodebarang'];
                                                    $namabarang = $data['namabarang'];
                                                    $qty = $data['qty'];
                                                    $penerima = $data['penerima'];
                                                
                                             ?>

                                            <tr>
                                                <td style="text-align : center"><?=$i++;?></td>
                                                <td style="text-align : center"><?=$tanggal;?></td>
                                                <td style="text-align : center"><?=$kodebarang;?></td>
                                                <td style="text-align : center"><?=$namabarang;?></td>
                                                <td style="text-align : center"><?=$qty;?></td>
                                                <td style="text-align : center"><?=$penerima;?></td>
                                            </tr>

                                             <?php 
                                                }; 
                                            ?>
                                            
                                        </tbody>
                                    </table>
					
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>

	

</body>

</html>