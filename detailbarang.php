<?php
require 'function.php';
require 'cek.php';

//dapatkan id barang
$idbarang = $_GET['id'];
//dapatkan detail barang dari id barang
$get = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang = '$idbarang'");
$fetch = mysqli_fetch_array($get);
$kodebarang = $fetch['kodebarang'];
$namabarang = $fetch['namabarang'];
$rak = $fetch['rak'];
$jenisbarang = $fetch['jenisbarang'];
$deskripsi = $fetch['deskripsi'];
$stockmin = $fetch['stockawal'];
$stock = $fetch['stock'];
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
        <title>Detail Barang (admin)</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 sb-nav-link-icon" href="index.php"><i class="fas fa-warehouse"></i> Gudang ORM</a> 
            <tr cellspadding = 50;>
                <td>
                </td>
            </tr>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link menu" id="dashboard" href="dashboard.php">
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
                                    <a class="nav-link menu" id="stockbarang" href="index.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                        Stock Barang
                                    </a>
                                    <a class="nav-link menu" id="barangmasuk" href="masuk.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-down"></i></div>
                                        Barang Masuk
                                    </a>
                                    <a class="nav-link menu" id="barangkeluar" href="keluar.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-up"></i></div>
                                        Barang Keluar
                                    </a>
                                    <a class="nav-link menu" id="warningstock" href="baranghabis.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-exclamation-circle"></i></div>
                                        Warning Stock
                                    </a>
                                    <a class="nav-link menu" id="pinjambarang" href="peminjaman.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                                        Pinjam Barang
                                    </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link menu" id="denahgudang" href="denah.php">
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
                                    <a class="nav-link menu" id="pengaturanakun" href="admin.php">
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
                        <h1 class="mt-4"><i class="fas fa-book-open"></i> Detail Barang </h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <h2><?=$namabarang;?></h2>
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"><h5>Rak             </h5> </div>
                                    <div class="col-md-9"><h5>: <?=$rak;?></h5></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><h5>Kode Barang      </h5></div>
                                    <div class="col-md-9"><h5>: <?=$kodebarang;?></h5></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><h5>Jenis Barang    </h5></div>
                                    <div class="col-md-9"><h5>: <?=$jenisbarang;?></h5></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><h5>Keterangan      </h5></div>
                                    <div class="col-md-9"><h5>: <?=$deskripsi;?></h5></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><h5>Stock Minimum   </h5></div>
                                    <div class="col-md-9"><h5>: <?=$stockmin;?></h5></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"><h5>Stock Aktual    </h5></div>
                                    <div class="col-md-9"><h5>: <?=$stock;?></h5></div>
                                </div>
                        
                            </div>
                        </div>
                            <!-- Tabel Barang Masuk -->
                            <br>
                                <div class="table-responsive">
                                    <h3>Barang Masuk</h3>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">No</th>
                                                <th style="text-align:center">Tanggal Masuk</th>
                                                <th style="text-align:center">Jumlah</th>
                                                <th style="text-align:center">Keterangan</th>
                                                
                                            </tr>
                                        </thead>
                                    
                                        <tbody>

                                            <?php
                                            $i=1;
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * from masuk where idbarang = '$idbarang'");
                                
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                                $tanggal=$data['tanggal'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                             ?>

                                            <tr>
                                                <td><P style="text-align : center"><?=$i++;?></p></td>
                                                <td><P style="text-align : center"><?=$tanggal;?></p></td>
                                                <td><P style="text-align : center"><?=$qty;?></p></td>
                                                <td><p style="text-align : center"><?=$keterangan;?></p></td>
                                                
                                            </tr>
                                             <?php 
                                                }; 
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                                <!-- Tabel Barang keluar -->
                                <div class="table-responsive">
                                    <h3>Barang Keluar</h3>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                            <th style="text-align:center">No</th>
                                                <th style="text-align:center">Tanggal Keluar</th>
                                                <th style="text-align:center">Jumlah</th>
                                                <th style="text-align:center">Penge-BON</th>
                                                <th style="text-align:center">Keterangan</th>
                                             
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                            <?php 
                                                $i=1;
                                                $ambilsemuadatastock = mysqli_query($conn,"select * from keluar where idbarang = '$idbarang'");
                                                
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)) {
                                                    $tanggal=$data['tanggal'];
                                                    $qty = $data['qty'];
                                                    $penerima = $data['penerima'];
                                                    $kegunaan = $data['kegunaan'];
                                                

                                             ?>

                                            <tr>
                                                <td><p style="text-align : center"><?=$i++;?></p></td>
                                                <td style="text-align:center"><?=$tanggal;?></td> 
                                                <td style="text-align:center"><?=$qty;?></td>
                                                <td style="text-align:center"><?=$penerima;?></td>
                                                <td style="text-align:center"><?=$kegunaan;?></td>

                                            <?php 
                                                }; 
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/simple-datatables@latest.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <!-- <script src="js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> -->
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>