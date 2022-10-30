<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
    $kodekategori = $_GET['hapus'];    
    mysqli_query($con,"DELETE FROM beritakategori WHERE kategoriID = '$kodekategori'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='kategoriInput.php'</script>";
    }
 
?>



</html>