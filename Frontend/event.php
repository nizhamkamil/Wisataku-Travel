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

    
    $selectevent = mysqli_query($con,"SELECT * FROM event,kabupaten WHERE event.kabupatenKode = kabupaten.kabupatenKode");
 
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
                        aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">
                        Event
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="event.php">Event News</a>
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
        <h1 style="margin-top:50px; text-align:center; color:#17a2b8">CALENDAR OF EVENTS</h1>
        <div class="row">
            <?php while($rowevent = mysqli_fetch_array($selectevent)) { ?>
            <div class="media" style="margin-bottom: 50px; margin-top:50px">
                <img class="align-self-center mr-3" src="images/<?php echo $rowevent['eventPoster'] ?>"
                    alt="Generic placeholder image" style="width:250px; height:250px">
                <div class="media-body">
                    <h5 style="border-bottom: 2px solid gray; width:25%"> Kabupaten
                        <?php echo $rowevent['kabupatenNama'] ?></h5>
                    <h3 class="mt-0" style="color:#17a2b8"><?php echo $rowevent['eventNama'] ?></h3>

                    <p class="mb-0" style="opacity:70%">
                        <?php echo $rowevent['eventKet']?>
                    </p>
                    <h5 style="text-align: justify; margin-top:20px; margin-bottom:50px">Event On
                        <?php echo $rowevent['eventMulai'] ?> -
                        <?php echo $rowevent['eventSelesai'] ?></h5>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <!-- MEDIA OBJECT END -->
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