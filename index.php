<?php
    require "koneksi.php";
    $queryProduk = mysqli_query($con, "SELECT id, nama, harga, foto FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bunga | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="body">
    <?php require "navbar.php"; ?>

    <!--banner-->
    <div class="container-fluid home d-flex align-items-center">
        <div class="myElement container text-center text-white">
            <h2>Find Your Own Happiness</h2>
            <br />
            <h5>
                Make a bouquet and pick up a gift with <br /> your wishes. deliver to any 
                corner of the city
            </h5>
            <div class="col-md-8 offset-md-2">
                <form action="produk.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Find your Bouquet" 
                        aria-label="Recipient's username" aria-describedby="basic-addon2" 
                        name="keyword" autocomplete="off">
                        <button type="submit" class="btn warna1 text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--highlighted about-->
    <section>
        <div class="container-fluid">
            <div class="text">
                <h2>Category</h2>
                <p>
                    Kategori "Wrapped Bouquet" menawarkan buket bunga yang elegan dengan 
                    perincian yang teliti, menciptakan pilihan indah untuk berbagai kesempatan. 
                    "Bloom Box" menyajikan kotak bunga modern yang memukau, memberikan tampilan 
                    unik dan elegan untuk hadiah yang tak terlupakan. Sementara itu, dalam kategori 
                    "Joyful Balloon," kesenangan dan semangat terpancar melalui penataan balon yang 
                    ceria, menambahkan sentuhan riang pada perayaan spesial. Tiga pilihan ini dirancang 
                    untuk memberikan kebahagiaan dengan gaya yang unik dan menyenangkan.
                </p>
                <br /><br /><br />
                <div class="banner">
                    <div class="banner-img md-4">
                        <a href="produk.php?kategori=Wrapped Bouquet">
                            <img src="img/calla bouquet.jpg" />
                            <div class="caption">Wrapped Bouquet</div>
                        </a>
                    </div>
                    <div class="banner-img md-4">
                        <a href="produk.php?kategori=Bloom Box">
                            <img src="img/soft pink & white true love .jpg" />
                            <div class="caption">Bloom Box</div>
                        </a>
                    </div>
                    <div class="banner-img md-4">
                        <a href="produk.php?kategori=Joyful Balloon">
                            <img src="img/Additional Plain Balloon.jpg" />
                            <div class="caption">Joyful Balloon</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--highlighted produk-->
    <section>
        <div class="container-fluid py-5">
            <div class="container text-center text">
                <h2>Product</h2>
                <p>
                    Temukan keindahan dalam kategori "Wrapped Bouquet" dengan buket bunga 
                    yang penuh cinta, menyajikan kelembutan dan keanggunan dalam kemasan 
                    yang elegan. Jelajahi pesona kotak bunga modern dalam "Bloom Box," di mana 
                    setiap bunga dipilih dengan hati-hati untuk menciptakan tampilan unik dan 
                    elegan. Untuk menyemarakkan setiap perayaan, pilih "Joyful Balloon" yang 
                    menawarkan penataan balon ceria dan menyenangkan. 
                    <br><br/> 
                    Klik tombol "See More" untuk mengeksplorasi berbagai pilihan dan pilihlah 
                    produk yang sempurna untuk memberikan sentuhan spesial pada momen berharga Anda.
                </p>
            </div>

            <div class="container text-center">
                <div class="row mt-5">
                    <?php while($data = mysqli_fetch_array($queryProduk)){?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="img/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['nama']; ?></h5>
                                <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna2 text-black">See Product</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <a class="btn warna1 mt-3" href="produk.php">See More</a>
            </div>
        </div>
    </section>

    <!--footer-->
    <?php require "footer.php"?>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>