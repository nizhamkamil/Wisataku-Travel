<!doctype html>
<?php 
    include "includes/config.php";
    
    $selectarea = mysqli_query($con,"SELECT * FROM area");
    $selectkategori = mysqli_query($con,"SELECT * FROM kategori");
    $selectprovinsi = mysqli_query($con,"SELECT * FROM provinsi");
    $selectdestinasi = mysqli_query($con,"SELECT * FROM destinasi");
    
    $selecthotel = mysqli_query($con,"SELECT * FROM hotel");
   
    $kategoriberita= mysqli_query($con,"SELECT * FROM beritakategori");
    $kategoriberita1= mysqli_query($con,"SELECT * FROM beritakategori");
    
    
    $jumlahtampilberita = 6;
    $halaman = (isset($_GET['page']))? $_GET['page'] : 1;
    $mulaitampilberita = ($halaman - 1) * $jumlahtampilberita;
    $selectphotodestinasi = mysqli_query($con,"SELECT * FROM fotodestinasi,destinasi,area,provinsi WHERE fotodestinasi.destinasiID = destinasi.destinasiID AND destinasi.areaID = area.areaID 
    AND area.provinsiID = provinsi.provinsiID LIMIT $mulaitampilberita, $jumlahtampilberita");
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
    <!-- GALLERY START -->
    <div class="container">
        <h1 style="text-align: center; margin-top:50px">Gallery Foto Destinasi</h1>
        <div class="row">
            <?php while($rowfotodestinasi = mysqli_fetch_array($selectphotodestinasi)){ ?>
            <div class="col-sm-4">
                <figure class="figure" style="margin-top: 50px;">
                    <img src="images/<?php echo $rowfotodestinasi['fotoFile'] ?>" class="figure-img img-fluid rounded"
                        alt="A generic square placeholder image with rounded corners in a figure."
                        style="height:250px; width:350px">
                    <figcaption class="figure-caption"><?php echo $rowfotodestinasi['fotoNama'] ?></figcaption>
                    <figcaption class="figure-caption">Area: <?php echo $rowfotodestinasi['arenaNama'] ?></figcaption>
                    <figcaption class="figure-caption">Provinsi: <?php echo $rowfotodestinasi['provinsiNama'] ?>
                </figure>
            </div>
            <?php }?>
            <?php $queryberitakonten = mysqli_query($con,"SELECT * FROM fotodestinasi");
                $jumlahrecordberita = mysqli_num_rows($queryberitakonten);
                $jumlahpage = ceil($jumlahrecordberita/$jumlahtampilberita) 
                
                ?>

        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link"
                        href="?page=<?php $nomorhalaman=1; echo $nomorhalaman?>">First</a></li>
                <?php for($nomorhalaman=1; $nomorhalaman<=$jumlahpage; $nomorhalaman++) { ?>
                <li class="page-item">
                    <?php  
                            if($nomorhalaman!=$halaman){
                            ?>
                    <a class="page-link" href="?page=<?php echo $nomorhalaman?>"><?php echo $nomorhalaman ?></a><?php }
                                 else { ?>
                    <a class="page-link" href="?page=<?php echo $nomorhalaman?>"><?php echo $nomorhalaman ?></a>
                    <?php }?>
                </li>
                <?php } ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $nomorhalaman-1?>">Last</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- GALLERY END -->
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