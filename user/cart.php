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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        if ($action === 'remove') {
            $kode = $_POST['kode'];
            $sqlRemove = "DELETE FROM cart WHERE username='$username' AND kode='$kode'";
            mysqli_query($connection, $sqlRemove);
            echo "<script>alert('Produk telah dihapus dari keranjang!'); window.location.href = './cart.php';</script>";
        } elseif ($action === 'remove_selected' && isset($_POST['kode']) && is_array($_POST['kode'])) {
            $kodeList = implode(',', array_map(function ($kode) use ($connection) {
                return "'" . mysqli_real_escape_string($connection, $kode) . "'";
            }, $_POST['kode']));
            $sqlRemoveSelected = "DELETE FROM cart WHERE username='$username' AND kode IN ($kodeList)";
            mysqli_query($connection, $sqlRemoveSelected);
            echo "<script>alert('Produk terpilih telah dihapus dari keranjang!'); window.location.href = './cart.php';</script>";
        }
    }

    if (isset($_POST['kode']) && isset($_POST['quantity'])) {
        $cart = [];
        $items = $_POST['kode'];
        $quantities = $_POST['quantity'];

        foreach ($items as $index => $kode) {
            $quantity = isset($quantities[$index]) ? $quantities[$index] : 0;
            $sqlProduct = "SELECT nama_barang, harga FROM catalog_sport_equip WHERE kode = '$kode'";
            $queryProduct = mysqli_query($connection, $sqlProduct);
            if ($product = mysqli_fetch_assoc($queryProduct)) {
                $cart[] = [
                    'kode' => $kode,
                    'nama_barang' => $product['nama_barang'],
                    'harga' => $product['harga'],
                    'quantity' => $quantity,
                    'subtotal' => $product['harga'] * $quantity
                ];
            }
        }
        $_SESSION['cart'] = $cart;
        header('Location: checkout.php');
        exit();
    }
}

// Fetch cart items from the database
$sqlCart = "SELECT c.*, p.foto, p.nama_barang, p.harga 
            FROM cart c 
            JOIN catalog_sport_equip p ON c.kode = p.kode 
            WHERE c.username = '$username'";
$queryCart = mysqli_query($connection, $sqlCart);
$cartItems = mysqli_fetch_all($queryCart, MYSQLI_ASSOC);

if (empty($cartItems)) {
    echo "<script>alert('Keranjang belanja Anda kosong');</script>";
    echo "<script>location='./cataloguser.php';</script>";
    exit();
}

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="icon" href="../img/favicon_io/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000&display=swap" rel="stylesheet">
    <title>Keranjang-Sport Equip</title>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var loginBtn = document.getElementById("loginBtn");
        var dropdownContent = document.getElementById("dropdownContent");

        <?php if (isset($_SESSION['username'])): ?>
            loginBtn.classList.add("username-btn");
            loginBtn.style.cursor = "pointer";

            loginBtn.addEventListener("click", function (event) {
                event.preventDefault();
                dropdownContent.classList.toggle("show");
            });

            var logoutItem = document.createElement('a');
            logoutItem.textContent = "Logout";
            logoutItem.href = "../logout.php";
            logoutItem.onclick = function(event) {
                if (!confirm("Anda Yakin Ingin Logout?")) {
                    event.preventDefault();
                }
            };
            dropdownContent.appendChild(logoutItem);
        <?php else: ?>
            loginBtn.href = "../login.php";
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
        };

        var selectAllCheckbox = document.getElementById('select-all');
        var checkboxes = document.querySelectorAll('.item-checkbox');
        var totalPriceElement = document.getElementById('total-price');
        var deleteSelectedBtn = document.getElementById('delete-selected');

        // Set all checkboxes to be checked by default
        selectAllCheckbox.checked = true;
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = true;
        });

        selectAllCheckbox.addEventListener('change', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateTotalPrice();
        });

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateTotalPrice();
                if (!checkbox.checked) {
                    selectAllCheckbox.checked = false;
                } else if (Array.from(checkboxes).every(c => c.checked)) {
                    selectAllCheckbox.checked = true;
                }
            });
        });

        deleteSelectedBtn.addEventListener('click', function (event) {
            event.preventDefault();
            var selectedItems = Array.from(checkboxes).filter(checkbox => checkbox.checked);
            if (selectedItems.length === 0) {
                alert('Tidak ada item yang dipilih.');
                return;
            }

            if (confirm('Anda yakin ingin menghapus item yang dipilih?')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'cart.php';

                selectedItems.forEach(function (item) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'kode[]';
                    input.value = item.dataset.kode;
                    form.appendChild(input);
                });

                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'action';
                actionInput.value = 'remove_selected';
                form.appendChild(actionInput);

                document.body.appendChild(form);
                form.submit();
            }
        });

        document.querySelectorAll('.item-quantity').forEach(function (quantityInput) {
            quantityInput.addEventListener('change', function () {
                var quantity = parseInt(quantityInput.value);
                if (isNaN(quantity) || quantity < 1) {
                    quantityInput.value = 1;
                    quantity = 1;
                }
                quantityInput.dataset.quantity = quantity;
                quantityInput.closest('.items').querySelector('.item-checkbox').dataset.quantity = quantity;
                updateTotalPrice();
            });
        });

        function updateTotalPrice() {
            var total = 0;
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    var price = parseFloat(checkbox.dataset.price);
                    var quantity = parseInt(checkbox.dataset.quantity);
                    total += price * quantity;
                }
            });
            totalPriceElement.textContent = 'Rp.' + total.toLocaleString('id-ID');
        }

        // Initial total price calculation
        updateTotalPrice();
    });
    </script>
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
            <div class="box-select">
                <input type="checkbox" id="select-all">
                <label>Pilih Semua <span style="float: right; margin-right: 10px;"><a href="#" id="delete-selected" style="text-decoration: none;">Hapus</a></span> </label>
            </div>

            <?php foreach ($cartItems as $item) : ?>
            <div class="box-items">
                <div class="items">
                    <input type="checkbox" class="item-checkbox" data-price="<?php echo $item['harga']; ?>" data-quantity="<?php echo $item['jumlah']; ?>" data-kode="<?php echo $item['kode']; ?>">
                    <div class="child-box">
                        <img src="<?php echo '../' . $item['foto']; ?>" alt="<?php echo htmlspecialchars($item['nama_barang']); ?>">
                        <p><?php echo htmlspecialchars($item['nama_barang']); ?></p>
                        <p>Rp.<?php echo number_format($item['harga'], 0, ',', '.'); ?></p>

                        <div class="inputot">
                            <input type="number" name="quantity" value="<?php echo $item['jumlah']; ?>" min="1" class="item-quantity" data-price="<?php echo $item['harga']; ?>" data-quantity="<?php echo $item['jumlah']; ?>">
                        </div>
                    </div>
                    <div class="manage-items">
                        <div class="button">
                            <a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <form action="cart.php" method="post" style="display: inline;">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="kode" value="<?php echo $item['kode']; ?>">
                                <button type="submit" style="border: none; background: none;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php $total += $item['harga'] * $item['jumlah']; ?>
            <?php endforeach; ?>

        </div>
        <div class="right-bar">
            <h4>Ringkasan Belanja</h4>
            <p>Total Harga Sewa <span style="float: right; margin-right: 20px;" id="total-price">Rp.<?php echo number_format($total, 0, ',', '.'); ?></span></p>
            <div class="container-right-bar">
                
            <div class="box-2">
                
                <form method="post" action="checkout.php">
                    <?php foreach ($cartItems as $item) : ?>
                        <input type="hidden" name="kode[]" value="<?php echo $item['kode']; ?>">
                        <input type="hidden" name="quantity[]" value="<?php echo $item['jumlah']; ?>">
                        <input type="hidden" name="harga[]" value="<?php echo $item['harga']; ?>">
                    <?php endforeach; ?>
                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                    <button type="submit" class="submit c-button">Checkout</button>
                </form>

            </div>
            <div class="box3">
                <a href="./cataloguser.php">
                    <p>Kembali</p>
                </a>
            </div>
            </div>
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
