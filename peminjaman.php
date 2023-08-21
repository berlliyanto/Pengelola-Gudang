<?php 
    require 'function.php';
    require 'cek.php';
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel ="icon"
                type="image/png"
                href="image/RRM.png"/>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Peminjaman Barang (admin)</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/all.min.js" crossorigin="anonymous"></script>
        <script src = "js/jquery.min.js"></script>
        <script src = "js/instascan.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
        <a class="navbar-brand ps-3 sb-nav-link-icon" href="index.php"><i class="fas fa-warehouse"></i> Gudang ORM</a> 
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Menu
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="index.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                        Stock Barang
                                    </a>
                                    <a class="nav-link" href="masuk.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-down"></i></div>
                                        Barang Masuk
                                    </a>
                                    <a class="nav-link" href="keluar.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-up"></i></div>
                                        Barang Keluar
                                    </a>
                                    <a class="nav-link" href="baranghabis.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-exclamation-circle"></i></div>
                                        Warning Stock
                                    </a>
                                    <a class="nav-link" href="peminjaman.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                                        Pinjam Barang
                                    </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="denah.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-map-marked"></i></div>
                                Denah Gudang ORM
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-address-card""></i></div>
                                Akun
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="admin.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-id-card-alt"></i></div>
                                        Pengaturan Akun
                                    </a>
                                    <a class="nav-link" href="logout.php">
                                        Logout. 
                                        <i class="fas fa-sign-in-alt"></i>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <div class="small">Selamat Datang Di ,</div>
                            <div class="big">
                                Inventaris Gudang ORM
                            </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><i class="fas fa-dolly-flatbed"></i> Peminjaman Barang</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Barang -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fas fa-cart-plus"></i>
                                Tambah Barang
                              </button>
                            </div>
                            <div class="card-body">
                            <form method="post">
                            <table>
                                    <tr>
                                        <td> Dari Tanggal </td>
                                        <td><input type="date" name = "dari_tgl" class = "form-control" required="required"></td>
                                        <td> Sampai Tanggal </td>
                                        <td><input type="date" name = "sampai_tgl" class="form-control" required="required"></td>
                                        <td><button type="submit" class="btn btn-primary" name="filter" required="required"><i class="fas fa-filter"></i></button></td>
                                        <td>
                                                <?php
                                                        if(isset($_POST['filter'])){
                                                            $dari=$_POST['dari_tgl'];
                                                            $sampai=$_POST['sampai_tgl'];
                                                        echo "Tanggal : " ."[ ". $dari." ]"." - "."[".$sampai."]";
                                                ?><?php }?></td>
                                                <td><a class="nav-link" href="peminjaman.php">
                                            Reset Filter
                                            </a></td>
                                    </tr>
                                </table>
                            </form>
                            <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Tanggal Pinjam</th>
                                                <th style="text-align:center">Kode Barang</th>
                                                <th style="text-align:center">Nama Barang</th>
                                                <th style="text-align:center">Jumlah</th>
                                                <th style="text-align:center">Penerima</th>
                                                <th style="text-align:center">Status</th>
                                                <th style="text-align:center">Aksi</th>
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
                                                    $ambilsemuadatastock = mysqli_query($conn,"select * from peminjaman p, stock s where s.idbarang = p.idbarang");
                                                }
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                                    $idk = $data['idpeminjaman'];
                                                    $idb = $data['idbarang'];
                                                    $tanggal=$data['tanggalpinjam'];
                                                    $kodebarang = $data['kodebarang'];
                                                    $namabarang = $data['namabarang'];
                                                    $qty = $data['qty'];
                                                    $penerima = $data['peminjam'];
                                                    $status = $data['status'];
                                                

                                             ?>

                                            <tr>
                                                <td style="text-align:center"><?=$tanggal;?></td>
                                                <td style="text-align:center"><?=$kodebarang;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td style="text-align:center"><?=$qty;?></td>
                                                <td style="text-align:center"><?=$penerima;?></td>
                                                <td style="text-align:center"><?=$status;?></td>
                                                <td>
                                                <?php  

                                                    //cek status peminjaman
                                                    if($status=='Dipinjam'){
                                                        echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit'.$idk.'">Peminjaman Selesai</button>';
                                                    }else{
                                                        //jika barang sudah kembali
                                                        echo '-';
                                                    }

                                                ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                                <!-- Edit Barang -->
                                            <div class="modal fade" id="edit<?=$idk;?>">
                                                <div class="modal-dialog">
                                                <div class="modal-content">
                                              
                                                <!-- Barang Header -->
                                                <div class="modal-header">
                                                <h4 class="modal-title">Edit Data Barang</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                
                                                <!-- Barang body -->
                                                <form method="post">
                                                <div class="modal-body">
                                                Konfirmasi : Peminjaman Telah Selesai?
                                                <br>
                                                <br>
                                                <input type="hidden" name="idpinjam" value="<?=$idk;?>">
                                                <input type="hidden" name="idbarang" value="<?=$idb;?>">
                                                <button type="submit" class="btn btn-primary" name="barangkembali">Ya</button>
                                                </div>
                                                </form>
                                                
                                                
                                              </div>
                                            </div>
                                          </div>
                                                <!-- delete Barang -->
                                        <div class="modal fade" id="delete<?=$idm;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                          
                                            <!-- Barang Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Hapus Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Barang body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <input type="hidden" name="kty" value="<?=$qty;?>">
                                            <input type="hidden" name="idm" value="<?=$idm;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapusbarangmasuk">Hapus</button>
                                            </div>
                                            </form>

                                          </div>
                                        </div>
                                      </div>
                                            <?php 
                                                }; 
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Gudang ORM 2022 - <?php echo date('Y')?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/simple-datatables@latest.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        
    </body>
     <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Barang Header -->
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-cart-plus"></i> Tambah Barang Dipinjam</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Barang body -->
            <form method="post">
            <div class="modal-body">
            <label for="#preview">QRCode Scanner : </label>
            <video id="preview" width="200" height="150"></video>
                <br>
                <!-- Panggil Kamera Scanner -->
                <script type="text/javascript">
                    let scanner = new Instascan.Scanner({video : document.getElementById('preview')});
                    scanner.addListener('scan', function(content){
                        alert("Scan Berhasil !!!");
                        $("#kodebarang").val(content);
                    });
                    Instascan.Camera.getCameras().then(function(cameras){
                        if(cameras.length > 0){
                            scanner.start(cameras[0]);
                            
                        }else{
                            console.error('No cameras found');
                        }
                    }).catch(function(e){
                        console.error(e);
                    });
                </script>
                <input type="hidden" id="barangnya" name="barangnya" value="">
                <input type="search" id="kodebarang" name ="kodebarang" class="form-control" placeholder="Kode Barang" onFocus="autofill()">
                <br>
                <input type="search" id = "namakode" name="namakode" class="form-control" placeholder="Nama Barang" value="">
                
                
                <!-- autofill kode -->
                <script src="js/jquery-1.12.4.min.js"></script> 
                <script type="text/javascript">
                
                function autofill(){
                    var kodebarang = $("#kodebarang").val();
                    $.ajax({
                        url : 'autofill.php',
                        data: 'kodebarang='+kodebarang,
                    }).success(function(data){
                        var json = data,
                        obj = JSON.parse(json);
                        $("#barangnya").val(obj.idbarang);
                        $("#namakode").val(obj.namabarang);
                    });
                    
                }

            </script>
                <br>
                <input type="number" name="qty" class="form-control" placeholder="Jumlah" required>
                <br>
                <input type="text" name="penerima" placeholder="penerima" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="pinjam">Simpan</button>
                <br><br>
                <label><strong>*Tekan Form <u>Kode Barang</u> Dahulu Sebelum Scan QRCode</strong></label>
            </div>
            </form>

          </div>
        </div>
      </div>
</html>
