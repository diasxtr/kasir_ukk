<?php
include('conn/koneksi.php');
include("header.php");

if (isset($_POST['tambah'])) {
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $nomeja = $_POST['nomeja'];

    $sql = $koneksi->query("INSERT INTO penjualan (TanggalPenjualan) VALUES ('$tanggal')");
    $id_transaksi_baru = mysqli_insert_id($koneksi);
    
    $sql = $koneksi->query("INSERT INTO pelanggan (PelangganID, No_Meja, NamaPelanggan) VALUES ('$id_transaksi_baru', '$nomeja', '$nama')");
    $id_pelanggan_baru = mysqli_insert_id($koneksi);
    
    $menu_jumlah = $_POST['menu'];
    $jumlah_array = $_POST['jumlah'];
    foreach ($menu_jumlah as $i => $item) {
        $item_parts = explode("|", $item);
        $produk_id = $item_parts[0];
        $harga = $item_parts[1];
        $jumlah = $jumlah_array[$i];

        $sql3 = $koneksi->query("INSERT INTO detailpenjualan (DetailID, ProdukID, JumlahProduk, Subtotal) VALUES ('$id_transaksi_baru', '$produk_id', '$jumlah', '$harga')");
        $sql4 = $koneksi->query("UPDATE produk SET stok = stok - $jumlah  WHERE produkID = '$produk_id'");
    }

    header("Location: daftar-transaksi.php");
    exit();
}

?>

<script>
            // Fungsi untuk menambahkan input field untuk menu
            function tambahMenu() {
                var container = document.getElementById("menuContainer");
                var newMenuInput = document.createElement("div");

                newMenuInput.innerHTML = `
                          <div class="">
                              <label for="menu" class="form-label">Menu</label>
                              <select id="menu" name="menu[]" class="form-control">
                                <option>Pilih Menu</option>
                                  <?php 
                                    $sql7 = $koneksi->query("SELECT * FROM produk WHERE stok > 0");
                                    while ($data = $sql7->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $data['ProdukID'] . '|' . $data['Harga']; ?>"><?php echo $data['NamaProduk'] . " - Rp." . number_format($data['Harga']) . " - stok:" . $data['Stok']; ?></option>

                                <?php } ?>
                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="jumlah" class="form-label">jumlah</label>
                              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]">
                          </div>
                `;

                container.appendChild(newMenuInput);
            }
        </script>    
            
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pelanggan</a>
            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="pilih-menu.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div class="p-4" id="main-content">
          <div class="card mt-5">
            <div class="card-body">
                <div class="container mt-5">
                    <h2>Tambah Transaksi</h2>
                    <form action="" method="POST">
                        <div class="col-2">
                            <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="tanggal" name="tanggal" readonly required>
                        </div>
                        <div>
                            <label for="nama" class="form-label">Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div>
                            <label for="nomeja" class="form-label">No Meja</label>
                            <input type="number" min="1" class="form-control" id="nomeja" name="nomeja" required>
                        </div>
                        <div id="menuContainer">
                          <div>
                              <label for="menu" class="form-label">Menu</label>
                              <select id="menu" name="menu[]" class="form-control">
                                <option>Pilih Menu</option>
                                <?php 
                                    $sql7 = $koneksi->query("SELECT * FROM produk WHERE stok > 0");
                                    while ($data = $sql7->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $data['ProdukID'] . '|' . $data['Harga']; ?>"><?php echo $data['NamaProduk'] . " - Rp." . number_format($data['Harga']) . " - stok:" . $data['Stok']; ?></option>

                                <?php } ?>

                              </select>
                          </div>
                          <div class="mb-3">
                              <label for="jumlah" class="form-label">jumlah</label>
                              <input type="number" min="1" class="form-control" id="jumlah" name="jumlah[]" required>
                          </div>
                          
                        </div>

                        <button type="button" class="btn btn-warning me-3" onclick="tambahMenu()">Tambah Menu+</button>

                        <button type="submit" name="tambah" class="btn btn-primary">Tambah Transaksi</button>
                    </form>
                </div>            
            </div>
          </div>
        </div>
      </body>
    </html>