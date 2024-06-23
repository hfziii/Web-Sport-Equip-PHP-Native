<?php
session_start();
include 'koneksi.php';

// Memastikan variabel POST tersedia
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : null;
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : date("Y-m-d H:i:s");
$name = isset($_POST['name']) ? $_POST['name'] : "Nama Pemesan";
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : "";
$total_bayar = isset($_POST['total_bayar']) ? $_POST['total_bayar'] : 0;
$status = isset($_POST['status']) ? $_POST['status'] : "Pesanan Baru";

// Validasi id_user
if (empty($id_user)) {
    echo "<script>alert('ID User tidak boleh kosong');</script>";
    echo "<script>location='./checkout.php';</script>";
    exit();
}

// Insert into rental table
$sqlInsert = "INSERT INTO rental (id_user, tanggal, name, alamat, total_bayar, status) 
              VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connection, $sqlInsert);

// Binding parameter
mysqli_stmt_bind_param($stmt, "ssssds", $id_user, $tanggal, $name, $alamat, $total_bayar, $status);

if (mysqli_stmt_execute($stmt)) {
    $id_rental = mysqli_insert_id($connection); // Mendapatkan id_rental baru

    // Insert each product into rental_details
    if (isset($_POST['nama_barang']) && isset($_POST['harga']) && isset($_POST['jumlah'])) {
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];

        // Loop through each item
        foreach ($nama_barang as $index => $nama) {
            $harga_produk = $harga[$index];
            $jumlah_produk = $jumlah[$index];

            $sqlDetails = "INSERT INTO rental_details (rental_id, id_user, name, nama_barang, harga, jumlah) 
                           VALUES (?, ?, ?, ?, ?, ?)";
            $stmtDetails = mysqli_prepare($connection, $sqlDetails);
            mysqli_stmt_bind_param($stmtDetails, "isssdi", $id_rental, $id_user, $name, $nama, $harga_produk, $jumlah_produk);
            mysqli_stmt_execute($stmtDetails);
            mysqli_stmt_close($stmtDetails);
        }
    }

    mysqli_stmt_close($stmt);

    // Mengosongkan session setelah transaksi berhasil
    unset($_SESSION['cart_details']);
    unset($_SESSION['total']);

    echo "<script>alert('Pesanan Anda berhasil diproses');</script>";
    echo "<script>location='../index.php';</script>";
    exit();
} else {
    echo "Error: " . mysqli_error($connection);
    exit();
}
?>
