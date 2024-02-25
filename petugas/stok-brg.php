<div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Barang</h4>
                    <p class="card-description">
                    <!-- Add class <code>.table</code> -->
                    <?php
                        if ($level == "Administrator") {
                    ?>
                        <a href="?page=tambah-brg" title="Tambah Produk" 
                            class="btn btn-primary btn-icon-split btn-sm">
                                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                                <span class="text">Tambah Produk</span>
                        </a>
                        <?php } ?>
                    </p>

                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Terjual</th>
                                    <?php 
                                        if ($level == "Administrator") {
                                    ?>
                                    <th class="text-center">Pilihan</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                $sql = $koneksi->query("SELECT * FROM produk");
                                while ($data= $sql->fetch_assoc()) {
                                    $produkid = $data['ProdukID'];
                                    $sql2 = $koneksi->query("SELECT * FROM detailpenjualan WHERE ProdukID = '$produkid'");
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++ ?></td>
                                <td class="text-center"><img src="../foto/<?php echo $data['foto'] ?>" alt="Gambar" width="120"></td>
                                <td class="text-center"><?php echo $data['NamaProduk']?></td>
                                <td class="text-center">Rp. <?php echo number_format($data['Harga'])?></td>
                                <td class="text-center"><?php echo $data['Stok']?></td>
                                <td class="text-center">
                                <?php 
                                    $produkTerjual = 0;
                                    while ($data2=$sql2->fetch_assoc()) {    
                                        $produkTerjual = $data2['JumlahProduk'] + $produkTerjual;
                                    }
                                    echo $produkTerjual;
                                ?>
                                </td>
                                <?php
                                    if ($level == "Administrator") {
                                ?>
                                <td class="text-center" align ="center" width="12%"><a href="?page=edit-produk&ProdukID=<?= $data['ProdukID']; ?>" class="badge badge-primary p-2" title="Edit"><i class="">Edit</i></a>  <a href="?page=hapus-produk&ProdukID=<?= $data['ProdukID']; ?>" class="badge badge-danger p-2 delete-data" title='Delete'><i class="">Hapus</i></a></td>
                                <?php } ?>
                            </tr>
                            <?php  } ?>
                        
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
