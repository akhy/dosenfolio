-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2011 at 06:29 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kp_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `beasiswa`
--

CREATE TABLE IF NOT EXISTS `beasiswa` (
  `beasiswa_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  PRIMARY KEY (`beasiswa_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `beasiswa`
--

INSERT INTO `beasiswa` (`beasiswa_id`, `dosen_id`, `nama`, `instansi`, `tahun`) VALUES
(1, 6, 'Mahasiswa Berprestasi', 'Jurusan Teknik Informatika UII', 2010),
(2, 1, 'UII Scholarship Programme', 'Universitas Islam Indonesia', 2005);

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE IF NOT EXISTS `bimbingan` (
  `bimbingan_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `strata` varchar(20) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  PRIMARY KEY (`bimbingan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`bimbingan_id`, `dosen_id`, `strata`, `tahun`, `jumlah`, `prodi`) VALUES
(1, 1, 'S1', '2000/2001', 212, 'Teknik Informatika UII');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `buku_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  PRIMARY KEY (`buku_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`buku_id`, `dosen_id`, `judul`, `jenis`, `tahun`, `penerbit`) VALUES
(1, 1, 'Agile Web Development with Rails', 'Diktat', 1991, 'Lokomediaaa');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `dosen_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pass` varchar(50) NOT NULL DEFAULT '270007185d0f4b290ded51f9345a7f29',
  `nama` varchar(50) NOT NULL,
  `kelahiran` varchar(50) NOT NULL DEFAULT '-',
  `alamat` varchar(100) NOT NULL DEFAULT '-',
  `email` varchar(50) NOT NULL DEFAULT '-',
  `homepage` varchar(200) NOT NULL,
  `telpon` varchar(20) NOT NULL DEFAULT '-',
  `foto` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `gravatar` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dosen_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`dosen_id`, `username`, `pass`, `nama`, `kelahiran`, `alamat`, `email`, `homepage`, `telpon`, `foto`, `gravatar`) VALUES
(1, '08523108', '270007185d0f4b290ded51f9345a7f29', 'Akhyar Amarullah, S.Kom.', 'Banjarmasin, 3 Juni 1991', 'Jalan Kaliurang Km XXX  Sleman Jogjakarta', 'akhyrul@gmail.com, rulakhy@yahoo.com', 'http://akhyar.web.id, akhyar.posterous.com', '085729933261', '08523108.png', 0),
(5, '09523000', '270007185d0f4b290ded51f9345a7f29', 'Herdianti, S.Kom.', 'Jogjakarta, 19 Juli 1990', 'Jalan Magelang Km 7 No 5 Jogjakarta', 'leenherlin@yahoo.co.id', '', '-', 'default.jpg', 0),
(6, '09523001', '270007185d0f4b290ded51f9345a7f29', 'Barini Hedianti, S.Kom.', 'Bandung, 31 Oktober 1990', 'Jogjakarta', 'barini@gmail.com', '', '', 'default.jpg', 0),
(8, '08523001', '270007185d0f4b290ded51f9345a7f29', 'Irwan Yanwari, S.Kom.', 'Banjarbaru', '-', 'irwan.yanwari@gmail.com', '', '-', '08523001.png', 0),
(9, '08523004', '270007185d0f4b290ded51f9345a7f29', 'Andwi Prima Valentine, S.Kom.', 'Palembang', '-', 'andwi.valentine@yahoo.com', '', '-', 'default.jpg', 0),
(10, '08523005', '270007185d0f4b290ded51f9345a7f29', 'Arkham Zahri Rakhman, S.Kom.', 'Kotabumi', '-', '-', '', '-', 'default.jpg', 0),
(11, '08523006', '270007185d0f4b290ded51f9345a7f29', 'Mima Masitah Simbolon, S.Kom.', '-', '-', '-', '', '-', 'default.jpg', 0),
(12, '08523007', '270007185d0f4b290ded51f9345a7f29', 'Dina Afiani, S.Kom.', '-', '-', '-', '', '-', 'default.jpg', 0),
(16, 'affanmahtarami', '270007185d0f4b290ded51f9345a7f29', 'Affan Mahtarami, S.Kom., M.T.', '', '', 'mahtarami@hotmail.com, affan@uii.ac.id', '', '', 'affanmahtarami.jpg', 0),
(15, 'benisuranto', '270007185d0f4b290ded51f9345a7f29', 'Beni Suranto, S.T.', '24.09.1985', 'Segoroyoso I, RT 01, Segoroyoso, Pleret, Bantul, Yogyakarta', 'beni.suranto@fti.uii.ac.id', '', '-', 'benisuranto.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE IF NOT EXISTS `galeri` (
  `galeri_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`galeri_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `galeri`
--


-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE IF NOT EXISTS `jabatan` (
  `jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `thn_masuk` year(4) NOT NULL,
  `thn_keluar` year(4) NOT NULL,
  `institusi` varchar(100) NOT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `dosen_id`, `nama`, `thn_masuk`, `thn_keluar`, `institusi`) VALUES
(1, 1, 'Asisten Praktikum', 2008, 0000, 'Lab Informatika Terpadu'),
(2, 1, 'Asisten Juga', 2010, 2011, ''),
(3, 16, 'Kepala Laboratorium', 2006, 2007, 'Lab Grafika dan Multimedia, Jurusan Teknik Informatika, Universitas Islam Indonesia'),
(4, 16, 'Kepala Divisi Akademik', 2010, 0000, 'Magister Informatika, Universitas Islam Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `kegiatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `peran` varchar(50) NOT NULL,
  `penyelenggara` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  PRIMARY KEY (`kegiatan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`kegiatan_id`, `dosen_id`, `nama`, `peran`, `penyelenggara`, `tahun`, `tempat`) VALUES
(1, 1, 'Seminar Nasional Aplikasi Teknologi Informasi', 'Pembicara Utama', '', 2009, 'Jurusan Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `konfig`
--

CREATE TABLE IF NOT EXISTS `konfig` (
  `key` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfig`
--

INSERT INTO `konfig` (`key`, `value`) VALUES
('admin_username', 'mimin'),
('admin_password', '270007185d0f4b290ded51f9345a7f29');

-- --------------------------------------------------------

--
-- Table structure for table `makul`
--

CREATE TABLE IF NOT EXISTS `makul` (
  `makul_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `semester` mediumint(9) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  PRIMARY KEY (`makul_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `makul`
--

INSERT INTO `makul` (`makul_id`, `dosen_id`, `nama`, `semester`, `tahun`) VALUES
(4, 15, 'Programming and Algorithm', 0, ''),
(3, 1, 'Pemrograman Web', 2, '2007/2008'),
(5, 15, 'Human Computer Interaction', 0, ''),
(6, 15, 'Introduction to Information Technology', 0, ''),
(7, 15, 'Object Oriented Programming', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE IF NOT EXISTS `organisasi` (
  `organisasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `thn_masuk` year(4) NOT NULL,
  `thn_keluar` year(4) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  PRIMARY KEY (`organisasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`organisasi_id`, `dosen_id`, `nama`, `posisi`, `thn_masuk`, `thn_keluar`, `tempat`) VALUES
(1, 1, 'LPM Profesi', 'Staff Rancang Grafis dan Fotografi', 2008, 2008, 'Fakultas Teknologi Industri');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE IF NOT EXISTS `pendidikan` (
  `pendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `institusi` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `thn_masuk` year(4) NOT NULL,
  `thn_lulus` year(4) NOT NULL,
  `derajat` varchar(20) NOT NULL,
  PRIMARY KEY (`pendidikan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`pendidikan_id`, `dosen_id`, `institusi`, `prodi`, `jurusan`, `thn_masuk`, `thn_lulus`, `derajat`) VALUES
(1, 1, 'Universitas Islam Indonesia', 'Teknik Informatika', '', 2008, 2012, 'S1'),
(2, 1, 'Universitas Gadjah Mada', 'Manajemen Informasi', '', 2012, 2014, 'S2'),
(3, 1, 'Universitas Islam Indonesia', 'Bahasa Inggris', '', 2005, 2008, 'D3'),
(4, 4, 'STMIK Amikom', 'Sistem Informasi', '', 2001, 2005, 'S1'),
(5, 16, 'Universitas Gadjah Mada', 'Ilmu Komputer', '', 0000, 2004, 'S1'),
(6, 16, 'Institut Teknologi Sepuluh November', 'Teknik Elektro', '', 0000, 2010, 'S2'),
(7, 15, 'Universitas Gadjah Mada', 'Teknik Elektro', 'Informatika & Ilmu Komputer', 2003, 2008, 'S1');

-- --------------------------------------------------------

--
-- Table structure for table `penelitian`
--

CREATE TABLE IF NOT EXISTS `penelitian` (
  `penelitian_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `wkt_start` varchar(20) NOT NULL,
  `wkt_end` varchar(20) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `dana` varchar(30) NOT NULL,
  PRIMARY KEY (`penelitian_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`penelitian_id`, `dosen_id`, `judul`, `wkt_start`, `wkt_end`, `posisi`, `sumber`, `dana`) VALUES
(1, 16, 'Portofolio Dosen (contoh)', 'September 2010', 'Desember 2010', 'Dosen Pembimbing', 'Jurusan', '');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE IF NOT EXISTS `penghargaan` (
  `penghargaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `institusi` varchar(50) NOT NULL,
  `tahun` year(4) NOT NULL,
  PRIMARY KEY (`penghargaan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`penghargaan_id`, `dosen_id`, `nama`, `institusi`, `tahun`) VALUES
(1, 0, '0', '0', 0000),
(2, 4, 'Dosen terbaik', 'UII', 2009),
(3, 1, 'Mahasiswa Terganteng', 'Majalah Hai', 2010);

-- --------------------------------------------------------

--
-- Table structure for table `publikasi`
--

CREATE TABLE IF NOT EXISTS `publikasi` (
  `publikasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `media` varchar(100) NOT NULL,
  PRIMARY KEY (`publikasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `publikasi`
--

INSERT INTO `publikasi` (`publikasi_id`, `dosen_id`, `jenis`, `judul`, `tahun`, `posisi`, `media`) VALUES
(1, 16, 2, 'Studi Perbandingan Warna Marker pada Tracking Gerak Tangan Berbasis Video', 2009, '', 'Jurnal Teknologi Vol. 2 No. 2 Desember 2009, ISSN 1979-3405'),
(3, 16, 1, '(contoh) Penelitian di Jurnal Internasional', 2009, '', 'The Informatics Journal (contoh)');

-- --------------------------------------------------------

--
-- Table structure for table `seminar`
--

CREATE TABLE IF NOT EXISTS `seminar` (
  `seminar_id` int(11) NOT NULL AUTO_INCREMENT,
  `dosen_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `jenis` int(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `seminar` varchar(100) NOT NULL,
  PRIMARY KEY (`seminar_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `seminar`
--

INSERT INTO `seminar` (`seminar_id`, `dosen_id`, `judul`, `jenis`, `tahun`, `seminar`) VALUES
(1, 16, 'Pengembangan Tempat Rekreasi Menggunakan Simulasi', 2, 2006, 'Seminar Nasional Aplikasi Teknologi Informasi'),
(2, 16, 'Desain Konten E-Learning Untuk Mata Kuliah Grafika Komputer', 2, 2007, 'Seminar Nasional Ilmu Komputer Teknologi Informasi'),
(3, 16, 'Desain Teknik Interaksi Berbasis Kamera untuk Video Game', 2, 2009, 'Seminar Nasional Teknologi Informasi dan Aplikasinya'),
(6, 16, 'Tracking Ujung Jari Tangan pada Sekuen Video Untuk Pengenalan Gestur', 2, 2010, 'Konferensi Nasional Sistem Informasi'),
(7, 16, '(contoh) Karya Ilmiah Bikin Sesuatu', 0, 2008, 'Seminar Balap Kerupuk');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
