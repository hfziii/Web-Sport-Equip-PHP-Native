<?php
session_start();
include 'koneksi.php';

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silahkan login terlebih dahulu');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

$username = $_SESSION['username'];
$total = 0;
$cartDetails = [];

// Fetch user details from the database
$sqlUser = "SELECT id_user, name, telepon FROM user WHERE username = ?";
$stmt = mysqli_prepare($connection, $sqlUser);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$resultUser = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($resultUser)) {
    $id_user = $user['id_user'];
    $name = $user['name'];
    $telepon = $user['telepon'];
} else {
    echo "<script>alert('Data pengguna tidak ditemukan.');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

mysqli_stmt_close($stmt);

// Fetch cart items from the POST data
$cartDetails = [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kode']) && isset($_POST['quantity']) && isset($_POST['harga'])) {
        $items = $_POST['kode'];
        $quantities = $_POST['quantity'];
        $prices = $_POST['harga'];

        foreach ($items as $index => $kode) {
            $quantity = isset($quantities[$index]) ? $quantities[$index] : 0;
            $harga = isset($prices[$index]) ? $prices[$index] : 0;

            // Query to get product details
            $sqlProduct = "SELECT nama_barang FROM catalog_sport_equip WHERE kode = ?";
            $stmt = mysqli_prepare($connection, $sqlProduct);
            mysqli_stmt_bind_param($stmt, "s", $kode);
            mysqli_stmt_execute($stmt);
            $resultProduct = mysqli_stmt_get_result($stmt);

            if ($product = mysqli_fetch_assoc($resultProduct)) {
                $subtotal = $harga * $quantity;
                $total += $subtotal;
                $cartDetails[] = [
                    'kode' => $kode,
                    'nama_barang' => $product['nama_barang'],
                    'harga' => $harga,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }

            mysqli_stmt_close($stmt);
        }
    }
}

$_SESSION['cart_details'] = $cartDetails;
$_SESSION['total'] = $total;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="icon" href="../img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <title>Checkout-Sport Equip</title>
</head>

<body>
    <nav class="topnav">
        <div class="container-nav">
            <a href="../index.php"><img src="../img/user/sportequip3.png"></a>
            <h1>Checkout</h1>
        </div>
    </nav>
    <div class="container">
        <div class="box">
            <h4 style="margin-left: 20px;">Pesanan</h4>
            <div class="flex-box">
                <p class="name">Nama: <?php echo htmlspecialchars($name); ?></p>
                <p class="telepon">Telepon: <?php echo htmlspecialchars($telepon); ?></p>
                <!-- <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Anda" style="width: 100%;" required> -->
                
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartDetails as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nama_barang']); ?></td>
                            <td>Rp.<?= number_format($item['harga'], 0, ',', '.'); ?></td>
                            <td><?= htmlspecialchars($item['quantity']); ?></td>
                            <td>Rp.<?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="total-price">
                    <h2>Total Harga: Rp.<?= number_format($total, 0, ',', '.'); ?></h2>
                </div>
            

            </div>
        </div>

        <div class="box">
            <div class="column-method-payment">
                <div class="child-column-method-payment">
                    <h4>Metode Pembayaran</h4>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p>Silahkan Transfer Ke</p>
                </div>
                <div class="child-column-method-payment">
                    <div class="flex-payment">
                        <a href="#"><div class="button">Transfer Bank</div></a>
                        <a href="#"><div class="button cod-btn">COD</div></a>
                        <a href="#"><div class="button">Upload Bukti Pembayaran</div></a>
                    </div>
                    <div class="bank-payment">
                        <a href="#"><img src="../img/user/bni.png"></a>
                        <a href="#"><img src="../img/user/bca.png" style="margin-bottom: 15px;"></a>
                        <a href="#"><img src="../img/user/mandiri.png" style="margin-bottom: 16px;"></a>
                    </div>
                    <h4>BCA 7005453275 a.n. Bambang Sugiharto</h4>
                </div>
                <div class="child-column-method-payment">
                    <div class="flex-button">
                        <form class="checkout-form" method="post" action="./checkout_process.php">
                            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($id_user); ?>">
                            <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name); ?>">
                            <input type="hidden" name="total_bayar" value="<?php echo $total; ?>">
                            <input type="hidden" name="status" value="pending"> <!-- Misalnya status defaultnya pending -->

                            <?php foreach ($cartDetails as $index => $item) : ?>
                                <input type="hidden" name="nama_barang[]" value="<?php echo htmlspecialchars($item['nama_barang']); ?>">
                                <input type="hidden" name="harga[]" value="<?php echo htmlspecialchars($item['harga']); ?>">
                                <input type="hidden" name="jumlah[]" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                            <?php endforeach; ?>

                            <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Anda" style="width: 100%;" required>
                            
                            <button type="submit" class="pesan-btn" name="action" value="pesan">Pesan</button>
                        </form>

                        <a href="./cart.php">
                            <div class="cancel-btn" style="background-color: red;">Batal</div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
