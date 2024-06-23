<?php
// Include file koneksi, untuk koneksikan ke database
include "koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Cek kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kode = input($_POST["kode"]);
    $nama_barang = input($_POST["nama_barang"]);
    $kategori = input($_POST["kategori"]);
    $stok = input($_POST["stok"]);
    $harga = input($_POST["harga"]);
    $status = input($_POST["status"]);
    $deskripsi = input($_POST["deskripsi"]);

    // Proses upload foto
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["foto"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_formats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $foto = $target_file;

            // Query input menginput data kedalam tabel
            $sql = "INSERT INTO catalog_sport_equip (kode, nama_barang, kategori, foto, stok, harga, status, deskripsi) VALUES ('$kode','$nama_barang','$kategori','$foto','$stok','$harga','$status','$deskripsi')";

            // Mengeksekusi query
            $hasil = mysqli_query($connection, $sql);

            // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
            if ($hasil) {
                header("Location: catalog.php");
                exit(); // untuk menghentikan eksekusi skrip
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan. Error: " . mysqli_error($connection) . "</div>";
            }

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang-Admin</title>
    <link href="css/create.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="main-container">
        <div class="flex-grow">
            <div class="bg-base-body">

                <!--NAVBAR  -->
                <header class="bg-navbar">
                    <nav class="navbar">
                        <div class="logo">
                            <a href="./homepage.html">
                                <img src="./img/catalog/logo.png" alt="">
                            </a>
                        </div>
                        <div class="profile">
                            <a href="#">
                                <img src="./img/catalog/chat.png" alt="">
                            </a>
                        </div>
                    </nav>
                </header>
                <!-- NAVBAR-END -->

                <!-- BODY-CONTENT -->
                <div class="bg-body-item">
                    <!-- CONTENT -->
                    <div class="content">
                        <p class="title-content">Tambah Barang Baru</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="form-group-container">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Kategori </label>
                                    <select name="kategori" class="form-control" required>
                                        <option value="Fitness">Fitness</option>
                                        <option value="Badminton">Badminton</option>
                                        <option value="Football">Football</option>
                                        <option value="Volleyball">Volleyball</option>
                                        <option value="Tenis">Tenis</option>
                                        <option value="Golf">Golf</option>
                                        <option value="Billiard">Billiard</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Foto </label>
                                    <input type="file" name="foto" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Stok </label>
                                    <input type="number" name="stok" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" step="0.01" name="harga" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label>Status </label>
                                    <select name="status" class="form-control" required>
                                        <option value="Ready">Ready</option>
                                        <option value="Full Booking">Full Booking</option>
                                        <option value="Full Rent">Full Rent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" required />
                                </div>
                            </div>

                            <div class="button-group">
                                <button type="button" onclick="window.location.href='catalog.php';"
                                    class="btn-back">Kembali</button>
                                <button type="submit" name="submit" class="btn-input">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CLOSE BODY-CONTENT -->
            </div>
        </div>

        <footer class="footer">
            <p class="copyright">
                Copyright &copy 2024 Sport Equip
            </p>
        </footer>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>