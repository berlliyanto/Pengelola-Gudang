<?php 
    require 'function.php';
   

 //cek login

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //pencocokan dengan database

    $cekdatabase = mysqli_query ($conn, "SELECT * FROM login where email = '$email' and password = '$password'");

    //hitung jumlah data

    $hitung = mysqli_num_rows($cekdatabase);

    //Login Admin / User
    if ($hitung>0){

        $data = mysqli_fetch_assoc($cekdatabase);
    if($data['level']=="admin"){
        $_SESSION['email'] == $email;
        $_SESSION['level'] == "admin";
        $_SESSION['log'] = 'True';
        header('location: dashboard.php');
    }else if($data['level']=="user") {
        $_SESSION['email'] == $email;
        $_SESSION['level'] == "user";
        $_SESSION['log'] = 'True';
        header('location:halamanuser/dashboarduser.php');
    }
    else
    {   
        echo '
		<script>
			alert("Username atau Password Salah, Silahkan Coba Lagi !!!");
			window.location.href = "login.php";
		</script>
		' ;
        // header('location: login.php');
    };
    }
};
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
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                            
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1 " for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" name = "email"id="inputEmailAddress" type="email" placeholder="Enter Username" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                                <?php echo @$alert ?>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <table><td><tr></tr></td></table>
                                                <button  class="btn btn-primary" name="login">Login</button>
                                            </div>
    
                                        </form>
                                    </div>
                                    <!-- <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src = "js/jquery.min.js"></script>
        <script src = "js/instascan.min.js"></script>
    </body>
</html>