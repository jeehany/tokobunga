<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['p'];

    $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a. 
    kategori_id=b.id WHERE a.id='$id'");
    $data = mysqli_fetch_array($query);

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

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
    <title>Detail Produk</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="body">
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <h2>Product Details</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" class="row g-3" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; 
                    ?>" autocomplete="off" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="kategori">Category</label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data
                        ['nama_kategori']; ?></option>
                       <?php
                            while($dataKategori=mysqli_fetch_array($queryKategori)){
                        ?>
                            <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori
                            ['nama']; ?></option>
                        <?php
                            }                       
                       ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" value="<?php echo $data['harga']; ?>"
                    name="harga" required>
                </div>
                <div class="col-md-6">
                    <label for="currentFoto">Now Product Photos</label>
                    <img src="../img/<?php echo $data['foto'] ?>" alt="" width="300px" 
                    class="form-control" >
                </div>
                <div class="col-md-6">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <?php 
                            if($data['ketersediaan_stok'] == 'tersedia') { 
                        ?>
                            <option value="tersedia" selected>Tersedia</option>
                            <option value="habis">Habis</option>
                        <?php 
                            }
                            else { 
                        ?>
                            <option value="tersedia">Tersedia</option>
                            <option value="habis" selected>Habis</option>
                        <?php 
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn warna1" name="simpan">Save</button>
                    <button type="submit" class="btn warna2" name="hapus">Delete</button>

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
                        $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', 
                        nama='$nama', harga='$harga', 
                        ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");

                        if($nama_file!=''){
                            if($image_size > 500000){
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 500 Kb
                                </div>
            <?php     
                            }
                            else{
                                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType 
                                != 'gif'){
            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        tipe file salah
                                    </div>
            <?php   
                                }
                                else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name); 
                                    
                                    $queryUpdate = mysqli_query($con, "UPDATE produk SET 
                                    foto='$new_name' WHERE id='$id'");

                                    if($queryUpdate){
            ?>
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Data Updated Successfully!
                                        </div>
            
                                        <meta http-equiv="refresh" content="0; url=produk.php" />                           
            <?php
                                    }
                                    else{
                                        echo mysqli_error($con);
                                    }
                                }
                            }
                        }
                    }
                }

                if(isset($_POST['hapus'])){
                    $queryHapus = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
                    
                    if($queryHapus){
            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Product Successfully Deleted!
                            </div>

                            <meta http-equiv="refresh" content="0; url=produk.php" />
            <?php
                    }
                }
            ?>
        </div>
    </div>
    
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>