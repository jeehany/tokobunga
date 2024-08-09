<?php
    require "session.php";
    require "../koneksi.php";

    $queryProduk = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a. 
    kategori_id=b.id");
    $jumlahProduk = mysqli_num_rows($queryProduk);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="body">
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted"> 
                        <i class="fas fa-home"></i> Home 
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Product
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Add Product</h3>

            <form action="" class="row g-3" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" autocomplete="off" class="form-control"
                    required>
                </div>
                <div class="col-md-6">
                    <label for="kategori">Category</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="">--category--</option>
                       <?php
                            while($data=mysqli_fetch_array($queryKategori)){
                        ?>
                            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                        <?php
                            }                       
                       ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" required>
                </div>
                <div class="col-md-6">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button class="btn warna1" type="submit" name="simpan">
                        Save 
                    </button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $kategori = htmlspecialchars($_POST['kategori']);
                    $harga = htmlspecialchars($_POST['harga']);
                   
                    $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                    $target_dir = "../img/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama=='' || $kategori=='' || $harga==''){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, Kategori dan Harga Wajib Diisi
                        </div>
            <?php
                    }
                    else{
                        if($nama_file!=''){
                            if($image_size > 500000){
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 500 Kb
                                </div>
            <?php                   
                            }
                            else{
                                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        tipe file salah
                                    </div>
            <?php   
                                }
                                else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name); 
                                }
                            }
                        }

                        //query insert into table
                        $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, 
                        foto, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', 
                        '$new_name', '$ketersediaan_stok')");

                        if($queryTambah){
            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Data Saved Successfully!
                            </div>

                            <meta http-equiv="refresh" content="0; url=produk.php" />                           
            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
                }
            ?>

            <?php
                if(isset($_POST['simpan_Produk'])){
                    $produk = htmlspecialchars($_POST['produk']);

                    $queryExist = mysqli_query($con, "SELECT nama FROM produk WHERE
                    nama='$produk'");
                    $jumlahDataProdukBaru = mysqli_num_rows($queryExist);

                    if($jumlahDataProdukBaru > 0){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            The Data Already Exists!
                        </div>
                        <?php
                    }
                    else{
                        $querySimpan = mysqli_query($con, "INSERT INTO produk (nama) VALUES
                        ('$produk')");

                        if($querySimpan){
                            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Data Saved Successfully!
                            </div>

                            <meta http-equiv="refresh" content="0; url=produk.php" />
                            <?php
                        }
                        else{
                            echo mysqli_error($con);
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3 mb-5">
            <h2>List Product</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketersediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahProduk == 0){
                        ?>
                            <tr>
                                <td colspan=6 class="text-center">Tidak ada data Produk</td>
                            </tr>
                        <?php
                            }
                            else{
                                $number = 1;
                                while($data=mysqli_fetch_array($queryProduk)){
                        ?>
                                    <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['nama_kategori']; ?></td>
                                        <td><?php echo $data['harga']; ?></td>
                                        <td><?php echo $data['ketersediaan_stok']; ?></td>
                                        <td>
                                            <a href="produk-detail.php?p=<?php echo $data['id'] ?>"
                                            class="btn warna1"><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                $number++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>