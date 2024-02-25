<div class="row well">
        <div class="col-md-4">
            <div class="card well">
                <div class="card-header">
                    <h3 class="">Tambah User</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">ID User: </label>
                            <input type="text" class="form-control" id="nama" placeholder="Enter Name" name="UserID">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nama" class="form-label">Nama: </label>
                            <input type="text" class="form-control" id="nama" placeholder="Enter Name" name="NamaUser">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Password: </label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="Password">
                        </div>
                        <div class="mb-3">
                            <label for="pwd" class="form-label">Level: </label>
                            <select type="password" class="form-control" id="pwd" placeholder="Enter password" name="level">
                                <option value="admin">admin</option>
                                <option value="petugas">petugas</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php 
    include_once("../conn/koneksi.php");
    if(isset($_POST['submit'])) {
        $id = $_POST['UserID'];
		$name = $_POST['NamaUser'];
		$password = md5($_POST['Password']);
        $level = $_POST['level'];
		
		// Insert user data into table
		$result = mysqli_query($koneksi, "INSERT INTO user (UserID, Nama, Password, level) VALUES('$id','$name','$password', '$level')");
		
		// Show message when user added
		echo "User added successfully. <a href='index.php?page=user'>View Users</a>";
        header("Location: index.php?page=user");
        echo "<script>alert('Menu baru berhasil ditambahkan')</script>";

	}
?>
