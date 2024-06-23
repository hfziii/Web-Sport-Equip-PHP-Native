<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="icon" href="../img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">
    <title>Sport Equip</title>

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
            logoutItem.href = "logout.php";
            logoutItem.onclick = function() {
                if (!confirm("Anda Yakin Ingin Logout?")) {
                    event.preventDefault();
                }
            };
            dropdownContent.appendChild(logoutItem);
        <?php else: ?>
            loginBtn.href = "login.php"; // Link ke halaman login.php jika belum login
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
    <nav class="topnav">
        <div class="container-nav">
            <a href="#"><img src="../img/user/sportequip3.png"></a>
            <form>
                <input type="text" placeholder="Search...">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            <a href="message.html"><i><img src="../img/user/message.png" alt="Message"></i></a>
            <a href="./user/notif.html"><i><img src="../img/user/notification.png" alt="Notification"></i></a>
            <a href="./user/cart.php"><i><img src="../img/user/shopping-cart.png" alt="Shopping Cart"></i></a>
            <div class="user-dropdown">
                <?php if (!isset($_SESSION['username'])): ?>
                    <a href="login.php" class="login-btn" id="loginBtn">Login</a>
                <?php else: ?>
                    <a href="#" class="login-btn username-btn" id="loginBtn"><?php echo $_SESSION['username']; ?></a>
                    <div class="dropdown-content" id="dropdownContent">
                        <a href="logout.php">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="spanduk-halaman">
        <img src="../img/user/halaman1.png" width="100%">
    </div>

    <div class="container">
        <h2 class="heading">Dapatkan pelayanan, sewa alat olahraga terbaik</h2>
        <hr>
        <div class="box-container">
            <div class="box">
                <img src="../img/user/Thumbs-halaman.png">
                <p class="judul">Produk Berkualitas</p>
                <p class="isi">Kualitas produk sangat penting bagi Anda, dan juga kami! Itu sebabnya kami melakukan
                    pemeriksaan kualitas yang ketat untuk setiap produk.</p>
            </div>
            <div class="box">
                <img src="../img/user/Dollars-halaman.png">
                <p class="judul">Biaya Terjangkau</p>
                <p class="isi">Biaya bulanan yang terjangkau mulai dari Rp200.000 per bulan untuk alat fitness
                    dengan kualitas premium.</p>
            </div>
            <div class="box">
                <img src="../img/user/Hammer-halaman.png">
                <p class="judul">Teknisi Handal</p>
                <p class="isi">Kualitas produk sangat penting bagi Anda, dan juga kami! Itu sebabnya kami melakukan
                    pemeriksaan kualitas yang ketat untuk setiap produk.</p>
            </div>
            <div class="box">
                <img src="../img/user/lock-halaman.png">
                <p class="judul">100% Aman</p>
                <p class="isi">Kami sudah hadir lebih dari 2 tahun dan memiliki testimoni pelanggan yang luas, untuk
                    pribadi maupun bisnis​​.</p>
            </div>
        </div>
        <hr>
        <div class="container2">
            <div class="box-container2">
                
                <div class="scroll-container">
                    <a href="#"><img src="../img/user/alat golf 1.png" alt="Golf"></a>
                    <a href="#"><img src="../img/user/alat tenis 1.png" alt="Tennis"></a>
                    <a href="#"><img src="../img/user/billiard 1.png" alt="Billiard"></a>
                    <a href="#"><img src="../img/user/volly 1.png" alt="Volly"></a>
                    <a href="#"><img src="../img/user/sepak bola 1.png" alt="Sepak Bola"></a>
                    <a href="#"><img src="../img/user/alat lainnya 1.png" alt="Lainnya"></a>
                </div>

                <a href="./user/cataloguser.php" class="cta-link">
                    <h3 class="heading">Lihat Katalog Produk Kami</h3>
                    <img src="./img/user/next-button.png" alt="">
                </a>
            </div>
        </div>

        <div class="container-map">
            <br><br>
            <h2>Sport Equip Location</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.381716630857!2d106.80979187453636!3d-6.599393064511176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5d97d3764c3%3A0xd56ba6305181755c!2sJl.%20Pakuan%2C%20RT.02%2FRW.04%2C%20Tegallega%2C%20Kecamatan%20Bogor%20Tengah%2C%20Kota%20Bogor%2C%20Jawa%20Barat%2016129!5e0!3m2!1sen!2sid!4v1685343641055!5m2!1sen!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
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

</body>

</html>
