<?php
// Include config file
require_once "config.php";

//Tentukan variabel dan inisialisasi dengan nilai kosong
$id_pembeli = $nama = $alamat = $hp = $tgl_transaksi = $jenis_barang = $nama_barang = $jumlah = $harga = "";
$id_pembeli_err = $nama_err = $alamat_err = $hp_err = $tgl_transaksi_err = $jenis_barang_err = $nama_barang_err = $jumlah_err = $harga_err = "";

// Memproses data formulir saat formulir dikirimkan
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_id_pembeli = trim($_POST["id_pembeli"]);
    if(empty($input_id_pembeli)){
        $id_pembeli_err = "Please enter id_pembeli.";
    } elseif(!ctype_digit($input_id_pembeli)){
        $id_pembeli_err = "Please enter a positive integer value.";
    } else{
        $id_pembeli = $input_id_pembeli;
    }

    // Validate name
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Please enter a name.";
    } elseif(!filter_var($input_nama)){
        $nama_err = "Please enter a valid name.";
    } else{
        $nama = $input_nama;
    }

    $input_alamat = trim($_POST["alamat"]);
    if(empty($input_alamat)){
        $alamat_err = "Please enter your alamat.";
    } else{
        $alamat = $input_alamat;
    }

    $input_hp = trim($_POST["hp"]);
    if(empty($input_hp)){
        $hp_err = "Please enter nomor handphone.";
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
        $jenis_barang_err = "Please enter jenis_barang.";
    } else{
        $jenis_barang = $input_jenis_barang;
    }

    $input_nama_barang = trim($_POST["nama_barang"]);
    if(empty($input_nama_barang)){
        $nama_barang_err = "Please enter nama_barang.";
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
        $jharga_err = "Please enter your harga.";
    } elseif(!ctype_digit($input_harga)){
        $harga_err = "Please enter a positive integer value.";
    } else{
        $harga = $input_harga;
    }

    // Check input errors before inserting in database
    if(empty($id_pembeli_err) && empty($nama_err) && empty($alamat_err) && empty($hp_err) && empty($tgl_transaksi_err) && empty($jenis_barang_err) && empty($nama_barang_err) && empty($jumlah_err) && empty($harga_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO prasetya (id_pembeli, nama, alamat, hp, tgl_transaksi, jenis_barang, nama_barang, jumlah, harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssissii", $param_id_pembeli, $param_nama, $param_alamat, $param_hp, $param_tgl_transaksi, $param_jenis_barang, $param_nama_barang, $param_jumlah, $param_harga);

            // Set paramaters
            $param_id_pembeli = $id_pembeli;
            $param_nama = $nama;
            $param_alamat = $alamat;
            $param_hp = $hp;
            $param_tgl_transaksi = $tgl_transaksi;
            $param_jenis_barang = $jenis_barang;
            $param_nama_barang = $nama_barang;
            $param_jumlah = $jumlah;
            $param_harga = $harga;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing pagr
                header("location: index.php");
                exit();
            } else{
                echo "Something went wring. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Data Pembeli</h2>
                    </div>
                    <p>Silahkan Mengisi Data Pembeli di Bawah Ini</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($id_pembeli_err)) ? 'has-error' : ''; ?>">
                            <label>ID Pembeli</label>
                            <input type="number" name="id_pembeli" class="form-control" value="<?php echo $id_pembeli; ?>">                            
                            <span class="help-block"><?php echo $id_pembeli_err;?></span>
                        </div>
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
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>