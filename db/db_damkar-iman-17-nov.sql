-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 05:55 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_damkar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bencana_kejadian`
--

CREATE TABLE IF NOT EXISTS `bencana_kejadian` (
`id` int(11) NOT NULL,
  `noKejadian` varchar(50) NOT NULL,
  `kodePropinsi` int(11) NOT NULL,
  `namaPropinsi` varchar(50) NOT NULL,
  `kodeKabupaten` varchar(11) NOT NULL,
  `namaKabupaten` varchar(50) NOT NULL,
  `kejadian` varchar(50) NOT NULL,
  `waktuKejadian` date NOT NULL,
  `meninggal` int(11) NOT NULL,
  `hilang` int(11) NOT NULL,
  `terluka` int(11) NOT NULL,
  `mengungsi` int(11) NOT NULL,
  `penyebab` varchar(50) NOT NULL,
  `objek` varchar(50) NOT NULL,
  `nilaiKerugian` int(11) NOT NULL,
  `jumlahPengungsian` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusQuery` varchar(20) NOT NULL,
  `n_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `bencana_kejadian`
--

INSERT INTO `bencana_kejadian` (`id`, `noKejadian`, `kodePropinsi`, `namaPropinsi`, `kodeKabupaten`, `namaKabupaten`, `kejadian`, `waktuKejadian`, `meninggal`, `hilang`, `terluka`, `mengungsi`, `penyebab`, `objek`, `nilaiKerugian`, `jumlahPengungsian`, `create_date`, `statusQuery`, `n_status`) VALUES
(37, '2', 19, 'BANGKA BELITUNG', '1901', 'BANGKA', 'PUTING BELIUNG', '0000-00-00', 12, 3, 5, 80, 'RUMAH', '', 245600000, 8, '2015-11-16 13:50:34', 'insert', 1),
(38, '3', 35, 'JAWA TIMUR', '3512', 'SITUBONDO', 'PUTING BELIUNG', '0000-00-00', 0, 0, 0, 250, 'KIOS', '', 1000000000, 0, '2015-11-16 13:50:35', 'insert', 1),
(39, '4', 11, 'PEMERINTAH ACEH', '1175', 'KOTA SUBULUSSALAM', 'BANJIR', '0000-00-00', 6, 6, 6, 567, 'KOS-KOSAN', '', 705032704, 1, '2015-11-16 13:50:35', 'insert', 1),
(40, '5', 32, 'JAWA BARAT', '3202', 'SUKABUMI', 'TANAH LONGSOR', '0000-00-00', 34, 50, 5, 800, 'RUMAH SAKIT', '', 267922704, 100, '2015-11-16 13:50:35', 'insert', 1),
(41, '011', 31, '', '01', '', 'bencana alam', '1970-01-01', 0, 0, 0, 0, '', '', 0, 0, '2015-11-16 15:56:44', '', 1),
(42, '20107885000', 32, '', '02', '', 'kebakaran edit', '1970-01-30', 101, 301, 201, 401, 'apiiii', 'apiiii', 2147483647, 303, '2015-11-16 16:10:39', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bencana_korban`
--

CREATE TABLE IF NOT EXISTS `bencana_korban` (
`id` int(11) NOT NULL,
  `propinsi` int(11) NOT NULL,
  `kabupaten` int(11) NOT NULL,
  `jenisbencana` varchar(50) NOT NULL,
  `tglawal` date NOT NULL,
  `tglakhir` date NOT NULL,
  `meninggal` int(11) NOT NULL,
  `hilang` int(11) NOT NULL,
  `terluka` int(11) NOT NULL,
  `rumah` int(11) NOT NULL,
  `fsltspendidikan` int(11) NOT NULL,
  `fsltskesehatan` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `n_status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `bencana_korban`
--

INSERT INTO `bencana_korban` (`id`, `propinsi`, `kabupaten`, `jenisbencana`, `tglawal`, `tglakhir`, `meninggal`, `hilang`, `terluka`, `rumah`, `fsltspendidikan`, `fsltskesehatan`, `create_date`, `n_status`) VALUES
(40, 32, 13, 'bencana alam', '1970-01-31', '1970-01-31', 10, 20, 30, 40, 50, 60, '2015-11-16 09:33:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bencana_log_kejadian`
--

CREATE TABLE IF NOT EXISTS `bencana_log_kejadian` (
`id` int(11) NOT NULL,
  `noKejadian` varchar(50) NOT NULL,
  `kodePropinsi` int(11) NOT NULL,
  `namaPropinsi` varchar(50) NOT NULL,
  `kodeKabupaten` int(11) NOT NULL,
  `namaKabupaten` varchar(50) NOT NULL,
  `kejadian` varchar(50) NOT NULL,
  `waktuKejadian` date NOT NULL,
  `meninggal` int(11) NOT NULL,
  `hilang` int(11) NOT NULL,
  `terluka` int(11) NOT NULL,
  `mengungsi` int(11) NOT NULL,
  `penyebab` varchar(50) NOT NULL,
  `objek` varchar(50) NOT NULL,
  `nilaiKerugian` int(11) NOT NULL,
  `jumlahPengungsian` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statusQuery` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `bencana_log_kejadian`
--

INSERT INTO `bencana_log_kejadian` (`id`, `noKejadian`, `kodePropinsi`, `namaPropinsi`, `kodeKabupaten`, `namaKabupaten`, `kejadian`, `waktuKejadian`, `meninggal`, `hilang`, `terluka`, `mengungsi`, `penyebab`, `objek`, `nilaiKerugian`, `jumlahPengungsian`, `create_date`, `statusQuery`, `status`) VALUES
(56, '1', 33, 'JAWA TENGAH', 3318, 'PATI', 'PUTING BELIUNG', '0000-00-00', 5, 4, 3, 2, 'KANTOR', '', 250000000, 1, '2015-11-16 13:50:34', 'insert', 'import'),
(57, '2', 19, 'BANGKA BELITUNG', 1901, 'BANGKA', 'PUTING BELIUNG', '0000-00-00', 12, 3, 5, 80, 'RUMAH', '', 245600000, 8, '2015-11-16 13:50:35', 'insert', 'import'),
(58, '3', 35, 'JAWA TIMUR', 3512, 'SITUBONDO', 'PUTING BELIUNG', '0000-00-00', 0, 0, 0, 250, 'KIOS', '', 1000000000, 0, '2015-11-16 13:50:35', 'insert', 'import'),
(59, '4', 11, 'PEMERINTAH ACEH', 1175, 'KOTA SUBULUSSALAM', 'BANJIR', '0000-00-00', 6, 6, 6, 567, 'KOS-KOSAN', '', 705032704, 1, '2015-11-16 13:50:35', 'insert', 'import'),
(60, '5', 32, 'JAWA BARAT', 3202, 'SUKABUMI', 'TANAH LONGSOR', '0000-00-00', 34, 50, 5, 800, 'RUMAH SAKIT', '', 267922704, 100, '2015-11-16 13:50:35', 'insert', 'import');

-- --------------------------------------------------------

--
-- Table structure for table `bencana_personel`
--

CREATE TABLE IF NOT EXISTS `bencana_personel` (
`id` int(11) NOT NULL,
  `nip` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenisKelamin` varchar(20) NOT NULL,
  `glrDepan` varchar(25) NOT NULL,
  `glrBelakang` varchar(25) NOT NULL,
  `tempatLahir` varchar(30) NOT NULL,
  `tglLahir` date NOT NULL,
  `agama` varchar(20) NOT NULL,
  `statusKawin` varchar(20) NOT NULL,
  `golDarah` varchar(15) NOT NULL,
  `reshus` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `propinsi` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `sektor` varchar(50) NOT NULL,
  `tmtPegawai` varchar(50) NOT NULL,
  `statusKerja` varchar(30) NOT NULL,
  `pangkat` varchar(30) NOT NULL,
  `skPangkat` varchar(30) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `pelatihan` text NOT NULL,
  `keterangan` text NOT NULL,
  `filename` varchar(50) DEFAULT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bencana_sektor`
--

CREATE TABLE IF NOT EXISTS `bencana_sektor` (
`id` int(11) NOT NULL,
  `namaSektor` varchar(50) NOT NULL,
  `skpd` varchar(50) NOT NULL,
  `propinsi` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `bencana_sektor`
--

INSERT INTO `bencana_sektor` (`id`, `namaSektor`, `skpd`, `propinsi`, `kabupaten`, `filename`, `create_date`, `status`) VALUES
(24, 'sektor 1', 'dinas pendidikan', '31', '01', 'ibu.jpg.jpg', '2015-11-16 09:29:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bencana_wilayah`
--

CREATE TABLE IF NOT EXISTS `bencana_wilayah` (
`id` int(11) NOT NULL,
  `propinsi` varchar(30) NOT NULL,
  `kabupaten` varchar(30) NOT NULL,
  `luasWilayah` int(11) NOT NULL,
  `jumlahKecamatan` int(11) NOT NULL,
  `jumlahPenduduk` int(11) NOT NULL,
  `cakupan` int(11) NOT NULL,
  `responTime` int(11) NOT NULL,
  `rasioPersonel` int(11) NOT NULL,
  `rasioSarPras` int(11) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `bencana_wilayah`
--

INSERT INTO `bencana_wilayah` (`id`, `propinsi`, `kabupaten`, `luasWilayah`, `jumlahKecamatan`, `jumlahPenduduk`, `cakupan`, `responTime`, `rasioPersonel`, `rasioSarPras`, `createDate`, `status`) VALUES
(52, '32', '02', 10, 100, 10000, 10, 10, 10, 10, '2015-11-16 09:23:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bencana_kejadian`
--
ALTER TABLE `bencana_kejadian`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `noKejadian` (`noKejadian`);

--
-- Indexes for table `bencana_korban`
--
ALTER TABLE `bencana_korban`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bencana_log_kejadian`
--
ALTER TABLE `bencana_log_kejadian`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bencana_personel`
--
ALTER TABLE `bencana_personel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bencana_sektor`
--
ALTER TABLE `bencana_sektor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bencana_wilayah`
--
ALTER TABLE `bencana_wilayah`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bencana_kejadian`
--
ALTER TABLE `bencana_kejadian`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `bencana_korban`
--
ALTER TABLE `bencana_korban`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `bencana_log_kejadian`
--
ALTER TABLE `bencana_log_kejadian`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `bencana_personel`
--
ALTER TABLE `bencana_personel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bencana_sektor`
--
ALTER TABLE `bencana_sektor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `bencana_wilayah`
--
ALTER TABLE `bencana_wilayah`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
