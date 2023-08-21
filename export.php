<?php
    require 'function.php';
    require 'cek.php';
?>
<html>
<head>
<link rel ="icon"
                type="image/png"
                href="image/RRM.png"/>
  <title>Export Data Stock Barang (admin)</title>
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
                <div class="sb-nav-link-icon"><h4><a href="index.php"><i class="fas fa-arrow-left">Kembali</i></a></h4></div>
					 <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Rak</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Keterangan</th>
                                                <th>Stok Minimum</th>
                                                <th>Stok Aktual</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>

                                            <?php
                                                $ambilsemuadatastock = mysqli_query($conn,"select * from stock");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                                    $rak = $data['rak'];
                                                    $kodebarang = $data['kodebarang'];
                                                    $namabarang = $data['namabarang'];
                                                    $deskripsi = $data['deskripsi'];
                                                    $jenisbarang = $data['jenisbarang'];
                                                    $stockawal = $data['stockawal'];
                                                    $stock = $data['stock'];
                                                    $idb = $data['idbarang'];
                                                
                                             ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?php echo $rak;?></td>
                                                <td><?php echo $kodebarang;?></td>
                                                <td><?php echo $namabarang;?></td>
                                                <td><?php echo $jenisbarang;?></td>
                                                <td><?php echo $deskripsi;?></td>
                                                <td><?php echo $stockawal;?></td>
                                                <td><?php echo $stock;?></td>
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