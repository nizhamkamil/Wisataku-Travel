<!DOCTYPE html>
<html lang="en">

<?php
    include "includes/config.php";
    if(isset($_POST['edit']))
    {
    $provinsikode = $_POST["provinsiID"];  
    $provinsinama = $_POST["provinsiNama"];
    $provinsitgl = $_POST["provinsiTgl"];

    
        mysqli_query($con,"UPDATE provinsi SET  provinsiNama = '$provinsinama', provinsiTglBerdiri = '$provinsitgl'
        WHERE provinsiID ='$provinsikode' ");
        header("location:ProvinsiInput.php");
    }

    $kodeprovinsi = $_GET['ubah'];
    $editprovinsi = mysqli_query($con,"SELECT * FROM provinsi WHERE provinsiID ='$kodeprovinsi'");
    $rowedit = mysqli_fetch_array($editprovinsi);
?>
<?php include "header.php";?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provinsi Input</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
</head>

<body>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">input Provinsi</h1>
                </div>
            </div>
            <form method="POST">
                <div class="form-group row">
                    <label for="kodedestinasi" class="col-sm-2 col-form-label">Kode Provinsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="provinsiID" id="kodedestinasi"
                            value="<?php echo $rowedit['provinsiID'] ?>" readonly maxlength="4" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namadestinasi" class="col-sm-2 col-form-label">Nama Provinsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="provinsiNama" id="namadestinasi"
                            value="<?php echo $rowedit['provinsiNama'] ?>" placeholder="Nama Provinsi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Tanggal Berdiri Provinsi</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="provinsiTgl" id="alamat"
                            value="<?php echo $rowedit['provinsiTglBerdiri'] ?>" placeholder="Alamat Destinasi">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-primary" value="edit" name="edit">
                        <input type="reset" class="btn btn-secondary" value="batal" name="batal">
                        <a class="btn btn-primary" href="AreaInput.php" role="button">Form2</a>
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
                    <h1 class="display-4">Daftar Provinsi</h1>
                    <H2>Hasil entri data pada tabel Provinsi</H2>
                </div>
            </div>
            <!--Penutup Jumbotron-->
            <form method="POST">
                <div class="form-group row mb-2">
                    <label for="search" class=" col-sm-3">Nama Provinsi</label>
                    <div class="col-sm-6">
                        <input type="text" name="search" class="form-control" id="search" value="<?php if(isset($_POST['search'])) {
                                echo $_POST['search'];}?>" placeholder="Cari Nama Provinsi">
                    </div>
                    <input type="submit" name="kirim" class="col-sm-1 btn btn-primary" value="Search">
                </div>
            </form>
            <table class="table table-hover table-danger">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Provinsi</th>
                        <th>Tanggal Berdiri Provinsi</th>
                        <th colspan="2" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($_POST["kirim"])){
                        $search = $_POST['search'];
                        $query = mysqli_query($con,"SELECT * FROM provinsi WHERE provinsiNama LIKE '%".$search."%'");
                    }else{
                        $query = mysqli_query($con,"SELECT * FROM provinsi");
                    }
                    $nomor = 1;
                    while ($row = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $nomor;?></td>
                        <td><?php echo $row['provinsiID'];?></td>
                        <td><?php echo $row['provinsiNama'];?></td>
                        <td><?php echo $row['provinsiTglBerdiri'];?></td>
                        <td> <a href="provinsiUbah.php?ubah=<?php echo $row['provinsiID']?>"
                                class="btn btn-success btn-sm" title="EDIT">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg></a></td>
                        <td><a href="provinsihapus.php?hapus=<?php echo $row['provinsiID']?>"
                                class="btn btn-danger btn-sm" title="DELETE"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                </svg>
                            </a>
                        </td>
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
</body>
<?php include "footer.php"?>
<?php mysqli_close($con);
ob_end_flush(); ?>

</html>