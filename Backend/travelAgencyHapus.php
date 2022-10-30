<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_GET['hapus']))
    {
    $kodeagency = $_GET['hapus'];    
    mysqli_query($con,"DELETE FROM travelagency WHERE agencyID = '$kodeagency'");
        echo "<script>alert('DATA BERHASIL DIHAPUS');
        document.location='travelAgency.php'</script>";
    }
?>

</html>