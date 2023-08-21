<?php 
    require 'functionuser.php';
    require 'cekuser.php';
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
        <title>Tambah Akun</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-secondary">
            <a class="navbar-brand" href="indexuser.php">Gudang ORM</a>
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
                        <h1 class="mt-4">Tambah Akun</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Akun
                              </button>
                            </div>
                            <div class="card-body">
                              
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Email Admin</th>
                                                <th>Aksi</th>
                                             
                                            </tr>
                                        </thead>
                                    
                                        <tbody>

                                            <?php
                                                $ambilsemuadataadmin = mysqli_query($conn,"select * from login");
                                                $i=1;
                                                while($data=mysqli_fetch_array($ambilsemuadataadmin)) {
                                                    $em = $data['email'];
                                                    $iduser=$data['iduser'];
                                                    $pw = $data['password'];
                                                    
                                                
                                             ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$em;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$iduser;?>">Edit</button>
                                                
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$iduser;?>">Hapus</button>
                                                </td>
                                                
                                            </tr>

                                                <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$iduser;?>">
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
                                            <input type="email" name="emailadmin" value="<?=$em;?>" placeholder = "Email Baru" class="form-control" required>
                                            <br>
                                            <input type="password" name="passwordbaru" value="<?=$pw;?>" placeholder="Password Baru" class="form-control">
                                            <br>
                                            <input type="hidden" name="id" value="<?=$iduser;?>">
                                            <button type="submit" class="btn btn-primary" name="updateadmin">Simpan</button>
                                            </div>
                                            </form>

                                          </div>
                                        </div>
                                      </div>

                                              <!-- delete Modal -->
                                        <div class="modal fade" id="delete<?=$iduser;?>">
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
                                            Apakah anda yakin ingin menghapus <?=$em;?>?
                                            <input type="hidden" name="id" value="<?=$iduser;?>">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-danger" name="hapusadmin">Hapus</button>
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
    <!-- The Modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Tambah Akun</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
                <input type="email" name="email" placeholder="Tulis Email" class="form-control" required>
                <br>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                <br>
                <tr>
                    <td colspan="2" cellspadding="10"><input type="radio" id="admin1" name="admin"><label for="admin1">Admin</label>
                        <input type="radio" id="user1" name="user"><label for="user1">User</label>
                    </td>
                </tr>
                <br>
                <button type="submit" class="btn btn-primary" name="addadmin">Simpan</button>
            </div>
            </form>

          </div>
        </div>
      </div>
</html>
