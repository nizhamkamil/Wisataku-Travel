<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
        $fotokode = $_GET['hapusfoto'];
        $hapusfoto = mysqli_query($con,"SELECT * FROM fotodestinasi WHERE fotoID = '$fotokode'");
        $hapus = mysqli_fetch_array($hapusfoto);
        $namafile = $hapus['fotoFile'];
        mysqli_query($con,"DELETE FROM fotodestinasi WHERE fotoID = '$fotokode'");
        unlink('images/'.$namafile);
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='photodestinasi.php'</script>";
    }
   ?>