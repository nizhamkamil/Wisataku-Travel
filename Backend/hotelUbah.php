<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
</head>
<?php
ob_start();
session_start();
if(!isset($_SESSION['emailuser'])){
    header("location:login.php");
}
?>
<?php include "header.php";?>

<?php 
    include "includes/config.php";
    if(isset($_POST['batal'])){
        header("location:hotel.php");
    }
    if(isset($_POST['ubah'])){
        $kodehotel = $_POST['inputkode'];
        $namahotel = $_POST['inputnama'];
        $kodeprovinsi = $_POST['kodeprovinsi'];

        $nama = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];

       if(empty($nama)){
            mysqli_query($con,"UPDATE hotel SET hotelNama='$namahotel',provinsiID ='$kodeprovinsi' WHERE hotelID ='$kodehotel'");
            header("location:hotelUbah.php");
        } 
        else
        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);

        //Periksa ektensi file harus JPG atau jpg
        if(($ekstensifile == "jpg") or ($ekstensifile == "JPG") or ($ekstensifile == "jpeg") or ($ekstensifile == "png")){
            move_uploaded_file($file_tmp,'images/'.$nama); //unggah file ke folder images
            mysqli_query($con,"UPDATE hotel SET  hotelNama='$namahotel', hotelFoto='$nama', provinsiID='$kodeprovinsi' WHERE hotelID='$kodehotel' ");

        }
    }

    $dataprovinsi = mysqli_query($con,"SELECT * FROM provinsi");

    $kodehotel = $_GET['ubahfoto'];
    $editfoto = mysqli_query($con," SELECT * FROM hotel WHERE hotelID = '$kodehotel'");
    
    $rowedit = mysqli_fetch_array($editfoto);
    $editprovinsi = mysqli_query($con,"SELECT * FROM provinsi,hotel WHERE hotelID = '$kodehotel' AND provinsi.provinsiID = hotel.provinsiID");
    $rowedit2 = mysqli_fetch_array($editprovinsi);
?>



<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Input Hotel</h1>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="kodefoto" class="col-sm-2 col-form-label">Kode Hotel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kodehotel" name="inputkode"
                        value="<?php echo $rowedit["hotelID"]?>" readonly maxlength="4">
                </div>
            </div>

            <div class="form-group row">
                <label for="namafoto" class="col-sm-2 col-form-label">Nama hotel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namahotel" name="inputnama"
                        value="<?php echo $rowedit["hotelNama"]?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="namadestinasi" class="col-sm-2 col-form-label">Nama provinsi</label>
                <div class="col-sm-10">
                    <select class="form-control" id="namadestinasi" name="kodeprovinsi">
                        <option value="<?php echo $rowedit['provinsiID']?>">
                            <?php echo $rowedit['provinsiID']?> <?php echo $rowedit2['provinsiNama'] ?></option>
                        <?php while($row = mysqli_fetch_array($dataprovinsi)) { ?>
                        <option value="<?php echo $row['provinsiID']?> ">
                            <?php echo $row['provinsiID']  ?>
                            <?php echo $row['provinsiNama']  ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="file" class="col-sm-2 col-form-label">Photo Hotel</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="file">
                    <img src="images/<?php echo $rowedit['hotelFoto'] ?>" style="width: 200px; height: 100px;">
                    <p class="help-block">Field Ini Digunakan Untuk Unggah File</p>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" name="ubah" class="btn btn-primary" value="ubah">
                    <input type="submit" name="batal" class="btn btn-secondary" value="batal">
                </div>
            </div>

        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Daftar Hotel</h1>
            </div>
        </div>
        <table class="table table-hover table-danger">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Hotel</th>
                    <th>Nama Hotel</th>
                    <th>Kode Provinsi</th>
                    <th>Nama Provinsi</th>
                    <th>Photo hotel</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $query = mysqli_query($con,"SELECT * FROM hotel,provinsi WHERE hotel.provinsiID = provinsi.provinsiID");
                    $nomor = 1;
                    while($row = mysqli_fetch_array($query)){
                        ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $row['hotelID'];?></td>
                    <td><?php echo $row['hotelNama'];?></td>
                    <td><?php echo $row['provinsiID'];?></td>
                    <td><?php echo $row['provinsiNama'];?></td>
                    <td>
                        <?php 
                            if(is_file("images/".$row['hotelFoto']))
                            { ?>
                        <img src="images/<?php echo $row['hotelFoto']?>" width="80">
                        <?php } else
                            echo "<img src='images/noimage.jpg' width='80'>"
                            ?>
                    </td>
                    <td> <a href="hotelubah.php?ubahfoto=<?php echo $row['hotelID']?>" class="btn btn-success btn-sm"
                            title="EDIT">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a></td>
                    <td><a href="hotelhapus.php?hapusfoto=<?php echo $row['hotelID']?>" class="btn btn-danger btn-sm"
                            title="DELETE"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php $nomor = $nomor + 1;?>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="col-sm-1"></div>
</div>
<?php include "footer.php"?>
<?php mysqli_close($con);
ob_end_flush(); ?>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js">
</script>

</html>