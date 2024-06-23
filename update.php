<?php
include "koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    if (isset($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    } else {
        $data = '';
    }
    return $data;
}

// Initialize $data array
$data = [
    'kode' => '',
    'nama_barang' => '',
    'kategori' => '',
    'foto' => '',
    'stok' => '',
    'harga' => '',
    'status' => '',
    'deskripsi' => ''
];

// Cek nilai yang dikirim menggunakan method GET dengan kode
if (isset($_GET['kode'])) {
    $kode = input($_GET["kode"]);

    $sql = "SELECT * FROM catalog_sport_equip WHERE kode='$kode'";
    $hasil = mysqli_query($connection, $sql);
    if ($hasil) {
        $data = mysqli_fetch_assoc($hasil);
    }
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

    // Proses upload file foto
    $foto = $_FILES['foto']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($foto);

    if (!empty($foto)) {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $foto = $target_file;
        } else {
            $foto = $data['foto']; // jika gagal upload, gunakan foto lama
        }
    } else {
        $foto = $data['foto']; // jika tidak ada upload baru, gunakan foto lama
    }

    // Query update data pada tabel catalog_sport_equip
    $sql = "UPDATE catalog_sport_equip SET
            nama_barang='$nama_barang',
            kategori='$kategori',
            foto='$foto',
            stok='$stok',
            harga='$harga',
            status='$status',
            deskripsi='$deskripsi'
            WHERE kode='$kode'";

    // Mengeksekusi atau menjalankan query
    $hasil = mysqli_query($connection, $sql);

    // Kondisi berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: catalog.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Barang</title>

    <link href="css/update.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="icon" href="img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

                    <div class="content">
                        <p class="title-content">Edit Data Barang</p>

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?kode=' . $data['kode']);?>" method="post" enctype="multipart/form-data">
                            <div class="form-group-container">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" value="<?php echo isset($data['kode']) ? $data['kode'] : ''; ?>" required readonly />
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control" value="<?php echo isset($data['nama_barang']) ? $data['nama_barang'] : ''; ?>" required />
                                </div>
                                <div class="form-group">
                                label>Kategori </label>
                                    <select name="kategori" class="form-control" required>
                                        <option value="Fitness" <?php echo isset($data['kategori']) && $data['kategori'] == 'Fitness' ? 'selected' : ''; ?>>Fitness</option>
                                        <option value="Badminton" <?php echo isset($data['kategori']) && $data['kategori'] == 'Badminton' ? 'selected' : ''; ?>>Badminton</option>
                                        <option value="Sepak Bola" <?php echo isset($data['kategori']) && $data['kategori'] == 'Football' ? 'selected' : ''; ?>>Football</option>
                                        <option value="Volleyball" <?php echo isset($data['kategori']) && $data['kategori'] == 'Volleyball' ? 'selected' : ''; ?>>Volleyball</option>
                                        <option value="Tenis" <?php echo isset($data['kategori']) && $data['kategori'] == 'Tenis' ? 'selected' : ''; ?>>Tenis</option>
                                        <option value="Golf" <?php echo isset($data['kategori']) && $data['kategori'] == 'Golf' ? 'selected' : ''; ?>>Golf</option>
                                        <option value="Billiard" <?php echo isset($data['kategori']) && $data['kategori'] == 'Billiard' ? 'selected' : ''; ?>>Billiard</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Foto </label>
                                    <input type="file" name="foto" class="form-control" />
                                    <?php if (isset($data['foto']) && !empty($data['foto'])) { ?>
                                        <img src="<?php echo $data['foto']; ?>" alt="<?php echo $data['nama_barang']; ?>" style="width: 100px; height: auto; margin-top: 10px;">
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="stok" class="form-control" value="<?php echo isset($data['stok']) ? $data['stok'] : ''; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" step="0.01" name="harga" class="form-control" value="<?php echo isset($data['harga']) ? $data['harga'] : ''; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Status </label>
                                    <select name="status" class="form-control" required>
                                        <option value="Ready" <?php echo isset($data['status']) && $data['status'] == 'Ready' ? 'selected' : ''; ?>>Ready</option>
                                        <option value="Full Booking" <?php echo isset($data['status']) && $data['status'] == 'Full Booking' ? 'selected' : ''; ?>>Full Booking</option>
                                        <option value="Full Rent" <?php echo isset($data['status']) && $data['status'] == 'Full Rent' ? 'selected' : ''; ?>>Full Rent</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <input type="text" name="deskripsi" class="form-control" value="<?php echo isset($data['deskripsi']) ? $data['deskripsi'] : ''; ?>" required />
                                </div>

                            </div>

                            <div class="button-group">
                                <button type="button" onclick="window.location.href='catalog.php';" class="btn-back">Batal</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>