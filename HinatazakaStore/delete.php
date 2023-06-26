<?php
if(isset($_POST["id_pembeli"]) && !empty($_POST["id_pembeli"])){
    require_once "config.php";
    $sql = "DELETE FROM prasetya WHERE id_pembeli = ?";
    if ($stmt = mysqli_prepare($con, $sql)){
        mysqli_stmt_bind_param($stmt,"i", $param_id_pembeli);
        $param_id_pembeli = trim($_POST["id_pembeli"]);
        if (mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something Went Wrong. Please Try Again Later.";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else{
    if (empty(trim($_GET["id_pembeli"]))){
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
    <title>View Record</title>
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
                        <h1>Delete Data Pembeli</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger fade in">
                        <input type="hidden" name="id_pembeli" value="<?php echo trim($_GET["id_pembeli"]); ?>"/>
                        <p>Anda Yakin Ingin Menghapus Data Ini?</p><br>
                        <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="index.php" class="btn btn-default">No</a>
                        </p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
