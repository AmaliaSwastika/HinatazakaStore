<?php
require_once "config.php";

$nama = $alamat = $hp = $tgl_transaksi = $jenis_barang = $nama_barang = $jumlah = $harga = "";
$nama_err = $alamat_err = $hp_err = $tgl_transaksi_err = $jenis_barang_err = $nama_barang_err = $jumlah_err = $harga_err = "";

if (isset($_POST["id_pembeli"]) && !empty($_POST["id_pembeli"])) {
    $id_pembeli = $_POST["id_pembeli"];
    $input_nama = trim($_POST["nama"]);
    if (empty($input_nama)) {
        $nama_err = "Please Enter A Valid Name!";
    } elseif (!filter_var($input_nama, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nama_err = "Please Enter A Valid Name!";
    } else {
        $nama = $input_nama;
    }

    $input_alamat = trim($_POST["alamat"]);
    if(empty($input_alamat)){
        $alamat_err = "Please enter your alamat";
    } else{
        $alamat = $input_alamat;
    }

    $input_hp = trim($_POST["hp"]);
    if(empty($input_hp)){
        $hp_err = "Please enter your nomer hp";
    } elseif(!ctype_digit($input_hp)){
        $hp_err = "Please enter a positive integer value.";
    } else{
        $hp = $input_hp;
    }

    $input_tgl_transaksi = trim($_POST["tgl_transaksi"]);
    if(empty($input_tgl_transaksi)){
        $tgl_transaksi_err = "Please enter tgl_transaksi.";
    } else{
        $tgl_transaksi = $input_tgl_transaksi;
    }

    $input_jenis_barang = trim($_POST["jenis_barang"]);
    if(empty($input_jenis_barang)){
        $jenis_barang_err = "Please enter jenis barang.";
    } else{
        $jenis_barang = $input_jenis_barang;
    }

    $input_nama_barang = trim($_POST["nama_barang"]);
    if(empty($input_nama_barang)){
        $nama_barang_err = "Please enter nama barang.";
    } else{
        $nama_barang = $input_nama_barang;
    }

    $input_jumlah = trim($_POST["jumlah"]);
    if(empty($input_jumlah)){
        $jumlah_err = "Please enter your jumlah.";
    } elseif(!ctype_digit($input_jumlah)){
        $jumlah_err = "Please enter a positive integer value.";
    } else{
        $jumlah = $input_jumlah;
    }

    $input_harga = trim($_POST["harga"]);
    if(empty($input_harga)){
        $harga_err = "Please enter your harga.";
    } elseif(!ctype_digit($input_harga)){
        $harga_err = "Please enter a positive integer value.";
    } else{
        $harga = $input_harga;
    }
    
    if (empty($nama_err) && empty($alamat_err) && empty($hp_err) && empty($tgl_transaksi_err) && empty($jenis_barang_err) && empty($nama_barang_err) && empty($jumlah_err) && empty($harga_err)){
        $sql = "UPDATE prasetya SET nama=?, alamat=?, hp=?, tgl_transaksi=?, jenis_barang=?, nama_barang=?, jumlah=?, harga=? WHERE id_pembeli=?";
        if ($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "ssisssiii", $param_nama, $param_alamat, $param_hp, $param_tgl_transaksi, $param_jenis_barang, $param_nama_barang, $param_jumlah, $param_harga, $param_id_pembeli);
            $param_nama = $nama;
            $param_alamat = $alamat;
            $param_hp = $hp;
            $param_tgl_transaksi = $tgl_transaksi;
            $param_jenis_barang = $jenis_barang;
            $param_nama_barang = $nama_barang;
            $param_jumlah = $jumlah;
            $param_harga = $harga;
            $param_id_pembeli = $id_pembeli;
            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something Went Wrong. Please Try Again Later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($con);
} else{
    if (isset($_GET["id_pembeli"]) && !empty(trim($_GET["id_pembeli"]))){
        $id_pembeli = trim($_GET["id_pembeli"]);
        $sql = "SELECT * FROM prasetya WHERE id_pembeli = ?";
        if ($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id_pembeli);
            $param_id_pembeli = $id_pembeli;
            if (mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
                echo "Oops! Something Went Wrong. Please Try Again Later.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else{
        header("location: error.php");
        exit();
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
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
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Update Data Pembeli</h2>
            </div>
            <p>Silahkan Mengisi Apabila Ingin Update Data Pembeli</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                    <label>Nama</label>
                    <textarea name="nama" class="form-control"><?php echo $nama; ?></textarea>                            
                    <span class="help-block"><?php echo $nama_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($alamat_err)) ? 'has-error' : ''; ?>">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?php echo $alamat; ?>">                          
                    <span class="help-block"><?php echo $alamat_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($hp_err)) ? 'has-error' : ''; ?>">
                    <label>Nomor Handphone</label>
                    <input type="number" name="hp" class="form-control" value="<?php echo $hp; ?>">
                    <span class="help-block"><?php echo $hp_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($tgl_transaksi_err)) ? 'has-error' : ''; ?>">
                    <label> Tanggal Transaksi</label>
                    <input type="date" name="tgl_transaksi" class="form-control" value="<?php echo $tgl_transaksi; ?>">
                    <span class="help-block"><?php echo $tgl_transaksi_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($jenis_barang_err)) ? 'has-error' : ''; ?>">
                    <label>Jenis Barang</label>
                    <input type="text" name="jenis_barang" class="form-control" value="<?php echo $jenis_barang; ?>">                         
                    <span class="help-block"><?php echo $jenis_barang_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($nama_barang_err)) ? 'has-error' : ''; ?>">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="<?php echo $nama_barang; ?>">                         
                    <span class="help-block"><?php echo $nama_barang_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($jumlah_err)) ? 'has-error' : ''; ?>">
                    <label>Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?php echo $jumlah; ?>">                         
                    <span class="help-block"><?php echo $jumlah_err;?></span>
                </div>

                <div class="form-group <?php echo (!empty($harga_err)) ? 'has-error' : ''; ?>">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?php echo $harga; ?>">                         
                    <span class="help-block"><?php echo $harga_err;?></span>
                </div>
                
                <input type="hidden" name="id_pembeli" value="<?php echo $id_pembeli; ?>"/>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>