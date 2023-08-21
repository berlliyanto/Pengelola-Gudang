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
        <title>Barang Habis (admin)</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/all.min.js" crossorigin="anonymous"></script>
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
                                MMenu
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
                        <h1 class="mt-4"><i class="fas fa-exclamation-circle"></i> Warning Stock</h1>
                        <br>
                        <!-- yang diedit -->
                        <div class="table-responsive">
                                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">No</th>

                                                <th style="text-align:center">Rak</th>
                                                <th style="text-align:center">Kode Barang</th>
                                                <th style="text-align:center">Nama Barang</th>
                                                <th style="text-align:center">Jenis Barang</th>
                                                <th style="text-align:center">Keterangan</th>
                                                <th style="text-align:center">Stok Min</th>
                                                <th style="text-align:center">Stok Aktual</th>
                                            
                                             
                                            </tr>
                                        </thead>
                                    
                                        <tbody>

                                            <?php
                                                
                                                $ambilsemuadatastock = mysqli_query($conn,"select * from stock where stock < stockawal" );
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
                                                <!-- Tombol edit & hapus Gak Dipake -->
                                                <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idb;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Edit Data Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            <label>Rak : </label>
                                            <input type="text" name="rak" value="<?=$rak;?>" class="form-control" required>
                                            <br>
                                            <label>Kode Barang :</label>
                                            <input type="text" name="kodebarang" value="<?=$kodebarang;?>" class="form-control" required>
                                            <br>
                                            <label>Nama Barang :</label>
                                            <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                                            <br>
                                            <label>Jenis Barang :</label>
                                            <select name="jenisbarang" class="form-control">
                                                <option ><p>FastMoving</p></option>
                                                <option ><p>SlowMoving</p></option>
                                            </select>
                                            <br>
                                            <label>Keterangan :</label>
                                            <input type="text" name="deskripsi" value="<?=$deskripsi;?>" class="form-control" required>
                                            <br>
                                            <label>Stock Awal :</label>
                                            <input type="number" name="stockawal" value="<?=$stockawal;?>" class="form-control" required>
                                            <br>
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <button type="submit" class="btn btn-primary" name="updatebarang">Simpan</button>
                                            </div>
                                            </form>

                                          </div>
                                        </div>
                                      </div>

                                              <!-- delete Modal -->
                                        <div class="modal fade" id="delete<?=$idb;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Hapus Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            Apakah anda yakin ingin menghapus <?=$namabarang;?>?
                                            <input type="hidden" name="idb" value="<?=$idb;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapusbarang">Hapus</button>
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
</html>