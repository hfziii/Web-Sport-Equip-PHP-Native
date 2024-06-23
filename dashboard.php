<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard-Admin</title>

        <link href="css/dashboard.css?v=<?php echo time(); ?>" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="icon" href="img/favicon_io/favicon.ico" type="image/png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
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

                <!-- SIDEBAR -->
                <div class="icon-sidebar">

                    <a href="./dataadmin.php">
                        <div class="menu-1">
                            <img src="./img/catalog/profile-icon.png" alt="" class="icon-1">
                            <p class="title-1">Admin</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="menu-2">
                            <img src="./img/catalog/dash-blue.png" alt="" class="icon-2">
                            <p class="title-2">Dashboard</p>
                        </div>
                    </a>
                    <a href="./rent.php">
                        <div class="menu-3">
                            <img src="./img/catalog/rent-icon.png" alt="" class="icon-3">
                            <p class="title-3">Data <br>Sewa</p>
                        </div>
                    </a>
                    <a href="./datauser.php">
                        <div class="menu-4">
                            <img src="./img/catalog/user-icon.png" alt="" class="icon-4">
                            <p class="title-4">Data <br>Pengguna</p>
                        </div>
                    </a>
                    <a href="./catalog.php">
                        <div class="menu-5">
                            <img src="./img/catalog/listrent-icon-menu1.png" alt="" class="icon-5">
                            <p class="title-5">Katalog <br>Barang</p>
                        </div>
                    </a>
                    <a href="./login.php">
                        <div class="menu-6">
                            <img src="./img/catalog/logout-icon.png" alt="" class="icon-6">
                            <p class="title-6">Keluar</p>
                        </div>
                    </a>

                </div>
                <!-- CLOSE SIDEBAR -->


                <!-- CONTENT -->
                <div class="content">

                    <div class="viewone">
                        <div class="up">
                            <div class="flex-container">
                                <div class="left">
                                    <img src="./img/catalog/d-1.png" alt="" class="d-1">
                                </div>
                                <div class="right">
                                    <p class="text-1">Total Penyewaan</p>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <div class="">
                                <div class="right">
                                    <p class="text-2">2208</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="viewtwo">
                        <div class="up">
                            <div class="flex-container">
                                <div class="left">
                                    <img src="./img/catalog/d-2.png" alt="" class="d-1">
                                </div>
                                <div class="right">
                                    <p class="text-1">Total Pengguna</p>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <div class="">
                                <div class="right">
                                    <p class="text-2">1320</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="viewthree">
                        <div class="up">
                            <div class="flex-container">
                                <div class="left">
                                    <img src="./img/catalog/d-3.png" alt="" class="d-1">
                                </div>
                                <div class="right">
                                    <p class="text-1">Total Pendapatan</p>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <div class="">
                                <div class="right">
                                    <p class="text-2">Rp 14.000.000</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="viewone">
                        <div class="up">
                            <div class="flex-container">
                                <div class="left">
                                    <img src="./img/catalog/d-4.png" alt="" class="d-1">
                                </div>
                                <div class="right">
                                    <p class="text-1">Total Barang</p>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <div class="">
                                <div class="right">
                                    <p class="text-2">250</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="viewtwo">
                        <div class="up">
                            <div class="flex-container">
                                <div class="left">
                                    <img src="./img/catalog/d-4.png" alt="" class="d-1">
                                </div>
                                <div class="right">
                                    <p class="text-1">Barang Disewa</p>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <div class="">
                                <div class="right">
                                    <p class="text-2">100</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="viewthree">
                        <div class="up">
                            <div class="flex-container">
                                <div class="left">
                                    <img src="./img/catalog/d-4.png" alt="" class="d-1">
                                </div>
                                <div class="right">
                                    <p class="text-1">Barang Tersedia</p>
                                </div>
                            </div>
                        </div>
                        <div class="down">
                            <div class="">
                                <div class="right">
                                    <p class="text-2">150</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CLOSE CONTENT -->
                
                
            </div>
            <!-- CLOSE BODY-CONTENT -->
             
            <footer class="footer">
            <p class="copyright">
                Copyright &copy 2024 Sport Equip
            </p>
             </footer>
           
            
        </div>

        <!-- JAVASCRIPT -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous">
        </script>
        <script src="./js/script.js"></script>
        <script>
            function confirmDelete(kode) {
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    window.location.href = "catalog.php?id_admin=" + id_admin;
                }
            }
        </script>

    </body>
 
</html>