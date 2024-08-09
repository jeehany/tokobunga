<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bunga | Order</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="body">
    <?php require "navbar.php"; ?>

    <!--- banner --->
    <div class="container-fluid home2 d-flex align-items-center">
        <div class="container">
            <h1 class="myElement text-white text-center">Order</h1>
        </div>
    </div>
    
    <section>
        <div class="container-fluid py-3">
            <div class="container text-center text">
                <h4>How To Order</h4>
            </div>
        </div>
        <form class="row g-3">
            <div class="col-12">
                <label for="inputNama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="inputNomor" class="form-label">No. WhatsApp</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-12">
                <label for="inputAlamat" class="form-label">Alamat Lengkap</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="inputKategori" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" placeholder="Wrapped Bouquet, Bloom Box, or Joyfull Balloon">
            </div>
            <div class="col-md-6">
                <label for="inputProduk" class="form-label">Nama Pesanan</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-12">
                <a href="https://api.whatsapp.com/send?phone=6285388999694" 
                    target="_blank" class="btn warna1">Order</a>
            </div>
        </form> 
    </section>

    <!--footer-->
    <br><br/>
    <?php require "footer.php"?>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>