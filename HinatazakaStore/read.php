<?php
if(isset($_GET["id_pembeli"]) && !empty(trim($_GET["id_pembeli"]))){
require_once "config.php";

$sql = 'SELECT id_pembeli,nama,alamat,hp,tgl_transaksi,jenis_barang,nama_barang,jumlah,harga, (harga*jumlah) AS total_bayar FROM prasetya WHERE id_pembeli = ?';

if($stmt = mysqli_prepare($con,$sql)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = trim($_GET["id_pembeli"]);

    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $id_pembeli = $row["id_pembeli"];
            $nama = $row["nama"];
            $alamat = $row["alamat"];
            $hp = $row["hp"];
            $tgl_transaksi = $row["tgl_transaksi"];
            $jenis_barang = $row["jenis_barang"];
            $nama_barang = $row["nama_barang"];
            $jumlah = $row["jumlah"];
            $harga = $row["harga"];
        } else{
            header("location: error.php");
            exit();
        }
    
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
}
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else{
  header("location: error.php");
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Record</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
                width: 800px;
                margin: 0 auto;
            }
        </style>
    </head>
    <link rel="stylesheet" href="Style.css">
    <body>
        
    <div class="header">
        <nav>
            <ul>
                <h4><li class="active"><a href="index.php">Home</a></li> 
            </ul>
        </nav>
    </div>

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>Data Pembeli</h1>
                        </div>
                        <div class="form-group">
                            <label>ID Pembeli</label>
                            <p class="form-control-static"><?php echo $row["id_pembeli"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <p class="form-control-static"><?php echo $row["nama"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <p class="form-control-static"><?php echo $row["alamat"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nomer HP</label>
                            <p class="form-control-static"><?php echo $row["hp"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <p class="form-control-static"><?php echo $row["tgl_transaksi"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang</label>
                            <p class="form-control-static"><?php echo $row["jenis_barang"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <p class="form-control-static"><?php echo $row["nama_barang"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <p class="form-control-static"><?php echo $row["jumlah"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <p class="form-control-static"><?php echo $row["harga"]; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Total Bayar</label>
                            <p class="form-control-static"><?php echo $row["total_bayar"]; ?></p>
                        </div>
                        <p><a href="index.php" class="btn btn-primary">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>