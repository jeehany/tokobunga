<?php
    require "koneksi.php";

    $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

    //get produk by keyword
    if(isset($_GET['keyword'])){
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
    }
    //get produk by kategori
    else if(isset($_GET['kategori'])){
        $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
        $kategoriId = mysqli_fetch_array($queryGetKategoriId);
        
        $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
    }
    // get produk default    
    else{
        $queryProduk = mysqli_query($con, "SELECT * FROM produk");
    }

    $countData = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bunga | Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="body">
    <?php require "navbar.php"; ?>

    <!--- banner --->
    <div class="container-fluid home2 d-flex align-items-center">
        <div class="container">
            <h1 class="myElement text-white text-center">Product</h1>
        </div>
    </div>
    
    <!--- body --->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3 mb-5 text">
                <h3>Category</h3>
                <ul class="list-group mt-3">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                    <a class="no-decoration" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                        <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                    </a>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="text">
                    <h3 class="text-center mb-3">Product</h3>
                </div>
                <div class="row mt-2">
                    <?php 
                        if($countData<1){
                    ?>
                        <h5 class="text-center my-5">Product Not Found</h5>
                    <?php
                        }
                    ?>

                    <?php while($produk = mysqli_fetch_array($queryProduk)){?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="img/<?php echo $produk['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produk['nama']; ?></h5>
                                <p class="card-text text-harga">Rp <?php echo $produk['harga']; ?></p>
                                <a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" class="btn 
                                    warna2 text-black">See Product</a>
                            </div>
                        </div>
                    </div>   
                    <?php } ?> 
                </div>
            </div>
        </div>
    </div>

    <!---footer--->
    <?php require "footer.php"?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>