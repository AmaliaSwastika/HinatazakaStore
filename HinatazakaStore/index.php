<?php
session_start();
if ( !isset($_SESSION['username']) ){
    $_SESSION['msg'] = 'anda harus login untuk mengakses halaman ini';
    header('Location: login.php');
}

?>

<?php require "config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <title>Data Pembeli - Amalia Swastika I P (2107412005)</title>
    <style type="text/css">
        .wrapper{
            width: 1200px;
            margin: 0 auto; 
        }
        .page-header{
            margin-top: 0px;
            border-bottom-width: 3px;
            border-bottom-color: #B0E0E6;
        }
        .tbody-thead{
            color: black;
            background-color: #9ADCFF;
            font-size: bold;
        }
        .bg{
            background-color: #D9D7F1;
        }
        .table-bordered{
            background-color: #FFF89A;
        }
        table tr td:last-child a{
            margin-right: 10px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<link rel="stylesheet" href="Style.css">
<div class="header">
    <nav>
        <ul>
            <h4><li class="active"><a href="index.php">Home</a></li>
            <li><a href="create.php">Tambah Data Pembeli</a></li>
            <li><a href="logout.php">Logout</a></li></h4>
        </ul>
        <form method="get">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" name="search" id="form1" placeholder="Cari Data Pembeli" class="form-control" />
                </div>
                    <input type="submit" class="btn btn-primary" value="Search">
            </div>
        </form>
    </nav>
</div>

<div class="bg">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">HINATAZAKA Store</h2>
                    </div>
                    <div class="wrapper">
                        <div class="row">
                        <table class='table table-bordered '>
                        <thead class='tbody-thead'>
                            <tr>
                                <th>ID Pembeli</th>
                                <th>Nama</th>
                                <th>Nomor Handphone</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Total Bayar</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                            <tbody>
    </div>


<?php
    $batas = 5;
    $halaman = @$_GET['halaman'];
    if(empty($halaman)){
        $posisi = 0;
        $halaman = 1;
    }
    else{
        $posisi = ($halaman-1) * $batas;
    }
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $sql="SELECT * from prasetya WHERE nama LIKE '%$search%' order by id_pembeli asc limit $posisi, $batas";
    }else{
        $sql="SELECT * from prasetya order by nama asc limit $posisi,$batas";
    }
        $hasil=mysqli_query($con, $sql);
        while ($data = mysqli_fetch_array($hasil)){
?>
                             

<tr>
    <td><?= $data['id_pembeli'] ?> </td>
    <td><?= $data['nama'] ?> </td>
    <td><?= $data['hp'] ?></td>
    <td><?= $data['nama_barang'] ?> </td>
    <td><?= $data['harga'] ?> </td>
    
    <td><?= $data['harga'] * $data['jumlah']?></td>

    <td>
        <a href="read.php?id_pembeli=<?= $data['id_pembeli'] ?>" title='View Record' data-toggle='tooltip'>
        <span class='glyphicon glyphicon-eye-open'></span></a>

        <a href="update.php?id_pembeli=<?= $data['id_pembeli'] ?>"title='Update Record' data-toggle='tooltip'>
        <span class='glyphicon glyphicon-pencil'></span></a>

        <a href="delete.php?id_pembeli=<?= $data['id_pembeli'] ?>"title='Delete Record' data-toggle='tooltip'>
        <span class='glyphicon glyphicon-trash' ></span></a>
   </td>
        <?php }
        ?>  
</tr>

<?php
    if(isset($_GET['search'])){
    $search = $_GET['search'];
    $query2 = "SELECT id_pembeli,nama,alamat,hp,tgl_transaksi,jenis_barang,nama_barang,jumlah,harga from prasetya WHERE nama LIKE '%$search%' order by id_pembeli asc";
    }else{
    $query2 = "SELECT id_pembeli,nama,alamat,hp,tgl_transaksi,jenis_barang,nama_barang,jumlah,harga from prasetya order by id_pembeli asc";
    }
    $result2 = mysqli_query($con, $query2);
    $jmldata = mysqli_num_rows($result2);
    $jmlhalaman = ceil($jmldata/$batas);
?>

                            </tbody>
                        </table>
                    </div>

                        <br>
                        <ul class="pagination">
                            <?php
                            for($i=1;$i<=$jmlhalaman;$i++){
                                if ($i !=$halaman){
                                    if(isset($_GET['search'])){
                                        $search = $_GET['search'];
                                        echo "<li class='page-item'><a class='page-link' href='index.php?halaman=$i&search=$search'>$i</a></li>";
                                    }else{
                                        echo "<li class='page-item'><a class='page-link' href='index.php?halaman=$i'>$i</a></li>";
                                    }

                                }else{
                                    echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                                }
                            }
                            ?>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>                     