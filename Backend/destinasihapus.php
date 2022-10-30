<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
        $kodedestinasi = $_GET['hapus'];
        mysqli_query($con,"DELETE FROM destinasi WHERE destinasiID = '$kodedestinasi'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='destinasi.php'</script>";
    }
   ?>