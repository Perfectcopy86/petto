<?php
    session_start();
    include('function.php');
    if(!isset($_SESSION['username'])){
        header("location: signin.php");
    }  

    $jenis = readQuery('jenis_produk');
    if(isset($_POST['tambah']))
    {
        if (add($_POST, $_FILES)) {
            echo "
            <script>
                alert('Berhasil tambah data!');
                document.location.href = 'data_barang.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Gagal tambah data!');
                document.location.href = 'data_barang.php';
            </script>
            ";
        }
    }

    if(isset($_GET['id_del'])){
        $id = $_GET['id_del'];
        delete_data('produk', $id);
        header("location: data_barang.php"); 
    }

    if(isset($_GET['id_up'])){
        $id = $_GET['id_up'];
        // update_data($id);a
        echo "<script>
                alert('masuk')
                </script>";
        $query = "SELECT * FROM produk WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $data_produk = mysqli_fetch_assoc($result);

        // header("location: data_barang.php"); 
    }

    if(isset($_POST['edit']))
    {

    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Product Data - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="css/styles_admin.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="admin.php">PETTO</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="functions/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Customers
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="konfirmasi_bayar.php">Konfirmasi Pembayaran</a>
                                            <a class="nav-link" href="laporan_pembelian.php">Laporan Pembelian</a>
                                            <a class="nav-link" href="data_customers.php">Data Customers</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="data_barang.php" >
                                        Data Produk
                                    </a>
                                    
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['nama']; ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Produk</li>
                        </ol>
                        <a href="#" class="btn btn-warning mb-2" data-toggle='modal' data-target='#exampleModal2'>Tambah Data</a>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List Produk
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jenis Produk</th>
                                            <th>Banyak Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jenis Produk</th>
                                            <th>Banyak Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT p.id, p.foto, p.nama, p.harga, r.nama_jenis, p.banyak FROM produk p INNER JOIN jenis_produk r ON p.jenis=r.id";

                                            $result = mysqli_query($conn, $sql);
                                            $i = 1;
                                            if(!$result){
                                            die('GAGAL' . mysqli_error());
                                            }
                                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            echo "<tr>";
                                            echo "<td> $i </td>";
                                            echo "<td><img src='foto/".$row['foto']."' width='100px' height='120px'></td>";
                                            echo "<td> {$row['nama']} </td>";
                                            echo "<td> {$row['harga']} </td>";
                                            echo "<td> {$row['nama_jenis']} </td>";
                                            echo "<td> {$row['banyak']} </td>";
                                            echo "<td class='text-center'> <a href='data_barang.php?id_del={$row['id']}' ><i class='fa-solid fa-trash text-danger mr-2'></i></a> 

                                                <a href='#' data-toggle='modal' data-target='#exampleModal3' ><i class='fa-solid fa-pen-to-square text-warning'></i></a></td>";
                                            echo "</tr>";
                                            $i++;
                                            }
                                            mysqli_close($conn);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PETTO 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">Tambah Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="#" method="post" id="form_tambah" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kode">Foto Produk</label><br>
                        <input name="foto" type="file" id="foto" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input class="form-control" type="text" name="nama_produk" placeholder="Masukkan Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Harga Produk</label>
                        <input class="form-control" type="text" name="harga_produk" placeholder="Masukkan Harga Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_produk">Jenis Produk</label>
                        <select class="form-select" aria-label="Jenis" id="jenis_produk" name="jenis_produk" required>
                            <?php
                                foreach($jenis as $macam) :
                            ?>
                            <option value="" disabled selected hidden></option>
                            <option value="<?= $macam['id'];?>"><?= $macam['nama_jenis'];?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="banyak_produk">Banyak Produk</label>
                        <input class="form-control" type="text" name="banyak_produk" placeholder="Masukkan Banyak Produk">
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" name="tambah" id="tambah" form="form_tambah">Tambah</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="exampleModalLabel">Update Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="#" method="post" id="form_tambah" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kode">Foto Produk</label><br>
                        <input name="foto" type="file" id="foto" value="foto/'.<?= $data_produk['foto'] ?>.'" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input class="form-control" type="text" name="nama_produk" value="<?= $data_produk['nama'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_produk">Harga Produk</label>
                        <input class="form-control" type="text" name="harga_produk" value="<?= $data_produk['harga'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_produk">Jenis Produk</label>
                        <select class="form-select" aria-label="Jenis" id="jenis_produk" name="jenis_produk" required>
                            <?php
                                foreach($data_produk as $macam) :
                            ?>
                            <!-- <option value="" disabled selected hidden></option> -->
                            <option value="<?= $macam['id'];?>"><?= $macam['nama_jenis'];?></option>
                            <?php
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="banyak_produk">Banyak Produk</label>
                        <input class="form-control" type="text" name="banyak_produk" value="<?= $data_produk['banyak'] ?>" required>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" name="edit" id="edit" form="form_tambah">Edit</button>
              </div>
            </div>
          </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
