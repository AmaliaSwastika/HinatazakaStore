<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <title>Register</title>
</head>
<body>
        <?php
            require ('config.php');
            session_start();

            $error = '';
            $validate = '';
            if(isset($_SESSION['user'])) header('Location: index.php');
            if(isset($_POST['submit'])){
                $username = stripslashes($_POST['username']);
                $username = mysqli_real_escape_string($con, $username);
                $nama = stripslashes($_POST['name']);
                $nama = mysqli_real_escape_string($con, $nama);
                $email = stripslashes($_POST['email']);
                $email = mysqli_real_escape_string($con, $email);
                $password = stripslashes($_POST['password']);
                $password = mysqli_real_escape_string($con, $password);
                $repass = stripslashes($_POST['repassword']);
                $repass = mysqli_real_escape_string($con, $repass);

                if (!empty(trim($nama)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
                    if ($password == $repass){
                        if (cek_nama($nama,$con) == 0){
                            $pass = password_hash($password, PASSWORD_DEFAULT);
                            $query = "INSERT INTO users (name,username,email,password) VALUES ('$nama','$username','$email','$pass')";
                            $result = mysqli_query($con, $query);
                            if ($result){
                                $_SESSION['username'] = $username;
                                header('Location: index.php');
                            } else{
                                $error = 'Register User Gagal !';
                            }
                        } else{
                            $error = 'Username Sudah Terdaftar !';
                        }
                    } else{
                        $validate = 'Password tidak sama !';
                    }
                } else{
                    $error = 'Data tidak boleh kosong !';
                }
            }
            function cek_nama($username,$con){
                $name = mysqli_real_escape_string($con,$username);
                $query = "SELECT * FROM users WHERE username = '$name'";
                if ($result = mysqli_query($con,$query)) return mysqli_num_rows($result);
            }
        ?>
            <section>
                <section>
                    <section>
                        <form action="register.php" method="POST">
                        <h4 class="text-center">Sign Up</h4>
                            <?php if ($error != ''){ ?>
                                <div class="alert-danger" role="alert"><?= $error; ?></div>
                            <?php }?>
                        <div class = "form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama">
                        </div>
                        <div class = "form-group">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Masukkan Email">
                        </div>
                        <div class = "form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
                        </div>
                        <div class = "form-group">
                            <label for="InputPassword">Password</label>
                            <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Masukkan Password">
                            <?php if ($validate != ''){ ?>
                                <p class="text-danger"><?=$validate;?></p>
                            <?php }?>
                        </div>
                        <div class = "form-group">
                            <label for="InputPassword">Repassword</label>
                            <input type="password" class="form-control" id="InputPasswpod" name="repassword" placeholder="Re-Password">
                            <?php if ($validate != ''){ ?>
                                <p class="text-danger"><?=$validate;?></p>
                            <?php }?>
                        </div>
                        <button type="submit" name ="submit" class="btn btn-primary">Register</button>
                            <div class="form-footer mt-2">
                                <p>Sudah Punya Akun? <a href="login.php">Login</a></p>
                            </div>
                        </form>
                    </section>
                </section>
            </section>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-98i/ X+965Dz00rT7abK41JStQIAqVgRVzpbzo5smXKp4YFRVH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBkOWLaUAdn689aCwoqbBJiSnjAK/18WVCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6Zbwh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTY" crossorigin="anonymous"></script>
</body>
</html>