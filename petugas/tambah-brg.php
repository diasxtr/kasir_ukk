<?php

if (isset($_POST['tambah'])) {
  $id = $_POST['produkID'];
  $nama = $_POST['namaproduk'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];

  $target = "../foto/";
  $time = date('dmYHis');
  $type = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
  $targetfile = $target . $time . '.' . $type;
  $filename = $time . '.' . $type;

  $uploadOk = 1;

  // File upload handling
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetfile)) {
      $sql = "INSERT INTO produk (produkID, namaproduk, harga, stok, foto) VALUES ('$id','$nama', '$harga', $stok, '$filename')";
      if ($koneksi->query($sql) === TRUE) {
          echo "<script>alert('Berhasil menambahkan produk');window.location.href='?page=stok';</script>";
          exit();
      } else {
          echo "Error: " . $sql . "<br>" . $koneksi->error;
      }
  } else {
      echo "Maaf, terjadi kesalahan saat mengupload file gambar.";
  }

  $koneksi->close();
}

?>
      <body>

        <div class="p-4" id="main-content">
          <div class="card well">
            <div class="card-body">
                <div class="container mt-5">
                    <h2>Tambah Produk Baru</h2>
                    <form action="" method="POST" class="col-md-10" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID Produk<span style="color: red;"> *</span></label>
                            <input type="text" class="form-control" id="id" name="produkID" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk<span style="color: red;"> *</span></label>
                            <input type="text" class="form-control" id="nama" name="namaproduk" required>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="harga" class="form-label">Harga<span style="color: red;"> *</span></label>
                                <input type="number" class="form-control" id="harga" name="harga" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="stok" class="form-label">Stok<span style="color: red;"> *</span></label>
                                <input type="number" class="form-control" id="stok" name="stok" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto<span style="color: red;"> *</span></label>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                            <p style="color: red;">Hanya bisa menginput foto dengan ekstensi PNG, JPG, JPEG, SVG</p>
                        </div>
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah Produk</button>
                        
                    </form>
                </div>            
            </div>
          </div>
        </div>
    </body>
