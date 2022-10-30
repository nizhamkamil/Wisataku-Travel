<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
    $kodereservasi = $_GET['hapus'];    
    mysqli_query($con,"DELETE FROM reservasi WHERE reservasiID = '$kodereservasi'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='reservasi.php'</script>";
    }
?>

</html>