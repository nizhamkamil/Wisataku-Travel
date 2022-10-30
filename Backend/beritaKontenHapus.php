<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
        $kontenkode= $_GET['hapusfoto'];
        $hapusfoto = mysqli_query($con,"SELECT * FROM beritakonten WHERE kontenID = '$kontenkode'");
        $hapus = mysqli_fetch_array($hapusfoto);
        $namafile = $hapus['kontenFoto'];
        mysqli_query($con,"DELETE FROM beritakonten WHERE kontenID = '$kontenkode'");
        unlink('images/'.$namafile);
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='beritaKonten.php'</script>";
    }
   ?>