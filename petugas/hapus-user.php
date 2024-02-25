<?php

include_once("../conn/koneksi.php");
$id = $_GET['UserID'];
$result = mysqli_query($koneksi, "DELETE FROM user WHERE UserID=$id");
header("Location:index.php?page=user");

?>