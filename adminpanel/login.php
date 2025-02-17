<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

</head>

<body class="body">
    <div class ="main d-flex flex-column justify-content-center align-items-center">
        <div class="warna5 login-box p-5 shadow">
            <form action=""method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"
                    id="username">
                </div>  
                <div>
                    <label for="password">password</label>
                    <input type="password" class="form-control" name="password"
                    id="password">
                </div>     
                <div>
                    <button class="btn warna4 form-control mt-3" 
                    type="submit" name="loginbtn">login</button>
                </div>      
            </form>
        </div>
        <div class=mt-3>
            <?php
                if(isset($_POST['loginbtn'])){
                    $username= htmlspecialchars($_POST['username']);
                    $password= htmlspecialchars($_POST['password']);

                    $query = mysqli_query($con, "SELECT * FROM users WHERE 
                    username = '$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if($countdata>0){ 
                        if (password_verify($password, $data['password'])) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: ../adminpanel');

                        }
                        else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                                password salah
                            </div>
                            <?php 
                        }    
                    }    
                    else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Akun tidak tersedia
                        </div>
                        <?php    
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
