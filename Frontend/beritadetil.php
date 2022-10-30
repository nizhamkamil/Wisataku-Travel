<!doctype html>
<?php 
    include "includes/config.php";
    
    $selectarea = mysqli_query($con,"SELECT * FROM area");
    $selectkategori = mysqli_query($con,"SELECT * FROM kategori");
    $selectprovinsi = mysqli_query($con,"SELECT * FROM provinsi");
    $selectdestinasi = mysqli_query($con,"SELECT * FROM destinasi");
    $selectphotodestinasi = mysqli_query($con,"SELECT * FROM fotodestinasi");
    $selecthotel = mysqli_query($con,"SELECT * FROM hotel");
   
    $kategoriberita= mysqli_query($con,"SELECT * FROM beritakategori");
    $kategoriberita1= mysqli_query($con,"SELECT * FROM beritakategori");
    
    
    $jumlahtampilberita = 2;
    $halaman = (isset($_GET['page']))? $_GET['page'] : 1;
    $mulaitampilberita = ($halaman - 1) * $jumlahtampilberita;
    $selectberita = mysqli_query($con,"SELECT beritakonten.*, beritakategori.* FROM beritakonten, beritakategori
                                WHERE beritakonten.beritaID = beritakategori.beritaID LIMIT $mulaitampilberita, $jumlahtampilberita");

    $kodekonten = $_GET['detilberita']; 
    $detilberita = mysqli_query($con,"SELECT * FROM beritakonten,beritakategori WHERE kontenID ='$kodekonten' AND beritakonten.beritaID = beritakategori.beritaID");
    $rowdetilberita = mysqli_fetch_array($detilberita);
    
    
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css1/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Wisataku</title>
</head>

<body>

    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php" style="margin-left: 100px; margin-right: 50px">WISATAKU</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Area
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(mysqli_num_rows($selectarea) > 0) {
                                while($rowarea = mysqli_fetch_array($selectarea)){ ?>
                        <a class="dropdown-item"
                            href="area.php?area=<?php echo $rowarea['areaID'] ?>"><?php echo $rowarea['arenaNama'] ?></a>
                        <?php } } ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Kategori
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(mysqli_num_rows($selectarea) > 0) {
                                while($rowkategori = mysqli_fetch_array($selectkategori)){ ?>
                        <a class="dropdown-item"
                            href="kategori.php?kategori=<?php echo $rowkategori['kategoriID']?>"><?php echo $rowkategori['kategoriNama'] ?></a>
                        <?php } } ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Provinsi
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(mysqli_num_rows($selectprovinsi) > 0) {
                                while($rowprovinsi = mysqli_fetch_array($selectprovinsi)){ ?>
                        <a class="dropdown-item"
                            href="provinsi.php?provinsi=<?php echo $rowprovinsi['provinsiID'] ?>"><?php echo $rowprovinsi['provinsiNama'] ?></a>
                        <?php } } ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        News
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(mysqli_num_rows($kategoriberita1) > 0) {
                                while($rowberitakategori = mysqli_fetch_array($kategoriberita1)){ ?>
                        <a class="dropdown-item"
                            href="beritakategori.php?kategoriberita=<?php echo $rowberitakategori['beritaID']?>"><?php echo $rowberitakategori['beritaKategori'] ?></a>
                        <?php } } ?>
                    </div>
                <li class="nav-item">
                    <a class="nav-link" href="reservasi.php">Reservasi<span class="sr-only">(current)</span></a>
                </li>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAVBAR END -->
    <!-- MEDIA OBJECT START -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 style="margin-top:50px"><?php echo $rowdetilberita['kontenJudul'] ?></h1>
                <h5 style="opacity: 70%; margin-top: 20px">Author : Nizham Kamil</h5>
                <h6 style="opacity: 50%;"> Kategori : <?php echo $rowdetilberita['beritaKategori'] ?> </h6>
                <img src="images/<?php echo $rowdetilberita['kontenFoto'] ?>" alt="" style="width: 100%;">
                <h5 style="opacity: 70%; margin-top: 20px; font-size:16px">Dibuat Tanggal :
                    <?php echo $rowdetilberita['kontenTanggal'] ?></h5>
                <p style="text-align: justify; margin-top:20px"><?php echo $rowdetilberita['kontenIsi'] ?></p>
            </div>
            <div class="col-md-4">
                <ul class="list-group" style="margin-top: 225px;">
                    <?php if(mysqli_num_rows($kategoriberita) > 0 ) {
                        while($rowkategoriberita = mysqli_fetch_array($kategoriberita)){ ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $rowkategoriberita['beritaKategori'] ?>
                        <span class="badge badge-primary badge-pill">
                            <?php $jumlahkategoriberita = mysqli_query($con,"SELECT * FROM beritakonten WHERE beritaID ='$rowkategoriberita[beritaID]'");
                                $rowjumlahberita = mysqli_num_rows($jumlahkategoriberita);
                                echo $rowjumlahberita;
                             ?>
                        </span>
                    </li>
                    <?php } }?>
                </ul>
            </div>
        </div>
    </div>


    <!-- MEDIA OBJECT END -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>