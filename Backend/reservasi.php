<!DOCTYPE html>
<html lang="en">

<?php
ob_start();
session_start();
if(!isset($_SESSION['emailuser'])){
    header("location:login.php");
}
?>

<?php include "header.php";?>
<div class="container-fluid">
    <div class="card shadow mb-4">

        <?php
    include "includes/config.php";
    if(isset($_POST['simpan']))
    {
    $resevasikode = $_POST["inputkode"];  
    $reservasinama = $_POST["inputnama"];
    $destinasikode = $_POST["alamat"];
    $hotelkode = $_POST["kodekategori"]; 
    $agencykode = $_POST["kodearea"];
    
    
 mysqli_query($con, "INSERT INTO reservasi VALUES ('$resevasikode','$reservasinama','$destinasikode','$hotelkode','$agencykode')"); 
header("Location:reservasi.php");

    }
 $datadestinasi = mysqli_query($con,"SELECT * FROM destinasi");
 $datahotel = mysqli_query($con,"SELECT * FROM hotel");
 $dataagency = mysqli_query($con,"SELECT * FROM travelagency")
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reservasi Wisata</title>
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css"
                href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
        </head>

        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">input Reservasi Wisata</h1>
                    </div>
                </div>
                <form method="POST">
                    <div class="form-group row">
                        <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Reservasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputkode" id="kodedestinasi"
                                placeholder="Kode Reservasi" maxlength="4" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="namadestinasi" class="col-sm-2 col-form-label">Nama Pemesan Reservasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="inputnama" id="namadestinasi"
                                placeholder="Nama Pemesan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kodereferensi" class="col-sm-2 col-form-label">Destinasi Wisata</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kodekategori" name="alamat">
                                <div>
                                    <?php  while($row = mysqli_fetch_array($datadestinasi)){

                        ?>
                                    <option value="<?php echo $row["destinasiID"]?>">
                                        <?php echo $row["destinasiID"]?>
                                        <?php echo $row["destinasiNama"]?>
                                    </option>
                                    <?php } ?>
                                </div>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kodereferensi" class="col-sm-2 col-form-label">Hotel</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kodekategori" name="kodekategori">
                                <div>
                                    <?php  while($row = mysqli_fetch_array($datahotel)){

                        ?>
                                    <option value="<?php echo $row["hotelID"]?>">
                                        <?php echo $row["hotelID"]?>
                                        <?php echo $row["hotelNama"]?>
                                    </option>
                                    <?php } ?>
                                </div>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kodereferensi" class="col-sm-2 col-form-label">Agency Travel</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kodearea" name="kodearea">
                                <div>
                                    <?php  while($row = mysqli_fetch_array($dataagency)){
                        ?>
                                    <option value="<?php echo $row["agencyID"]?>">
                                        <?php echo $row["agencyID"]?>
                                        <?php echo $row["agencyNama"]?>
                                    </option>
                                    <?php } ?>
                                </div>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-primary" value="simpan" name="simpan">
                            <input type="reset" class="btn btn-secondary" value="batal" name="batal">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-1"></div>
        </div>
        <!--penutup clas row-->

        <!--memulai dengan menamilkan data-->
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Daftar Reservasi Pemesanan</h1>
                        <H2>Hasil entri data pada tabel reservasi</H2>
                    </div>
                </div>
                <!--Penutup Jumbotron-->
                <table class="table table-hover table-danger">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Pemesan</th>
                            <th>Kode Destinasi</th>
                            <th>kode hotel</th>
                            <th>Nama hotel</th>
                            <th>kode agency</th>
                            <th>Nama agency</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    if(isset($_POST["kirim"])){
                    }else{
                        $query = mysqli_query($con,"SELECT reservasi.*, destinasi.destinasiID, destinasi.destinasiNama, hotel.hotelID, hotel.hotelNama, travelagency.agencyID, travelagency.agencyNama
                        FROM reservasi,destinasi,travelagency,hotel 
                        WHERE reservasi.destinasiID = destinasi.destinasiID 
                        AND reservasi.hotelID = hotel.hotelID
                        AND reservasi.agencyID = travelagency.agencyID");
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td><?php echo $row['reservasiID'];?></td>
                            <td><?php echo $row['reservasiPemesan'];?></td>
                            <td><?php echo $row['destinasiID'];?></td>
                            <td><?php echo $row['hotelID'];?></td>
                            <td><?php echo $row['hotelNama'];?></td>
                            <td><?php echo $row['agencyID'];?></td>
                            <td><?php echo $row['agencyNama'];?></td>
                            <!-- untuk icon edit dan delete -->
                            <td> <a href="reservasiUbah.php?ubah=<?php echo $row['reservasiID']?>"
                                    class="btn btn-success btn-sm" title="EDIT">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg></a></td>
                            <td><a href="reservasiHapus.php?hapus=<?php echo $row['reservasiID']?>"
                                    class="btn btn-danger btn-sm" title="DELETE"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-trash"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </a>
                            </td>
                            <!-- akhir icon edit dan delete -->
                            <?php $nomor = $nomor + 1;?>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>


                </table>
            </div>
            <div class="col-sm-1"></div>
        </div>


        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js">
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#kodekategori').select2({
                allowClear: true,
                placeholder: "Pilih Kategori Wisata"
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#kodearea').select2({
                allowClear: true,
                placeholder: "Pilih Area Wisata"
            });
        });
        </script>

    </div>
</div><!-- penutup container fluid-->
<?php include "footer.php"?>
<?php mysqli_close($con);
ob_end_flush(); ?>

</html>