<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "toko_kuliner";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

$id_produk="";
$nama="";
$stok="";
$harga="";
$image="";
$error="";
$sukses="";

if(isset($_GET['op'])){
     $op=$_GET['op'];
}else{
    $op="";
}

if($op =='delete'){
    $id_produk=$_GET['id'];
    $sql1="delete from produk where id_produk='$id_produk'";
    $q1=mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses="berhasil hapus data";
    }else{
        $error="gagal hapus data";
    }
}

if($op=='edit'){
    $id_produk=$_GET['id'];
    $sql1="select * from produk where id_produk = '$id_produk'";
    $q1=mysqli_query($koneksi,$sql1);
    $r1=mysqli_fetch_array($q1);
    $nama=$r1['nama'];
    $stok=$r1['stok'];
    $harga=$r1['harga'];
    $image=$r1['image'];

    if($nama==''){
        $error="data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $nama=$_POST['nama'];
    $stok=$_POST['stok'];
    $harga=$_POST['harga'];
    $image=$_FILES['image']['name'];
    $ekstensi1= array('png','jpg','jpeg');
    $x = explode('.',$image);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['image']['tmp_name'];

    if(in_array($ekstensi,$ekstensi1)=== true){
        move_uploaded_file($file_tmp, 'bahanimg/'.$image);
    }else{
        echo"<script> alert('ekstensi tidak diperbolehkan')</script>";
    }

    if($nama && $stok && $harga && $image){

        if($op=='edit'){
            $sql1="update produk set nama='$nama', stok='$stok' ,harga='$harga',image='$image' where id_produk='$id_produk' ";
            $q1=mysqli_query($koneksi,$sql1);
            if($q1){
                $sukses="data berhasil diupdate";
            }else{
                $error="data gagal diupdate";
            }
        }else{
            $sql1="insert into produk(nama,stok,harga,image) values ('$nama',$stok,'$harga','$image')";
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
    <title>Data produk</title>
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
            width: 600px
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
        <li class="nav-item">
          <a class="nav-link" href="halamantransaksi.php">Halaman Transaksi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="halamanuser.php">Halaman User</a>
          </li>
        <form class="d-flex mt-3" role="search">
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
                Create / edit data
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
                 header("refresh:5;url=halamanbarang.php");
                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">nama</label></label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stok" class="form-label">stok</label></label>
                        <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok ?>">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">harga</label></label>
                        <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
                    </div>
                    <div class="mb-3">
                        <input type="file" class="form-control" id="image" name="image" value="<?php echo $image ?>">
                    </div>
            </div>
            <div class="col-12">
                 <input type="submit" name="simpan" value="simpan data" class="btn btn-primary">
            </div>
            </form>
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    data produk ditoko
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id_produk</th>
                                <th scope="col">nama</th>
                                <th scope="col">stok</th>
                                <th scope="col">harga</th>
                                <th scope="col">image</th>
                            </tr>
                            <tbody>
                                <?php
                                 $sql2="select * from produk order by id_produk desc";
                                 $q2=mysqli_query($koneksi,$sql2);
                                 $urut=1;
                                 while($r2=mysqli_fetch_array($q2)){
                                    $id_produk=$r2['id_produk'];
                                    $nama=$r2['nama'];
                                    $stok=$r2['stok'];
                                    $harga=$r2['harga'];
                                    $image=$r2['image'];
                                 
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td scope="row"><?php echo $id_produk ?></td> 
                                        <td scope="row"><?php echo $nama ?></td>
                                        <td scope="row"><?php echo $stok  ?></td>
                                        <td scope="row"><?php echo $harga ?></td>
                                        <td scope="row"><img src="bahanimg/<?=$image?>" class="img-thumbnail" widht="100px" height="100px"></td>
                                        <td scope="row">
                                        <a href="halamanbarang.php?op=edit&id=<?php echo $id_produk ?>"> <button type="button" class="btn btn-danger">Edit</button></a>
                                        <a href="halamanbarang.php?op=delete&id=<?php echo $id_produk ?>"onclick="return confirm('yakin ingin delete?')"><button type="button" class="btn btn-warning">Delete</button></a>

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