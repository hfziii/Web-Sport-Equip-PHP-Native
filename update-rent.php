<?php
include "koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    // Pastikan $data tidak kosong
    if (!empty($data)) {
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
    'id_rental' => '',
    'status' => ''
];

// Cek nilai yang dikirim menggunakan method GET dengan id_rental
if (isset($_GET['id_rental'])) {
    $id_rental = input($_GET["id_rental"]);

    // Query untuk mengambil data rental berdasarkan id_rental
    $sql = "SELECT * FROM rental WHERE id_rental='$id_rental'";
    $hasil = mysqli_query($connection, $sql);

    if ($hasil) {
        // Jika data ditemukan, isi $data dengan hasilnya
        $data = mysqli_fetch_assoc($hasil);
    } else {
        // Tampilkan pesan error jika query gagal
        echo "Error: " . mysqli_error($connection);
    }
}

// Cek kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil nilai id_rental dan status dari form
    $id_rental = input($_POST["id_rental"]);
    $status = input($_POST["status"]);

    // Query update data pada tabel rental
    $sql = "UPDATE rental SET
            status='$status'
            WHERE id_rental='$id_rental'";

    // Mengeksekusi atau menjalankan query
    $hasil = mysqli_query($connection, $sql);

    // Kondisi berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        // Jika berhasil, redirect ke halaman rent.php
        header("Location: rent.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
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
    <title>Update Data Sewa</title>

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

                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                            <div class="form-group-container">
                                <div class="form-group">
                                    <label>Kode Sewa</label>
                                    <input type="text" name="id_rental" class="form-control" value="<?php echo isset($data['id_rental']) ? $data['id_rental'] : ''; ?>" required readonly />
                                </div>
                                
                                <div class="form-group">
                                    <label>Status </label>
                                    <select name="status" class="form-control" required>
                                        <option value="pending" <?php echo isset($data['status']) && $data['status'] == 'pending' ? 'selected' : ''; ?>>pending</option>
                                        <option value="sent" <?php echo isset($data['status']) && $data['status'] == 'sent' ? 'selected' : ''; ?>>sent</option>
                                        <option value="rented" <?php echo isset($data['status']) && $data['status'] == 'rented' ? 'selected' : ''; ?>>rented</option>
                                        <option value="returned" <?php echo isset($data['status']) && $data['status'] == 'returned' ? 'selected' : ''; ?>>returned</option>
                                        <option value="completed" <?php echo isset($data['status']) && $data['status'] == 'completed' ? 'selected' : ''; ?>>completed</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="button-group">
                                <button type="button" onclick="window.location.href='rent.php';" class="btn-back">Batal</button>
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
