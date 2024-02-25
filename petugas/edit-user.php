<?php
include_once("../conn/koneksi.php");

if(isset($_POST['update']))
{	
	$id = $_GET['UserID'];
	
	$name=$_POST['NamaUser'];
	$password= md5($_POST['Password']);
    $level = $_POST['level'];
	// update user data
	$result = mysqli_query($koneksi, "UPDATE user SET NamaUser='$name', Password='$password', level='$level' WHERE UserID=$id");
	
	header("Location: index.php?page=user");
    echo "<script>alert('berhasil');.windows.</script>";
}


$id = $_GET['UserID'];

$result1 = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID=$id");

while($user_data = mysqli_fetch_array($result1))
{
	$name = $user_data['NamaUser'];
	$Password = md5($user_data['Password']);
	$Level = $user_data['level'];
}

?>

<div class="row well">
    <div class="col-md-4">
        <div class="card well">
            <div class="card-header">
                <h3 class="">Update barang</h3>
            </div>
                   
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="mb-3 mt-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="username" value="<?php echo $name; ?>" placeholder="Masukkan Nama" name="NamaUser">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Password:</label>
                        <input type="text" class="form-control" id="harga" value="<?php echo $Password; ?>" placeholder="Masukkan Harga" name="Password">
                    </div>
                    <div class="mb-3">
                            <label for="pwd" class="form-label">Level: </label>
                            <?php
                                if ($Level = "Administrator") {
                            ?>
                            <select type="password" class="form-control" id="pwd" placeholder="Enter password" name="level">
                                <option value="Administrator">Admin</option>
                                <option value="Petugas">Petugas</option>
                            </select>
                            <?php 
                                } else {
                            ?>
                            <select type="password" class="form-control" id="pwd" placeholder="Enter password" name="level">
                                <option value="Petugas">Petugas</option>
                                <option value="Administrator">Admin</option>
                            </select>
                            <?php
                                }
                            ?>
                            
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
