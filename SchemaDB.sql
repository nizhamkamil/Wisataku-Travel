-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 04:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata`
--
CREATE DATABASE IF NOT EXISTS `wisata` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wisata`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` char(4) NOT NULL,
  `adminNama` varchar(30) NOT NULL,
  `adminEmail` varchar(60) NOT NULL,
  `adminPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminNama`, `adminEmail`, `adminPassword`) VALUES
('A001', 'Jone', 'jone@yahoo.com', '1234'),
('A002', 'alex', 'alex@yahoo.com', 'd93591bdf7860e1e4ee2fca799911215');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `areaID` char(4) NOT NULL,
  `arenaNama` char(35) NOT NULL,
  `areaWilayah` char(35) NOT NULL,
  `areaKeterangan` varchar(255) NOT NULL,
  `provinsiID` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`areaID`, `arenaNama`, `areaWilayah`, `areaKeterangan`, `provinsiID`) VALUES
('AR01', 'Jakarta Utara', 'Wilayah jakarta Utara', 'Wilayah administrasi jakarta bagian utara', 'P01'),
('AR02', 'Jakarta Pusat', 'Wilayah Jakarta Pusat', 'Wilayah administrasi jakarta bagian pusat', 'P01'),
('AR03', 'Gn.Bromo', 'Wilayah Pegunungan bromo', 'tempat dimana gunung bromo berada', 'P04'),
('AR04', 'Gn Merapi', 'Wilayah Gunung Merapi', 'tempat dimana gunung merapi berada', 'P04'),
('AR05', 'Probolinggo', 'kabupaten Probolinggo', 'salah satu kabupaten di jawa timur', 'P04'),
('AR06', 'Pangandaran', 'Wilayah kabupaten pangandaran', 'salah satu kabupaten di jawa barat', 'P02'),
('AR07', 'Magelang', 'Wilayah Magelang', 'salah satu kota di Jawa Tengah', 'P03'),
('AR08', 'Area 8', 'Wilayah 8', 'Keterangan tentang area 8', 'P04');

-- --------------------------------------------------------

--
-- Table structure for table `beritakategori`
--

CREATE TABLE `beritakategori` (
  `beritaID` char(4) NOT NULL,
  `beritaKategori` char(100) NOT NULL,
  `beritaKeterangan` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beritakategori`
--

INSERT INTO `beritakategori` (`beritaID`, `beritaKategori`, `beritaKeterangan`) VALUES
('B01', 'Budaya', 'Lorem ipsum dolor sit amet'),
('B02', 'Ekonomi', 'Lorem Ipsum Dolor Sit Amet'),
('B03', 'Teknologi', 'Lorem Ipsum Dolor Sit Amet'),
('B04', 'Wisata', 'Lorem Ipsum Dolor Sit Amat'),
('B05', 'Kuliner', 'Lorem Ipsum Dolor Sit Amet'),
('B06', 'Kategoriberita6', 'LOREM IPSUM');

-- --------------------------------------------------------

--
-- Table structure for table `beritakonten`
--

CREATE TABLE `beritakonten` (
  `kontenID` char(4) NOT NULL,
  `kontenJudul` char(100) NOT NULL,
  `kontenTanggal` date NOT NULL,
  `kontenIsi` text NOT NULL,
  `kontenFoto` text NOT NULL,
  `beritaID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beritakonten`
--

INSERT INTO `beritakonten` (`kontenID`, `kontenJudul`, `kontenTanggal`, `kontenIsi`, `kontenFoto`, `beritaID`) VALUES
('K01', 'Pulau Permata, Tempat Wisata Cantik di Lampung', '2021-11-20', 'Salah satu destinasi wisata di Kota Bandar Lampung, Provinsi Lampung, adalah Pulau Permata. Pulau Permata adalah salah satu pulau kecil yang menjadi tempat wisata andalan di Bandar Lampung. Banyak wisatawan yang menjadikan Pulau Permata di Bandar Lampung sebagai alternatif tempat menghabiskan waktu liburan. Bagi anda yang ingin berkunjung ke Pulau Permata, ada dua pilihan tempat. Pertama bisa menyeberang dari Pulau Pasaran Bandar Lampung atau lewat TPI Lempasing.Pulau Permata itu merupakan satu-satunya pulau yang dekat dari pusat Kota Bandar Lampung.Menuju Pulau Permata bisa ditempuh dengan waktu kurang lebih 15 menit menggunakan perahu ketek.Ketika anda masuk ke lokasi Pulau Permata, dari kejauhan terlihat plang bertuliskan Pulau Permata yang dengan warna cat pink dan putih.Di sana, banyak sekali keindahan yang bisa anda nikmati. Diantaranya, indahnya pasir putih dan deburan ombak di pantai. Pengelola juga menyediakan fasilitas diantara pondokan dan tempat untuk berswafoto. Beberapa spot swafoto seperti loksi dermaga, ayunan dan lain lain. ', 'PulauPermata.jpg', 'B04'),
('K02', 'Rencana Baru daur Ulang Sampah Antariksa Jadi Bahan Bakar Roket', '2021-11-05', 'Perusahaan asal Australia, Neumann Space, tengah berupaya mendaur ulang sampah antariksa untuk kemudian dijadikan sebagai bahan bakar roket.Mengutip WOIN, apa yang dilakukan Neumann Space menjadi salah satu dari upaya organisasi antariksa internasional untuk mendaur ulang sampah antariksa yang berbahaya.Sebagaimana diketahui, kini orbit Bumi kian tersumbat oleh puing-puing pesawat ruang angkasa. Hal ini menimbulkan ancaman bagi satelit komunikasi dan Stasiun Luar Angkasa Internasional (ISS).Belum lagi upaya sejumlah negara di Bumi yang mengirimkan puing-puing tersebut terbang ke luar angkasa', 'space-junk-alias-sampah-antariksa_169.jpeg', 'B03'),
('K03', 'Tempat Wisata Pantai Tersembunyi di Bali, Indah', '2021-11-13', 'Pulau Dewata terkenal akan keindahan pantainya yang digemari tidak hanya oleh wisatawan nusantara (wisnus), juga wisatawan mancanegara (wisman). Selain menawarkan pemandangan alam, pantai-pantai di Bali juga menawarkan sejumlah kegiatan wisata air yang menarik.', 'Pantai Bali.jpg', 'B04'),
('K04', 'Mengenal Tari Kecak, Tarian Unik Asal Bali yang Dibawakan Massal', '2021-11-22', 'Tari Kecak merupakan salah satu seni tari nusantara terkenal yang berasal dari Bali. Seni tari ini biasanya dipertunjukkan secara massal oleh puluhan bahkan ratusan penari laki-laki yang duduk dengan pola melingkar.Dinamakan tari Kecak, karena pada saat irama musik dimainkan, para penari akan mengangkat dan menggerakkan kedua lenganya sambil menyerukan kata \"cak ke cak ke cak\". Para penari akan mengenakan kostum bermotif kotak-kotak putih hitam, mirip dengan pola papan catur.Tari ini dipentaskan hanya pada saat-saat tertentu untuk mengusir wabah penyakit. Kesakralan tari itu membuat masyarakat tidak bisa mementaskannya setiap saat. Diyakini apabila dipentaskan setiap saat nilai kesakralan akan menjadi lemah serta aura magisnya akan hilang.Ni Made Pira Erawati dalam artikelnya Pariwisata Dan Budaya Kreatif : Sebuah Studi Tentang Tari Kecak Di Bali (2019) menuliskan Walter Spies dan penari sekaligus peneliti tari dari Inggris, Baryl de Zoete menyadari orang asing yang berkunjung sangat berminat untuk menyaksikan seni sakral sebagai ciri khas atau identitas etnis Bali.Akhirnya mereka bekerja sama dengan penari Bali, Wayan Limbak dari Banjar Bedulu, Gianyar, untuk mengemas koor laki-laki pada tari Sanghyang. Kemasan koor laki-laki tari Sanghyang itu dimodifikasi menjadi tari Kecak yang akhirnya dapat di saksikan oleh wisatawan.', 'tari-kecak-1.jpeg', 'B01'),
('K05', 'LOREM IPSUM', '2021-11-24', 'Tari Kecak merupakan salah satu seni tari nusantara terkenal yang berasal dari Bali. Seni tari ini biasanya dipertunjukkan secara massal oleh puluhan bahkan ratusan penari laki-laki yang duduk dengan pola melingkar.Dinamakan tari Kecak, karena pada saat irama musik dimainkan, para penari akan mengangkat dan menggerakkan kedua lenganya sambil menyerukan kata \"cak ke cak ke cak\". Para penari akan mengenakan kostum bermotif kotak-kotak putih hitam, mirip dengan pola papan catur.Tari ini dipentaskan hanya pada saat-saat tertentu untuk mengusir wabah penyakit. Kesakralan tari itu membuat masyarakat tidak bisa mementaskannya setiap saat. Diyakini apabila dipentaskan setiap saat nilai kesakralan akan menjadi lemah serta aura magisnya akan hilang.Ni Made Pira Erawati dalam artikelnya Pariwisata Dan Budaya Kreatif : Sebuah Studi Tentang Tari Kecak Di Bali (2019) menuliskan Walter Spies dan penari sekaligus peneliti tari dari Inggris, Baryl de Zoete menyadari orang asing yang berkunjung sangat berminat untuk menyaksikan seni sakral sebagai ciri khas atau identitas etnis Bali.Akhirnya mereka bekerja sama dengan penari Bali, Wayan Limbak dari Banjar Bedulu, Gianyar, untuk mengemas koor laki-laki pada tari Sanghyang. Kemasan koor laki-laki tari Sanghyang', 'Kuliner1.jpg', 'B05'),
('K06', 'tesberita', '2021-11-24', 'Salah satu destinasi wisata di Kota Bandar Lampung, Provinsi Lampung, adalah Pulau Permata. Pulau Permata adalah salah satu pulau kecil yang menjadi tempat wisata andalan di Bandar Lampung. Banyak wisatawan yang menjadikan Pulau Permata di Bandar Lampung sebagai alternatif tempat menghabiskan waktu liburan. Bagi anda yang ingin berkunjung ke Pulau Permata, ada dua pilihan tempat. Pertama bisa menyeberang dari Pulau Pasaran Bandar Lampung atau lewat TPI Lempasing.Pulau Permata itu merupakan satu-satunya pulau yang dekat dari pusat Kota Bandar Lampung.Menuju Pulau Permata bisa ditempuh dengan waktu kurang lebih 15 menit menggunakan perahu ketek.Ketika anda masuk ke lokasi Pulau Permata, dari kejauhan terlihat plang bertuliskan Pulau Permata yang dengan warna cat pink dan putih.Di sana, banyak sekali keindahan ya', 'Green-Canyon-Pangandaran-2.jpg', 'B02');

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `destinasiID` char(5) NOT NULL,
  `destinasiNama` varchar(35) NOT NULL,
  `destinasiAlamat` varchar(255) NOT NULL,
  `kategoriID` char(20) NOT NULL,
  `areaID` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`destinasiID`, `destinasiNama`, `destinasiAlamat`, `kategoriID`, `areaID`) VALUES
('WS01', 'Museum Fatahillah', 'Jl. Taman Fatahillah No.1', 'WK02', 'AR01'),
('WS02', 'Tugu Monas', 'Gambir, Kecamatan Gambir', 'WK02', 'AR02'),
('WS03', 'Gunung Bromo', 'Podokoyo, Tosari, Pasuruan, Jawa Timur', 'WK01', 'AR03'),
('WS04', 'Kawah Ijen', 'Tamansari, Kabupaten Banyuwangi', 'WK01', 'AR04'),
('WS05', 'Gili Ketapang', 'Sapia, Kecamatan Sumberasih', 'WK03', 'AR05'),
('WS06', 'Hutan Damar', 'Kalianan, Krucil, Probolinggo', 'WK01', 'AR05'),
('WS07', 'Masjid Istiqlal', 'Jl.Taman Wijaya Kusuma', 'WK04', 'AR02'),
('WS08', 'Gereja Katedral', 'Jl. Katedral No.7B', 'WK04', 'AR02'),
('WS09', 'Mangrove Angke Kapuk', 'Jl. Garden House, Kamal Muara', 'WK01', 'AR01'),
('WS10', 'Green Canyon', 'Desa Kertayasa Kecamatan Cijulang', 'WK01', 'AR06'),
('WS11', 'Candi Borobudur', 'Jl. Badrawati, Kecamatan borobudur', 'WK02', 'AR07'),
('WS12', 'Destinasi 12', 'alamat jalan 12', 'WK05', 'AR08');

-- --------------------------------------------------------

--
-- Table structure for table `fotodestinasi`
--

CREATE TABLE `fotodestinasi` (
  `fotoID` char(5) NOT NULL,
  `fotoNama` char(60) NOT NULL,
  `destinasiID` char(4) NOT NULL,
  `fotoFile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fotodestinasi`
--

INSERT INTO `fotodestinasi` (`fotoID`, `fotoNama`, `destinasiID`, `fotoFile`) VALUES
('F001', 'Foto Fatahillah', 'WS01', 'Fatahillah.jpg'),
('F002', 'Tugu Monas', 'WS02', 'Monas.jpg'),
('F003', 'Gunung Bromo', 'WS03', 'Mt Bromo.jpg'),
('F004', 'Kawah Ijen', 'WS04', 'Kawah Ijen.jpg'),
('F005', 'Gili Ketapang', 'WS05', 'gili-ketapang.jpg'),
('F006', 'Hutan Damar', 'WS06', 'hutanDamar.jpg'),
('F007', 'Masjid Istiqlal', 'WS07', 'masjid_istiqlal_1200.jpg'),
('F008', 'Gereja Katedral', 'WS08', 'Katedral.jpg'),
('F009', 'Mangrove Angke Kapuk', 'WS09', 'hutan-mangrove.jpg'),
('F010', 'Green Canyon', 'WS10', 'Green-Canyon-Pangandaran-2.jpg'),
('F011', 'Candi Borobudur', 'WS11', 'Borobudur.jpg'),
('F012', 'Foto 12tes', 'WS12', 'DemoWisata.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotelID` char(4) NOT NULL,
  `hotelNama` char(35) NOT NULL,
  `hotelFoto` text NOT NULL,
  `provinsiID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotelID`, `hotelNama`, `hotelFoto`, `provinsiID`) VALUES
('H01', 'Pullman Jakarta', 'PullmanJakarta.jpg', 'P01'),
('H02', 'Grand Purnama', 'GrandPurnama.jpg', 'P02'),
('H03', 'Mesa Stila Resort', 'MesaStila.jpg', 'P03'),
('H04', 'Hotel Majapahit', 'HotelMajapahit.jpg', 'P04'),
('H05', 'HotelNo5', 'MesaStila.jpg', 'P05'),
('H06', 'TES', 'Monas.jpg', 'P05');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategoriID` char(4) NOT NULL,
  `kategoriNama` char(30) NOT NULL,
  `kategoriKeterangan` varchar(255) NOT NULL,
  `kategoriReferensi` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategoriID`, `kategoriNama`, `kategoriKeterangan`, `kategoriReferensi`) VALUES
('WK01', 'Alam', 'Wisata dengan pemandangan alam', 'internet'),
('WK02', 'Budaya', 'Wisata sejarah, peninggalan masa lalu', 'Buku'),
('WK03', 'Pantai', 'Wisata yang mengunjungi daerah pantai  ', 'Internet'),
('WK04', 'Religi', 'Wisata mengunjungi tempat khusus umat beragama, makam, tempat beribadah.', 'internet'),
('WK05', 'Tes10', 'Keterangan Kategori Tes10', 'Referensi Tes10');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `provinsiID` char(4) NOT NULL,
  `provinsiNama` char(35) NOT NULL,
  `provinsiTglBerdiri` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`provinsiID`, `provinsiNama`, `provinsiTglBerdiri`) VALUES
('P01', 'DKI Jakarta', '2021-10-28'),
('P02', 'Jawa Barat', '2021-10-27'),
('P03', 'Jawa Tengah', '2021-10-29'),
('P04', 'Jawa Timur', '2021-10-30'),
('P05', 'Sumatra Utara', '2021-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `reservasiID` char(4) NOT NULL,
  `reservasiPemesan` char(30) NOT NULL,
  `destinasiID` char(4) NOT NULL,
  `hotelID` char(4) NOT NULL,
  `agencyID` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`reservasiID`, `reservasiPemesan`, `destinasiID`, `hotelID`, `agencyID`) VALUES
('RV01', 'Nizham', 'WS01', 'H01', 'AG01'),
('RV02', 'Kamil', 'WS07', 'H01', 'AG01'),
('RV03', 'Hia', 'WS10', 'H02', 'AG02'),
('RV04', 'John', 'WS12', 'H05', 'AG03');

-- --------------------------------------------------------

--
-- Table structure for table `travelagency`
--

CREATE TABLE `travelagency` (
  `agencyID` char(4) NOT NULL,
  `agencyNama` char(20) NOT NULL,
  `agencyKeterangan` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `travelagency`
--

INSERT INTO `travelagency` (`agencyID`, `agencyNama`, `agencyKeterangan`) VALUES
('AG01', 'ZaunTravel', 'Travel spesialis alam'),
('AG02', 'PiltoverTravel', 'Travel Spesialis kota'),
('AG03', 'TESTRAVEL', 'LOREM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`areaID`);

--
-- Indexes for table `beritakategori`
--
ALTER TABLE `beritakategori`
  ADD PRIMARY KEY (`beritaID`);

--
-- Indexes for table `beritakonten`
--
ALTER TABLE `beritakonten`
  ADD PRIMARY KEY (`kontenID`);

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`destinasiID`);

--
-- Indexes for table `fotodestinasi`
--
ALTER TABLE `fotodestinasi`
  ADD PRIMARY KEY (`fotoID`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotelID`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`provinsiID`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`reservasiID`);

--
-- Indexes for table `travelagency`
--
ALTER TABLE `travelagency`
  ADD PRIMARY KEY (`agencyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
