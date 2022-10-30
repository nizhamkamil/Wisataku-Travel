<!doctype html>
<?php 
    include "includes/config.php";
    
    $selectarea = mysqli_query($con,"SELECT * FROM area");
    $selectkategori = mysqli_query($con,"SELECT * FROM kategori");
    $selectprovinsi = mysqli_query($con,"SELECT * FROM provinsi");
    $selectdestinasi = mysqli_query($con,"SELECT * FROM destinasi");
    $selectphotodestinasi = mysqli_query($con,"SELECT * FROM fotodestinasi,destinasi,area,provinsi WHERE fotodestinasi.destinasiID = destinasi.destinasiID AND destinasi.areaID = area.areaID 
    AND area.provinsiID = provinsi.provinsiID LIMIT 6");
    
    $selectkategori1 = mysqli_query($con,"SELECT * FROM kategori");
   
    $kategoriberita= mysqli_query($con,"SELECT * FROM beritakategori");
    $kategoriberita1= mysqli_query($con,"SELECT * FROM beritakategori");
    
    
    $jumlahtampilberita = 2;
    $jumlahtampilhotel = 2;
    $halaman = (isset($_GET['page']))? $_GET['page'] : 1;
    $halamanhotel = (isset($_GET['pagehotel']))? $_GET['pagehotel'] : 1;
    $mulaitampilberita = ($halaman - 1) * $jumlahtampilberita;
    $mulaitampilhotel = ($halamanhotel - 1) * $jumlahtampilhotel;
    $selectberita = mysqli_query($con,"SELECT beritakonten.*, beritakategori.* FROM beritakonten, beritakategori
                                WHERE beritakonten.beritaID = beritakategori.beritaID LIMIT $mulaitampilberita, $jumlahtampilberita");

    $selecthotel = mysqli_query($con,"SELECT * FROM hotel,provinsi WHERE hotel.provinsiID= provinsi.provinsiID LIMIT $mulaitampilhotel, $jumlahtampilhotel");                            

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
        <a class="navbar-brand" href="index.php"
            style="margin-left: 100px; margin-right: 50px; font-size:30px">WISATAKU</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php" style="font-size: 18px;">Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
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
                        aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
                        Kategori
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(mysqli_num_rows($selectkategori) > 0) {
                                while($rowkategori = mysqli_fetch_array($selectkategori)){ ?>
                        <a class="dropdown-item"
                            href="kategori.php?kategori=<?php echo $rowkategori['kategoriID']?>"><?php echo $rowkategori['kategoriNama'] ?></a>
                        <?php } } ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
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
                        aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
                        Event
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="event.php">Event News</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
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
    <!-- SLIDER START -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-bottom: 50px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item">
                <img src="images/Borobudur.jpg" alt="No Images Found">
                <div class="carousel-caption d-none d-md-block">
                    <h5>CANDI BOROBUDUR</h5>
                    <p>Sebuah Candi Besar Peninggalan Jaman Kerajaan</p>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="images/Green-Canyon-Pangandaran-2.jpg" alt="No Images Found">
                <div class=" carousel-caption d-none d-md-block">
                    <h5>GREEN CANYON PANGANDARAN</h5>
                    <p>Sebuah Panorama Dua Tebing Hasil Pahatan Alam</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/Kawah Ijen.jpg" alt="No Images Found">
                <div class=" carousel-caption d-none d-md-block">
                    <h5>KAWAH IJEN</h5>
                    <p>Sebuah Danau Kawah yang Berada di Puncak Gunung Ijen</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- SLIDER END -->
    <!-- MEDIA OBJECT START -->
    <div class="container">
        <div class=" row">
            <div class="col-md-8">
                <h1 style="text-align: center; margin-bottom: 50px; font-family:'Javanese'">NEWS</h1>
                <?php if(mysqli_num_rows($selectberita) > 0 ) {
                    while($rowberita = mysqli_fetch_array($selectberita)){
                         ?>
                <div class="media" style="margin-bottom: 50px ">
                    <img class="align-self-center mr-3" src="images/<?php echo $rowberita['kontenFoto'] ?>"
                        alt="Generic placeholder image" style="width:250px">
                    <div class="media-body">
                        <h3 class="mt-0"><?php echo $rowberita['kontenJudul'] ?></h3>
                        <h5 style="opacity: 60%; font-size:16px;"> Dibuat Pada :
                            <?php echo $rowberita['kontenTanggal'] ?></h5>
                        <h5 style="opacity: 60%; font-size:16px;"> Kategori :
                            <?php echo $rowberita['beritaKategori'] ?></h5>
                        <p class="mb-0">
                            <?php echo (strlen($rowberita['kontenIsi']) > 200) ? substr($rowberita['kontenIsi'],0,200) :$rowberita['kontenIsi'] ?>
                            <a href="beritadetil.php?detilberita=<?php echo $rowberita['kontenID']?>">See More..</a>
                        </p>
                    </div>
                </div>
                <?php } } ?>
                <?php $queryberitakonten = mysqli_query($con,"SELECT * FROM beritakonten");
                $jumlahrecordberita = mysqli_num_rows($queryberitakonten);
                $jumlahpage = ceil($jumlahrecordberita/$jumlahtampilberita) 
                
                ?>
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
            <div class="col-md-4">
                <h1 style="text-align: center; margin-bottom: 50px; font-family:'Javanese'"> CATEGORY </h1>
                <ul class="list-group">
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
                <div class="embed-responsive embed-responsive-16by9" style="margin-top: 50px;">
                    <iframe style="filter: brightness(70%);" width="1237" height="196"
                        src="https://www.youtube.com/embed/-tHj7kSqpnA" title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- MEDIA OBJECT END -->
    <!-- GALLERY START -->
    <div class="container">
        <h1 style="text-align: center; margin-top:50px; font-family:'Constantia'">Gallery Foto Destinasi</h1>
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
                    </figcaption>
                </figure>
            </div>
            <?php }?>
            <a href="destinasimore.php" class="btn btn-primary btn-lg btn-block paging" id="more">Discover More</a>
        </div>
    </div>
    <!-- GALLERY END -->
    <!-- JUMBOTRON START -->
    <div class="jumbotron jumbotron-fluid" style="margin-top: 100px; margin-bottom:100px">
        <div class="container">
            <h1 class="display-8" style="text-align: center; font-size:60px; font-family:'Consolas Bold Italic'">About
                Author </h1>
            <div class="text-center">
                <img src="images/PP.jpg" style="border-radius: 50%; width: 200px" class="circle" alt="...">
            </div>
            <p class="lead" style="text-align: center; font-size:30px; margin-top:30px;">Nizham Kamil Hia - 825200069
            </p>
            <p class="lead" style="text-align: center; font-size:30px; margin-top:30px; font-weight:bold">Contacts :</p>
            <p class="lead" style="text-align: center; font-size:20px; margin-top:10px; opacity: 70% ">Email :
                nizham.825200069@stu.untar.ac.id</p>
            <p class="lead" style="text-align: center; font-size:20px; margin-top:10px; opacity: 70%">Phone :
                081513604871</p>
        </div>
    </div>
    <!-- JUMBOTRON END -->
    <!-- GALLERY HOTEL START -->
    <div class="container">
        <h1 style="text-align: center;font-family:'Constantia'">Gallery Foto Hotel</h1>
        <div class="row">
            <?php while($rowfotohotel = mysqli_fetch_array($selecthotel)){ ?>
            <div class="col-md-6">
                <figure class="figure" style="margin-top: 50px; margin-left:100px">
                    <img src="images/<?php echo $rowfotohotel['hotelFoto'] ?>" class="figure-img img-fluid rounded"
                        alt="A generic square placeholder image with rounded corners in a figure."
                        style="height:250px; width:350px">
                    <figcaption class="figure-caption"><?php echo $rowfotohotel['hotelNama'] ?></figcaption>
                    <figcaption class="figure-caption"><?php echo $rowfotohotel['provinsiNama'] ?></figcaption>
                </figure>
            </div>
            <?php }?>
            <!-- Pagination Hotel -->
            <?php $queryhotel = mysqli_query($con,"SELECT * FROM hotel");
                $jumlahrecordhotel = mysqli_num_rows($queryhotel);
                $jumlahpagehotel = ceil($jumlahrecordhotel/$jumlahtampilhotel) 
                
                ?>
            <nav aria-label="Page navigation example" style="margin-left: 110px;">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link"
                            href="?page=<?php $nomorhalamanhotel=1; echo $nomorhalamanhotel?>">First</a></li>
                    <?php for($nomorhalamanhotel=1; $nomorhalamanhotel<=$jumlahpagehotel; $nomorhalamanhotel++) { ?>
                    <li class="page-item">
                        <?php  
                            if($nomorhalamanhotel!=$halamanhotel){
                            ?>
                        <a class="page-link"
                            href="?pagehotel=<?php echo $nomorhalamanhotel?>"><?php echo $nomorhalamanhotel ?></a><?php }
                                 else { ?>
                        <a class="page-link"
                            href="?pagehotel=<?php echo $nomorhalamanhotel?>"><?php echo $nomorhalamanhotel ?></a>
                        <?php }?>
                    </li>
                    <?php } ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $nomorhalamanhotel-1?>">Last</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- GALLERY HOTEL END -->
    <!-- Contact Us START-->
    <div class="jumbotron jumbotron-fluid bg-dark" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h3 style="margin-bottom: 30px; margin-top:-30px; color:white">
                        Contact Us</h3>
                    <p style="color:white; display:inline-block;">Email : nizham.825200069@stu.untar.ac.id</p> <br>
                    <p style="color:white; display:inline-block;">Phone : 081513604871</p>
                </div>
                <div class="col-sm-4">
                    <h3 style="margin-bottom: 30px; margin-top:-30px; color:white">
                        About Wisataku</h3>
                    <p style="color:white">Website ini dibuat dalam rangka memenuhi tugas akhir web development</p>
                    <div class="icon">
                        <a href="#" style="margin-right: 10px;"><img src="images/Facebook logo_32px.png" /></a>
                        <a href="#" style="margin-right: 10px;"><img src="images/twitter_32px.png" /></a>
                        <a href="#" style="margin-right: 10px;"><img src="images/linkedin_32px.png" /></a>
                        <a href="#" style="margin-right: 10px;"><img src="images/Discord New_32px.png" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us END-->
    <!-- Footer START -->
    <div class="jumbotron jumbotron-fluid bg-info" style="margin-top:-35px;margin-bottom:-35px; height:50px">
        <div class="container">
            <p class="lead" style="text-align: center; margin-top:-10px; color:white">copyright &copy; Nizham Kamil
                Hia-825200069.
                All Rights Reserved</p>
        </div>
    </div>
    <!-- Footer END -->

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