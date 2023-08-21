<?php
    require 'function.php';
    require 'cek.php';
    
    //Hitung Semua Data
    $ambil1=mysqli_query($conn, "select * from stock");
    $count1=mysqli_num_rows($ambil1);

    //Hitung data stock aktual >= stock min
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
        <title>Stock Barang (admin)</title>
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
            a{
                text-decoration: none;
                color : black;
            }
        </style>


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
                        <h1 class="mt-4"><i class="fas fa-archive"></i> Stock Barang</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fas fa-cart-plus"></i>
                                Tambah Barang
                              </button>
                              <!-- Eksport -->
                              <a href="export.php" class="btn btn-primary"><i class="fas fa-file-export"></i> Export Data Barang</a>
                            </div>
                            <div class="card-body">
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
                                <!-- Alert -->
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
                                                <th style="text-align:center">No</th>
                                                <th style="text-align:center">Rak</th>
                                                <th style="text-align:center">Kode Barang</th>
                                                <th style="text-align:center">Nama Barang</th>
                                                <th style="text-align:center">Jenis Barang</th>
                                                <th style="text-align:center">Keterangan</th>
                                                <th style="text-align:center">Stok Min</th>
                                                <th style="text-align:center">Stok Aktual</th>
                                                <th style="text-align:center">Aksi</th>
                                            
                                             
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
                                                <td><a href="detailbarang.php?id=<?=$idb;?>"><strong><?=$namabarang;?></strong></a></td>
                                                <td><p style="text-align : center"><?=$jenisbarang;?></p></td>
                                                <td><P style="text-align : center"><?=$deskripsi;?></p></td>
                                                <td><P style="text-align : center"><?=$stockawal;?></p></td>
                                                <td><P style="text-align : center"><?=$stock;?></p></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idb;?>"><i class="fas fa-pen"></i></button>
                                                
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idb;?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                                    
                                            </tr>
                                            <!-- Generate QRCode Tiap Barang -->
                                                <?php
                                                    $dir="qrcode/";
                                                    $kode = $data['kodebarang'];
                                                    require_once('phpqrcode/qrlib.php');
                                                    QRcode::png("$kode","$kodebarang ".".png","L", 3);
                                                ?>

                                                <!-- Edit tombol -->
                                        <div class="modal fade" id="edit<?=$idb;?>">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                          
                                            <!-- Edit Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Edit Data Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Edit body -->
                                            <form method="post">
                                            <div class="modal-body">
                                            <label>Rak : </label>
                                            <!-- <input type="text" name="rak" value="<?=$rak;?>" class="form-control" required> -->
                                            <select name="rak" class="form-control">
                                                <option ><?=$rak?></option>
                                                <option ><p>A1</p></option>
                                                <option ><p>A2</p></option>
                                                <option ><p>A3</p></option>
                                                <option ><p>A4</p></option>
                                                <option ><p>B1</p></option>
                                                <option ><p>B2</p></option>
                                                <option ><p>B3</p></option>
                                                <option ><p>B4</p></option>
                                                <option ><p>C1</p></option>
                                                <option ><p>C2</p></option>
                                                <option ><p>C3</p></option>
                                                <option ><p>C4</p></option>
                                                <option ><p>D1</p></option>
                                                <option ><p>D2</p></option>
                                                <option ><p>D3</p></option>
                                                <option ><p>D4</p></option>
                                                <option ><p>E1</p></option>
                                                <option ><p>E2</p></option>
                                                <option ><p>E3</p></option>
                                                <option ><p>E4</p></option>
                                                <option ><p>F1</p></option>
                                                <option ><p>F2</p></option>
                                                <option ><p>F3</p></option>
                                                <option ><p>F4</p></option>
                                                <option ><p>G1</p></option>
                                                <option ><p>G2</p></option>
                                                <option ><p>G3</p></option>
                                                <option ><p>G4</p></option>
                                                <option ><p>H1</p></option>
                                                <option ><p>H2</p></option>
                                                <option ><p>H3</p></option>
                                                <option ><p>H4</p></option>
                                            </select>
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
                                            <label>Stock Minimum :</label>
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
                                          
                                            <!-- Delete Header -->
                                            <div class="modal-header">
                                            <h4 class="modal-title">Hapus Barang</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Delete body -->
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

    <!-- Tambah Barang -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Tambah Barang Header -->
            <div class="modal-header">
              <h4 class="modal-title"><i class="fas fa-cart-plus"></i> Tambah Barang</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Tambah Barang body -->
            <form method="post">
            <div class="modal-body">
                
                <label>Rak :</label>
                <select name="rak" class="form-control">
                <option ><p>--Pilih Rak--</p></option>
                <option ><p>A1</p></option>
                <option ><p>A2</p></option>
                <option ><p>A3</p></option>
                <option ><p>A4</p></option>
                <option ><p>B1</p></option>
                <option ><p>B2</p></option>
                <option ><p>B3</p></option>
                <option ><p>B4</p></option>
                <option ><p>C1</p></option>
                <option ><p>C2</p></option>
                <option ><p>C3</p></option>
                <option ><p>C4</p></option>
                <option ><p>D1</p></option>
                <option ><p>D2</p></option>
                <option ><p>D3</p></option>
                <option ><p>D4</p></option>
                <option ><p>E1</p></option>
                <option ><p>E2</p></option>
                <option ><p>E3</p></option>
                <option ><p>E4</p></option>
                <option ><p>F1</p></option>
                <option ><p>F2</p></option>
                <option ><p>F3</p></option>
                <option ><p>F4</p></option>
                <option ><p>G1</p></option>
                <option ><p>G2</p></option>
                <option ><p>G3</p></option>
                <option ><p>G4</p></option>
                <option ><p>H1</p></option>
                <option ><p>H2</p></option>
                <option ><p>H3</p></option>
                <option ><p>H4</p></option>
                </select>
                <br>
                <input type="text" name="kodebarang" placeholder="Isi kode barang" class="form-control" required>
                <!-- Validasi Kode Barang -->

                <br>
                <input type="text" name="namabarang" placeholder="Isi nama barang" class="form-control" required>
                <br>
                <label for="">Jenis Barang :</label>
                <select name="jenisbarang" class="form-control">
                    
                    <option ><p>FastMoving</p></option>
                    <option ><p>SlowMoving</p></option>
                    </select>
                <br>
                <input type="text" name="deskripsi" placeholder="Isi keterangan barang" class="form-control" required>
                <br>
                <input type="number" name="stockawal" class="form-control" placeholder="Isi stok minimum" required>
                <br>
                <input type="number" name="stock" class="form-control" placeholder="Isi stok aktual" required>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewbarang">Simpan</button>
            </div>
            </form>

          </div>
        </div>
      </div>
</html>
