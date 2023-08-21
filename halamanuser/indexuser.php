<?php
    
    require 'functionuser.php';
    require 'cekuser.php';

    //Hitung Semua Data
    $ambil1=mysqli_query($conn, "select * from stock");
    $count1=mysqli_num_rows($ambil1);

    //Hitung data stock aktual > stock min
    $ambil2=mysqli_query($conn, "select * from stock where stock >= stockawal");
    $count2=mysqli_num_rows($ambil2);

    //Hitung data stock aktual < stock min
    $ambil3=mysqli_query($conn, "select * from stock where stock < stockawal");
    $count3=mysqli_num_rows($ambil3);
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
        <title>Stock Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
            }

            .zoomable:hover {
                transform: scale(2.0);
                transition: 0.3s ease;
            }
        </style>


    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
        <a class="navbar-brand ps-3 sb-nav-link-icon" href="indexuser.php"><i class="fas fa-warehouse"></i> Gudang ORM</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboarduser.php">
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
                                    <a class="nav-link" href="indexuser.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                        Stock Barang
                                    </a>
                                    <a class="nav-link" href="masukuser.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-down"></i></div>
                                        Barang Masuk
                                    </a>
                                    <a class="nav-link" href="keluaruser.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-arrow-circle-up"></i></div>
                                        Barang Keluar
                                    </a>
                                    <a class="nav-link" href="baranghabisuser.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-exclamation-circle"></i></div>
                                        Warning Stock
                                    </a>
                                    <a class="nav-link" href="peminjamanuser.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-dolly-flatbed"></i></div>
                                        Pinjam Barang
                                    </a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="denahuser.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-map-marked"></i></div>
                                Denah Gudang ORM
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Akun
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                             <a class="nav-link" href="logoutuser.php">
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
                        <h1 class="mt-4"><i class="fas fa-archive"></i> Stock Barang</h1>
                        
                        <div class="card-body mb-2">
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="card text-white bg-info p-3" ><h3>Total Barang : <?=$count1?></h3></div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-success p-3" ><h3>Barang Aman : <?=$count2?></h3></div>
                                </div>
                                <div class="col">
                                    <div class="card text-white bg-danger p-3" ><h3>Barang Warning : <?=$count3?> </h3></div>
                                </div>
                        </div>
                        <br>
                                <!-- Alert barang -->
                                <?php
                                    $jenisbarang = "FastMoving";
                                    $ambildatastock = mysqli_query($conn,"select * from stock where stock < stockawal and jenisbarang = '$jenisbarang'");
                                    while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                        $barang = $fetch['namabarang'];
                                        $kodebarang = $fetch['kodebarang'];
                                 ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Perhatian!</strong> Stock (<?=$kodebarang;?>) <strong><?=$barang;?></strong> Kurang Dari Minimum Stock!
                                </div>
                                <?php 

                                    }

                                 ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>

                                                <th>Rak</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Keterangan</th>
                                                <th>Stok Awal</th>
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
                                                    $jenisbarang = $data['jenisbarang'];
                                                    $deskripsi = $data['deskripsi'];
                                                    $stockawal = $data['stockawal'];
                                                    $stock = $data['stock'];
                                                    $idb = $data['idbarang'];
                                             ?>

                                            <tr>
                                                <td><P style="text-align : center"><?=$i++;?></p></td>
                                                <td><P style="text-align : center"><?=$rak;?></p></td>
                                                <td><P style="text-align : center"><?=$kodebarang;?></p></td>
                                                <td><?=$namabarang;?></td>
                                                <td><p style="text-align : center"><?=$jenisbarang;?></p></td>
                                                <td><P style="text-align : center"><?=$deskripsi;?></p></td>
                                                <td><P style="text-align : center"><?=$stockawal;?></p></td>
                                                <td><P style="text-align : center"><?=$stock;?></p></td>

                                                
                                            </tr>
                                             <?php 
                                                }; 
                                            ?>
                                            
                                        </tbody>
                                    </table>
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
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
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

</html>
