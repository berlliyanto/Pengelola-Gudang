<?php
$conn = mysqli_connect("localhost","root","","grafik");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grafik</title>
    <script src="js/chart.js" type="text/javascript"></script>
    <script src="js/Chart.min.js" crossorigin="anonymous"></script>
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <h1>store</h1>
    <center>
        <canvas id="penjualan"></canvas>
    </center>

                                        <!-- Grafik barang masuk -->
                                        <?php 
                                        $tanggalmasuk = mysqli_query($conn,"SELECT produk FROM chart GROUP BY produk");
                                        $jumlahkeluar = mysqli_query($conn,"SELECT SUM (jumlah) AS sold FROM chart GROUP BY produk ");
                                        ?>
                                        
                                        <script>
                                            var ctx = document.getElementById("penjualan").getContext('2d');
                                            var myChart = new Chart(ctx,{
                                                type : 'bar',
                                                data : {
                                                    labels:[<?php while($row=mysqli_fetch_array($tanggalmasuk)) {echo '"'.$row['produk']
                                                    , '",';} ?>],
                                                    datasets:
                                                    [
                                                        {
                                                            label : '# of Votes',
                                                            data : [<?php while ($row = mysqli_fetch_array($jumlahkeluar)) {echo '"'.$row['sold'].'",';} ?>],
                                                            backgroundColor:['#7FFFD4','#17BEBB','#FFC914','#7FFF00','#9932CC','#008000','#17BEBB'],
                                                            borderwidth : 1
                                                        }
                                                    ]
                                                },
                                                options: {
                                                    scales :{
                                                        yAxes : [{
                                                            ticks : {
                                                                begintAtZero : true
                                                            }
                                                        }]
                                                    }
                                                }
                                            });
                                        </script>
</body>
</html>


