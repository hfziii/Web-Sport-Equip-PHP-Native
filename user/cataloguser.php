<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cataloguser.css">
    <link rel="icon" href="../img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <title>Katalog-Sport Equip</title>

    <?php
    session_start();
    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var loginBtn = document.getElementById("loginBtn");
        var dropdownContent = document.getElementById("dropdownContent");

        <?php if (isset($_SESSION['username'])): ?>
            loginBtn.classList.add("username-btn");
            loginBtn.style.cursor = "pointer";

            // Tambahkan event listener untuk menampilkan dropdown
            loginBtn.addEventListener("click", function (event) {
                event.preventDefault();
                dropdownContent.classList.toggle("show");
            });

            // Event listener untuk logout
            var logoutItem = document.createElement('a');
            logoutItem.textContent = "Logout";
            logoutItem.href = "../logout.php";
            logoutItem.onclick = function() {
                if (!confirm("Anda Yakin Ingin Logout?")) {
                    event.preventDefault();
                }
            };
            dropdownContent.appendChild(logoutItem);
        <?php else: ?>
            loginBtn.href = "../login.php"; // Link ke halaman login.php jika belum login
        <?php endif; ?>

        window.onclick = function (event) {
            if (!event.target.matches('.login-btn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    });
    </script>
</head>

<body>
    <?php include 'koneksi.php'; ?>
    <nav class="topnav">
        <div class="container-nav">
            <a href="../index.php"><img src="../img/user/sportequip3.png"></a>
            <form>
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            <a href="message.html"><i><img src="../img/user/message.png" alt="Message"></i></a>
            <a href="notification.html"><i><img src="../img/user/notification.png" alt="Notification"></i></a>
            <a href="./cart.php"><i><img src="../img/user/shopping-cart.png" alt="Shopping Cart"></i></a>
            <div class="user-dropdown">
                <?php if (!isset($_SESSION['username'])): ?>
                    <a href="../login.php" class="login-btn" id="loginBtn">Login</a>
                <?php else: ?>
                    <a href="#" class="login-btn username-btn" id="loginBtn"><?php echo $_SESSION['username']; ?></a>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="../logout.php">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>Categories</h1>
        <div class="scroll-bar">
            <div class="box-category">
                <ul>
                    <li class="category all active" data-category="All">All</li>
                    <li class="category" data-category="Fitness">Fitness</li>
                    <li class="category" data-category="Badminton">Badminton</li>
                    <li class="category" data-category="Football">Football</li>
                    <li class="category" data-category="Volleyball">Volleyball</li>
                    <li class="category" data-category="Tenis">Tenis</li>
                    <li class="category" data-category="Golf">Golf</li>
                    <li class="category" data-category="Billiard">Billiard</li>
                </ul>
            </div>
        </div>
        <h2>Recommended For You</h2>
        <div class="box-items">
            <?php
                $selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'All';
                $sql = "SELECT * FROM catalog_sport_equip";
                if ($selectedCategory != 'All') {
                    $sql .= " WHERE kategori='$selectedCategory'";
                }
                $query = mysqli_query($connection, $sql);
                if ($query && mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $imagePath = '../' . $row["foto"];
                        echo '<a href="detailproduk.php?kode=' . $row['kode'] . '">
                            <div class="box">
                                <img src="' . $imagePath . '" alt="' . $row["nama_barang"] . '">
                                <div class="label">
                                    <p class="produk">' . $row["nama_barang"] . '</p>
                                    <p class="category-tag">' . $row["kategori"] . '</p>
                                    <p class="price">Rp.' . number_format($row["harga"], 0, ',', '.') . '/Hari</p>
                                </div>
                            </div>
                        </a>';
                    }
                } else {
                    echo "0 results";
                }
            ?>
        </div>
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

    <script>
        document.querySelectorAll('.box-category ul li').forEach(function(category) {
            category.addEventListener('click', function() {
                var selectedCategory = this.getAttribute('data-category');
                window.location.href = "?category=" + selectedCategory;
            });
        });
    </script>
</body>

</html>