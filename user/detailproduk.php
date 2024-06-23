<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/detailproduk.css">
    <link rel="icon" href="../img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <title>Detail Produk-Sport Equip</title>

    <?php
    session_start();
    include 'koneksi.php';
    if (!isset($_GET['kode'])) {
        header("Location: cataloguser.php");
        exit();
    }
    $kodeProduk = $_GET['kode'];
    $sql = "SELECT * FROM catalog_sport_equip WHERE kode='$kodeProduk'";
    $query = mysqli_query($connection, $sql);
    $product = mysqli_fetch_assoc($query);
    if (!$product) {
        echo "Produk tidak ditemukan";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addcart'])) {
        if (!isset($_SESSION['username'])) {
            echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href = '../login.php';</script>";
            exit();
        }

        $username = $_SESSION['username'];
        $productId = $product['kode'];
        $productName = $product['nama_barang'];
        $productPrice = $product['harga'];
        $productQty = 1;

        $sqlCheckCart = "SELECT * FROM cart WHERE username='$username' AND kode='$productId'";
        $resultCheckCart = mysqli_query($connection, $sqlCheckCart);

        if (mysqli_num_rows($resultCheckCart) > 0) {
            $sqlUpdateCart = "UPDATE cart SET jumlah = jumlah + 1 WHERE username='$username' AND kode='$productId'";
            mysqli_query($connection, $sqlUpdateCart);
        } else {
            $sqlInsertCart = "INSERT INTO cart (username, kode, nama_barang, harga, jumlah) VALUES ('$username', '$productId', '$productName', '$productPrice', '$productQty')";
            mysqli_query($connection, $sqlInsertCart);
        }

        echo "<script>alert('Produk telah ditambahkan ke keranjang!'); window.location.href = './cart.php';</script>";
    }
    ?>
</head>

<body>
    <nav class="topnav">
        <div class="container-nav">
            <a href="../index.php"><img src="../img/user/sportequip3.png"></a>
            <form>
                <input type="text" placeholder="Search...">
                <button type="submit" class="btn-src"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            <a href="message.html"><i><img src="../img/user/message.png" alt="Message"></i></a>
            <a href="notification.html"><i><img src="../img/user/notification.png" alt="Notification"></i></a>
            <a href="./cart.php"><i><img src="../img/user/shopping-cart.png" alt="Shopping Cart"></i></a>
            <div class="user-dropdown">
                <?php if (!isset($_SESSION['username'])): ?>
                <a href="../login.php" class="login-btn" id="loginBtn">Login</a>
                <?php else: ?>
                <a href="#" class="login-btn username-btn" id="loginBtn">
                    <?php echo $_SESSION['username']; ?>
                </a>
                <div class="dropdown-content" id="dropdownContent">
                    <a href="../logout.php">Logout</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="box-container">
            <div class="box">
                <img src="<?php echo '../' . $product['foto']; ?>" alt="<?php echo $product['nama_barang']; ?>">
            </div>

            <div class="box">
                <h1><?php echo $product['nama_barang']; ?></h1>
                <h2 class="category"><?php echo $product['kategori']; ?></h2>
                <h2 class="price">Rp.<?php echo number_format($product['harga'], 0, ',', '.'); ?>/Hari</h2>
                <p class="stok">Stok: <?php echo $product['stok']; ?></p>
                <p class="status"><?php echo $product['status']; ?></p>

                <div class="button-container">
                    <form method="post" action="">
                        <button type="submit" class="btn btn-chart" name="addcart">
                            <img class="btn-1" src="../img/user/cart-icon.png" alt="">
                            <p class="text-chart">
                                + Keranjang
                            </p>
                        </button>

                        <button class="btn btn-rent">
                            <img class="btn-2" src="../img/user/rent-icon.png" alt="">
                            <p class="text-rent">
                                Sewa Langsung
                            </p>
                        </button>

                        <button class="btn btn-share">
                            <img class="btn-3" src="../img/user/share-icon.png" alt="">
                            <p class="text-share">
                                Bagikan
                            </p>
                        </button>
                    </form>
                </div>

            </div>

            <div class="simulation">
                <form>
                    <label for="number" class="text-label">Jumlah Sewa</label> <br>
                    <div class="border-number">
                        <button type="button" onclick="decrement()">-</button>
                        <input type="number" id="number" name="number" value="1" readonly>
                        <button type="button" onclick="increment()">+</button> <br>
                    </div>

                    <label for="date-rent" class="text-label">Tanggal Sewa</label> <br>
                    <input class="date-1" type="date" id="date-today" name="date-today" value="" required> <br>

                    <label for="date-back" class="text-label">Tanggal Kembali</label> <br>
                    <input class="date-2" type="date" id="date-tomorrow" name="date-tomorrow" value="" required>
                </form>

                <p class="sub-tot">Subtotal Rp.<?php echo number_format($product['harga'], 0, ',', '.'); ?></p>
            </div>
        </div>

        <div class="box-desc">
            <p class="deskripsi"><?php echo $product['deskripsi']; ?></p>
        </div>

        <!-- REVIEW -->
        <div class="review">

            <div class="renter-reviews">
                <h1 class="title-rr">
                    ULASAN PENYEWA
                </h1>
                <div class="head-rr">
                    <img src="../img/user/star.png" alt="" class="star-1">
                    <p class="rating">
                        4.8/5.0
                    </p>
                </div>

                <div class="rr rating-5">
                    <img class="staricon2" src="../img/user/star-2.png" alt="">
                    <p class="text-rr num-rating">5</p>
                    <meter class="rating-meter" min="0" max="5" low="2.5" high="4" optimum="5" value="4.2">4.2 out of
                        5.0</meter>
                    <p class="text-rr tot-rating">40</p>
                </div>
                <div class="rr rating-5">
                    <img class="staricon2" src="../img/user/star-2.png" alt="">
                    <p class="text-rr num-rating">4</p>
                    <meter class="rating-meter" min="0" max="5" low="2.5" high="4" optimum="5" value="4.2">4.2 out of
                        5.0</meter>
                    <p class="text-rr tot-rating">5</p>
                </div>
                <div class="rr rating-5">
                    <img class="staricon2" src="../img/user/star-2.png" alt="">
                    <p class="text-rr num-rating">3</p>
                    <meter class="rating-meter" min="0" max="5" low="2.5" high="4" optimum="5" value="4.2">4.2 out of
                        5.0</meter>
                    <p class="text-rr tot-rating">2</p>
                </div>
                <div class="rr rating-5">
                    <img class="staricon2" src="../img/user/star-2.png" alt="">
                    <p class="text-rr num-rating">2</p>
                    <meter class="rating-meter" min="0" max="5" low="2.5" high="4" optimum="5" value="4.2">4.2 out of
                        5.0</meter>
                    <p class="text-rr tot-rating">2</p>
                </div>
                <div class="rr rating-5">
                    <img class="staricon2" src="../img/user/star-2.png" alt="">
                    <p class="text-rr num-rating">1</p>
                    <meter class="rating-meter" min="0" max="5" low="2.5" high="4" optimum="5" value="4.2">4.2 out of
                        5.0</meter>
                    <p class="text-rr tot-rating">1</p>
                </div>

            </div>

            <div class="detail-reviews mt-5">
                <h1 class="title-dr">
                    FOTO TESTIMONI
                </h1>
                <div class="dr-img">
                    <img src="../img/user/lets-icons_img-box-duotone.png" alt="">
                    <img src="../img/user/lets-icons_img-box-duotone.png" alt="">
                    <img src="../img/user/lets-icons_img-box-duotone.png" alt="">
                    <img src="../img/user/lets-icons_img-box-duotone.png" alt="">
                </div>
                <div class="dr-1 mt-5">
                    <div class="star-dr">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                    </div>
                    <p class="text-dr time-review">1 minggu lalu</p> <br>
                    <img src="../img/user/profile-icon-review.png" alt="" class="pp">
                    <p class="text-dr user">raniridhwansyah</p>
                    <p class="text-dr desc-r">keren, nyaman, sama aman sepedanya!!</p>
                    <img src="../img/user/lets-icons_img-box-duotone.png" alt="" class="dr-img-sub">
                </div>

                <div class="dr-2 mt-5">
                    <div class="star-dr">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                        <img src="../img/user/star-2.png" alt="" class="star-2">
                    </div>
                    <p class="text-dr time-review">2 minggu lalu</p> <br>
                    <img src="../img/user/profile-icon-review.png" alt="" class="pp">
                    <p class="text-dr user">sakiladespia</p>
                    <p class="text-dr desc-r">Kualitas sepeda sangat baik pertahankan terus,<br> stoknya bisa
                        bertambah lagi, sukses terus untuk kk nya, semoga sport equip semakin maju dan berkembang 💪🏻🔥</p>
                    <img src="../img/user/lets-icons_img-box-duotone.png" alt="" class="dr-img-sub">
                </div>
            </div>

        </div>
        <!-- CLOSE REVIEW -->

    </div>

    <div class="footer">
        <div class="box-container">
            <div class="box">
                <img src="../img/user/sportequip4.png">
            </div>
            <div class="box">
                <p class="judul">Product Category</p>
                <ul class="fot-1">
                    <a href="#">
                        <li>Golf</li>
                    </a>
                    <a href="#">
                        <li>Tennis</li>
                    </a>
                    <a href="#">
                        <li>Billiard</li>
                    </a>
                    <a href="#">
                        <li>Volly</li>
                    </a>
                    <a href="#">
                        <li>Badminton</li>
                    </a>
                </ul>
            </div>
            <div class="box">
                <p class="judul">Contact Us</p>
                <p class="fot-2">Jl Pakuan RT02/RW04, Tegallega, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat, 16129
                </p>
                <div class="wrapping-contact">
                    <a href="#"><img src="../img/user/instagram.png"></a>
                    <a href="#"><img src="../img/user/whatsapp.png"></a>
                    <a href="#"><img src="../img/user/gmail.png"></a>
                </div>
            </div>
            <div class="box">
                <p class="judul">Payment Methods</p>
                <div class="wrapping-pm">
                    <a href="#"><img src="../img/user/bni.png"></a>
                    <a href="#"><img src="../img/user/bca.png" style="margin-top: 26px;"></a>
                    <a href="#"><img src="../img/user/mandiri.png" style="width: 110px;"></a>
                </div>
            </div>
        </div>
        <div class="footer-c">
            <div class="box-container">
                <p>© SportEquip. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script>
        //FORM JUMLAH SEWA
        function increment() {
            var input = document.getElementById('number');
            var value = parseInt(input.value);
            input.value = value + 1;
        }

        function decrement() {
            var input = document.getElementById('number');
            var value = parseInt(input.value);
            if (value > 0) {
                input.value = value - 1;
            }
        }

        //FORM TGL SEWA
        // Mendapatkan tanggal hari ini
        var today = new Date();

        // Format tanggal ke 'YYYY-MM-DD' (format yang diterima oleh input date)
        var formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1).toString().padStart(2, '0') + '-' + today.getDate().toString().padStart(2, '0');

        // Menambahkan satu hari ke tanggal hari ini untuk mendapatkan tanggal besok
        var tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);

        // Format tanggal besok ke 'YYYY-MM-DD' (format yang diterima oleh input date)
        var formattedTomorrow = tomorrow.getFullYear() + '-' + (tomorrow.getMonth() + 1).toString().padStart(2, '0') + '-' + tomorrow.getDate().toString().padStart(2, '0');

        // Set nilai default input date ke tanggal hari ini
        document.getElementById('date-today').value = formattedDate;

        // Set nilai default input date ke tanggal besok
        document.getElementById('date-tomorrow').value = formattedTomorrow;

        // BUTTON COLOR
        function selectColor(color) {
            // Menghapus kelas 'selected' dari semua tombol
            var buttons = document.querySelectorAll('.color-button');
            buttons.forEach(function (button) {
                button.classList.remove('selected');
            });

            // Menambahkan kelas 'selected' pada tombol yang dipilih
            var selectedButton = document.querySelector('.' + color);
            selectedButton.classList.add('selected');
        }
    </script>

</body>

</html>
