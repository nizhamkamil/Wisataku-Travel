<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konten Berita</title>
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
    if(isset($_POST['edit'])){
        $kodekonten = $_POST['inputkode'];
        $namakonten = $_POST['inputnama'];
        $tanggalkonten = $_POST['tanggalkonten'];
        $isikonten = $_POST['isikonten'];
        $nama = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $ekstensifile = pathinfo($nama, PATHINFO_EXTENSION);
        $kodeberita = $_POST['kodeberita'];

        //Periksa ektensi file harus JPG atau jpg
        if(($ekstensifile == "jpg") or ($ekstensifile == "JPG") or ($ekstensifile == "jpeg") or ($ekstensifile == "png")){
            move_uploaded_file($file_tmp,'images/'.$nama); //unggah file ke folder images
            mysqli_query($con,"UPDATE beritakonten SET kontenJudul='$namakonten', kontenTanggal='$tanggalkonten', kontenIsi='$isikonten', kontenFoto='$nama', beritaID='$kodeberita' WHERE kontenID='$kodekonten'");
            
            header("location:beritaKonten.php");
        }
    }


    $kontenkode = $_GET['ubahfoto'];
    $editkonten = mysqli_query($con,"SELECT * FROM beritakonten WHERE kontenID='$kontenkode'");
    $rowedit= mysqli_fetch_array($editkonten);

    $editberita = mysqli_query($con,"SELECT * FROM beritakonten,beritakategori WHERE kontenID ='$kontenkode'
                                AND beritakonten.beritaID=beritakategori.beritaID");
    $rowedit2 = mysqli_fetch_array($editberita);

    $databerita = mysqli_query($con,"SELECT * FROM beritakategori");
?>



<div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Input Konten Berita</h1>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="kodefoto" class="col-sm-2 col-form-label">Kode Konten Berita</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kodehotel" name="inputkode"
                        value="<?php echo $rowedit['kontenID'] ?>" maxlength="4" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="namafoto" class="col-sm-2 col-form-label">Judul Berita</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="namahotel" name="inputnama"
                        value="<?php echo $rowedit['kontenJudul'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Tanggal Dibuat</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="tanggalkonten" id="alamat"
                        value="<?php echo $rowedit['kontenTanggal'] ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="namafoto" class="col-sm-2 col-form-label">isi Konten</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                            name="isikonten"><?php echo $rowedit['kontenIsi'] ?></textarea>
                    </div>

                </div>
            </div>

            <div class="form-group row">
                <label for="namadestinasi" class="col-sm-2 col-form-label">Nama kategori berita</label>
                <div class="col-sm-10">
                    <select class="form-control" id="namadestinasi" name="kodeberita">
                        <option value="<?php echo $rowedit['beritaID'] ?>"><?php echo $rowedit['beritaID'] ?>
                            <?php echo $rowedit2['beritaKategori'] ?>
                        </option>
                        <?php while($row = mysqli_fetch_array($databerita)) { ?>
                        <option value="<?php echo $row['beritaID']?> ">
                            <?php echo $row['beritaID']  ?>
                            <?php echo $row['beritaKategori']  ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="file" class="col-sm-2 col-form-label">Photo Berita</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="file">
                    <img src="images/<?php echo $rowedit['kontenFoto'] ?>" style="width: 200px; height: 100px;">
                    <p class="help-block">Field Ini Digunakan Untuk Unggah File</p>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <input type="submit" name="edit" class="btn btn-primary" value="edit">
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
                <h1 class="display-4">Daftar Konten Berita</h1>
            </div>
        </div>
        <table class="table table-hover table-danger">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Konten</th>
                    <th>Judul Konten</th>
                    <th>tanggal Dibuat</th>
                    <th>Isi Konten</th>
                    <th>Foto Konten</th>
                    <th>kategori Berita</th>
                    <th>nama Kategori Berita</th>
                    <th colspan="2" style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $query = mysqli_query($con,"SELECT beritakonten.*, beritakategori.* 
                FROM beritakonten,beritakategori
                WHERE beritakonten.beritaID = beritakategori.beritaID");
                    $nomor = 1;
                    while($row = mysqli_fetch_array($query)){
                        ?>
                <tr>
                    <td><?php echo $nomor;?></td>
                    <td><?php echo $row['kontenID'];?></td>
                    <td><?php echo $row['kontenJudul'];?></td>
                    <td><?php echo $row['kontenTanggal'];?></td>
                    <td><?php echo $row['kontenIsi'];?></td>
                    <td>
                        <?php 
                            if(is_file("images/".$row['kontenFoto']))
                            { ?>
                        <img src="images/<?php echo $row['kontenFoto']?>" width="80">
                        <?php } else
                            echo "<img src='images/noimage.jpg' width='80'>"
                            ?>
                    </td>
                    <td><?php echo $row['beritaID'];?></td>
                    <td><?php echo $row['beritaKategori'];?></td>
                    <td> <a href="beritaKontenUbah.php?ubahfoto=<?php echo $row['kontenID']?>"
                            class="btn btn-success btn-sm" title="EDIT">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg></a></td>
                    <td><a href="beritaKontenHapus.php?hapusfoto=<?php echo $row['kontenID']?>"
                            class="btn btn-danger btn-sm" title="DELETE"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
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