<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapusfoto']))
    {
    $kodehotel = $_GET['hapusfoto'];    
    mysqli_query($con,"DELETE FROM hotel WHERE hotelID = '$kodehotel'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='hotel.php'</script>";
    }

?>

</html>