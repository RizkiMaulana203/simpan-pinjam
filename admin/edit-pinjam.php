<?php 
  
  include('../koneksi.php');
  
  $id = $_GET['id'];
  
  $query = "SELECT * FROM peminjaman WHERE id_peminjaman = $id LIMIT 1";

  $result = mysqli_query($kon, $query);

  $row = mysqli_fetch_array($result);

  ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Pinjam</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              EDIT PINJAMAN
            </div>
            <div class="card-body">
              <form action="update-pinjam.php" method="POST">
                
                <div class="form-group">
                  <label>TANGGAL KEMBALI</label>
                  <input type="date" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali'] ?>" placeholder="Masukkan Tanggal Kembali" class="form-control">
                  <input type="hidden" name="id_peminjaman" value="<?php echo $row['id_peminjaman'] ?>">
                </div>

                <div class="form-group">
                  <label>STATUS PEMINJAMAN</label>
                  <input type="text" name="status_peminjaman" value="<?php echo $row['status_peminjaman'] ?>" placeholder="Masukkan Status Peminjaman" class="form-control">
                </div>

                <div class="form-group">
                  <label>JUMLAH</label>
                  <input type="text" name="jumlah" value="<?php echo $row['jumlah'] ?>" placeholder="Masukkan Jumlah Peminjaman" class="form-control">
                </div>

               
                
                <button type="submit" class="btn btn-dark">UPDATE</button>
                <button type="reset" class="btn btn-warning">RESET</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>