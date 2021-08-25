<?php


		 //Fungsi untuk mencegah inputan karakter yang tidak sesuai
		 function input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		//Cek apakah ada kiriman form dari method post
		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			session_start();
			include "koneksi.php";
			$username = input($_POST["username"]);
			$p = input(md5($_POST["password"]));

			$sql = "SELECT * from petugas where username='".$username."' and password='".$p."' limit 1";
			$hasil = mysqli_query ($kon,$sql);
			$jumlah = mysqli_num_rows($hasil);

			if ($jumlah>0) {
				$row = mysqli_fetch_assoc($hasil);
				$_SESSION["id_petugas"]=$row["id_petugas"];
				$_SESSION["username"]=$row["username"];
				$_SESSION["nama_petugas"]=$row["nama_petugas"];
				$_SESSION["id_level"]=$row["id_level"];
		
		
				if ($_SESSION["id_level"]=$row["id_level"]==1)
				{
					header("Location:admin/dashboard.php");
				} else if ($_SESSION["id_level"]=$row["id_level"]==2)
				{
					header("Location:operator/operator_dashboard.php");
				}else if ($_SESSION["id_level"]=$row["id_level"]==3){
					header("Location:member/member_dashboard.php");
				}
		
				
			}else {
				echo "<div>
				<strong>Error!</strong> Username dan password salah. 
			  <br><a href='index.php'>Klik disini</a></div>";
			}

		}
	
	?>






	