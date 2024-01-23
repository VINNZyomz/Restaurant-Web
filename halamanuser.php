<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "toko_kuliner";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$id="";
$username="";
$alamat="";
$email="";
$password="";
$error="";
$sukses="";

if(isset($_GET['op'])){
     $op=$_GET['op'];
}else{
    $op="";
}

if($op =='delete'){
    $id=$_GET['id'];
    $sql1="delete from pembeli where id='$id'";
    $q1=mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses="berhasil hapus data";
    }else{
        $error="gagal hapus data";
    }
}

if($op=='edit'){
    $id=$_GET['id'];
    $sql1="select * from pembeli where ID = '$id'";
    $q1=mysqli_query($koneksi,$sql1);
    $r1=mysqli_fetch_array($q1);
    $username=$r1['username'];
    $alamat=$r1['alamat'];
    $email=$r1['email'];
    $password=$r1['password'];

    if($username==''){
        $error="data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $username=$_POST['username'];
    $alamat=$_POST['alamat'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    if($username && $alamat && $email && $password){

        if($op=='edit'){
            $sql1="update barang set username='$username',alamat='$alamat',email='$email',password='$password' where id='$id' ";
            $q1=mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses="data berhasil diupdate";
            }else{
                $error="data gagal diupdate";
            }
        }else{
            $sql1="insert into pembeli(username,alamat,email,password) values ('$username','$alamat','$email','$password')";
        $q1=mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses="berhasil memasukan data baru";
        }else{
            $error="gagal memasukan data";
        }
        }
    }else{
        $error="silakan masukan datanya";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data barang</title>
    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<nav class="navbar bg-body-tertiary fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="#">Halaman Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <a class="nav-link" href="halamantransaksi.php">Halaman Transaksi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="halamanbarang.php">Halaman Barang</a>
          </li>
        <form class="d-flex 
        <"form class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Toko Kuliner
            </div>
            <div class="card-body">
                <?php
                if($error){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>                
                <?php
                }
                ?>
            <div class="card-body">
                <?php
                if($sukses){
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>                
                <?php
                 header("refresh:5;url=halamanuser.php");
                }
                ?>
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Akun User
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">username</th>
                                <th scope="col">alamat</th>
                                <th scope="col">email</th>
                                <th scope="col">password</th>
                                
                                
                            </tr>
                            <tbody>
                                <?php
                                 $sql2="select * from pembeli";
                                 $q2= mysqli_query($koneksi,$sql2);
                                 $urut=1;
                                 while($r2= mysqli_fetch_array($q2)){
                                    $username=$r2['username'];
                                    $alamat=$r2['alamat'];
                                    $email=$r2['email'];
                                    $password=$r2['password'];

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $username ?></td>
                                        <td scope="row"><?php echo $alamat ?></td>
                                        <td scope="row"><?php echo $email?></td>
                                        <td scope="row"><?php echo $password?></td>

                                        

                                        </td>
                                    </tr>
                                    <?php
                                 }
                                ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
</body>

</html>