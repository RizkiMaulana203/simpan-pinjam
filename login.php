<!DOCTYPE html>
<html>
<head>
  <title>form Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto">
        <div class="img-left d-none d-md-flex"></div>

          <?php
     // fungsinya untuk menerima inputan dari form login
     function input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    // fungsinya untuk mengecek username dan password ada atau tidak di tabel petugas
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      session_start();
      include "koneksi.php";
      $username = input($_POST["username"]);
      $password = input(md5($_POST["password"]));

      $query = "SELECT * from user where username='".$username."' and password='".$password."' limit 1";
      $hasil = mysqli_query ($kon,$query);
      $jumlah = mysqli_num_rows($hasil);

      if ($jumlah>0) {
        $row = mysqli_fetch_assoc($hasil);
        $_SESSION["id_user"]=$row["id_user"];
        $_SESSION["username"]=$row["username"];
        $_SESSION["nama_user"]=$row["nama_user"];
        $_SESSION["id_level"]=$row["id_level"];
    
    // fungsinya untuk meredirect user ke halaman sesuai dengan levelnya (memindahkan secara paksa user berdasarkan levelnya)
        if ($_SESSION["id_level"]=$row["id_level"]==1)
        {
          header("Location:admin/dashboard.php");
        } else if ($_SESSION["id_level"]=$row["id_level"]==2)
        {
          header("Location:operator/index.php");
        }else if ($_SESSION["id_level"]=$row["id_level"]==3){
          header("Location:peminjam.php");
        }
    
        
      }else {
        echo "<div>
        <strong>Error!</strong> Username dan password salah. 
        </div>";
      }

    }
  
  ?>
  <!-- form login action php self mengirim data kehalaman ini lalu diolah dihalaman ini juga , post adalah method php untuk mengirim data -->

        <div class="card-body">
          <h4 class="title text-center mt-4">
            Login</h4>
            <form class="form-box px-3" action="cek_login.php" method="post">
              <div class="form-input">
                <span><i class="fa fa-envelope-o"></i></span>
                <input type="text" name="username" placeholder="Username" tabindex="10" required="">
              </div>
              <div class="form-input">
                <span><i class="fa fa-key"></i></span>
                <input type="password" name="password" placeholder="password" required="">
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-block text-uppercase">Login</button>
              </div>
            </form>
          </h4>
        </div>
      </div>
    </div>
  </div>
 
</body>
</html>