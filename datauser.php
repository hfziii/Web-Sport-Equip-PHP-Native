<!-- SCRIPT UNTUK DELETE DATA -->
<?php
    ob_start();
    include("koneksi.php");

    // Cek apakah ada kiriman form dari method GET
    if (isset($_GET['id_user'])) {
        $id_user = htmlspecialchars($_GET["id_user"]);

        $sql = "DELETE FROM user WHERE id_user='$id_user'";
        $hasil = mysqli_query($connection, $sql);

        // Kondisi apakah berhasil atau tidak
        if ($hasil) {
            header("Location: catalog.php");
            exit(); // untuk menghentikan eksekusi skrip
        } else {
            echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
        }
    }
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pengguna-Admin</title>

        <link href="css/datauser.css?v=<?php echo time(); ?>" rel="stylesheet">
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
                    <a href="./dashboard.php">
                        <div class="menu-2">
                            <img src="./img/catalog/dashboard-icon.png" alt="" class="icon-2">
                            <p class="title-2">Dashboard</p>
                        </div>
                    </a>
                    <a href="./rent.php">
                        <div class="menu-3">
                            <img src="./img/catalog/rent-icon.png" alt="" class="icon-3">
                            <p class="title-3">Data <br>Sewa</p>
                        </div>
                    </a>
                    <a href="#">
                        <div class="menu-4">
                            <img src="./img/catalog/user-icon-white.png" alt="" class="icon-4">
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

                    <p class="title-content">Data Pengguna</p>
                    <a href="#">
                        <img src="./img/catalog/button-create.png" alt="" class="add-data-btn">
                    </a>
                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="col-id_user">Id User</th>
                                <th scope="col" class="col-name">Nama</th>
                                <th scope="col" class="col-username">Username</th>
                                <th scope="col" class="col-email">Email</th>
                                <th scope="col" class="col-telepon">No Telepon</th>
                                <th scope="col" class="col-tindakan">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("koneksi.php");

                                $no = 1;
                                $query = mysqli_query($connection, "SELECT * FROM user");
                                while ($data = mysqli_fetch_array ($query)) {
                            ?>

                            <tr>
                                <td><?php echo $data['id_user']; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['telepon']; ?></td>
                                <td>
                                    
                                    <a href="#" onclick="confirmDelete('<?php echo $data['id_user']; ?>');">
                                        <img src="./img/catalog/delete-btn-new.png" alt="" class="act-btn delete">                                        
                                    </a>

                                </td>
                            </tr>

                            <?php 
                             }
                            ?>
                            
                        </tbody>
                    </table>
                   
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
            function confirmDelete(id_user) {
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    window.location.href = "datauser.php?id_user=" + id_user;
                }
            }
        </script>

    </body>
 
</html>