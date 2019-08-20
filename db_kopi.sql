-- Adminer 4.7.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP VIEW IF EXISTS `data_detail_pesan`;
CREATE TABLE `data_detail_pesan` (`id` int(11), `id_pesan` int(11), `id_kopi` int(11), `jumlah` int(11), `nama` varchar(50), `gambar` varchar(255), `stok` int(11), `harga` int(11), `satuan` varchar(50), `deskripsi` varchar(255), `nama_kategori` varchar(50), `tgl_pesan` datetime, `nama_ekspedisi` varchar(50), `total_ongkir` int(11), `status` varchar(50), `noresi` varchar(50));


DROP VIEW IF EXISTS `data_keranjang`;
CREATE TABLE `data_keranjang` (`nama` varchar(50), `gambar` varchar(255), `stok` int(11), `harga` int(11), `satuan` varchar(50), `deskripsi` varchar(255), `id_kopi` int(11), `id_user` int(11), `jumlah` int(11), `id` int(11), `nama_kategori` varchar(50));


DROP VIEW IF EXISTS `data_kopi`;
CREATE TABLE `data_kopi` (`id_kategori` int(11), `nama` varchar(50), `gambar` varchar(255), `stok` int(11), `harga` int(11), `satuan` varchar(50), `deskripsi` varchar(255), `nama_kategori` varchar(50), `id` int(11));


DROP VIEW IF EXISTS `data_pemesanan`;
CREATE TABLE `data_pemesanan` (`id` int(11), `id_user` int(11), `tgl_pesan` datetime, `nama_ekspedisi` varchar(50), `total_ongkir` int(11), `status` varchar(50), `noresi` varchar(50), `nama` varchar(50), `email` varchar(100), `telepon` varchar(20), `username` varchar(20));


DROP TABLE IF EXISTS `detail_pesan`;
CREATE TABLE `detail_pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` int(11) NOT NULL,
  `id_kopi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_pesan` (`id`, `id_pesan`, `id_kopi`, `jumlah`) VALUES
(1,	1,	2,	1);

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1,	'Ut ea unde elit dol'),
(2,	'Voluptatem amet del'),
(3,	'Elit fugiat illum');

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kopi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kopi`;
CREATE TABLE `kopi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kopi` (`id`, `id_kategori`, `nama`, `gambar`, `stok`, `harga`, `satuan`, `deskripsi`) VALUES
(2,	3,	'Qui qui cumque sunt ',	'200819091046111800.png',	2,	3,	'Voluptatibus dolorib',	'Rerum omnis perspici');

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `norek` int(11) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `status_bayar` varchar(50) NOT NULL,
  `bank_tujuan` varchar(20) NOT NULL,
  `norek_tujuan` int(11) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `nama_ekspedisi` varchar(50) NOT NULL,
  `total_ongkir` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Belum bayar',
  `noresi` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pemesanan` (`id`, `id_user`, `tgl_pesan`, `nama_ekspedisi`, `total_ongkir`, `status`, `noresi`) VALUES
(1,	3,	'2019-08-20 00:00:00',	'',	0,	'Belum bayar',	'');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses_level` enum('Admin','Member') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `nama`, `email`, `telepon`, `username`, `password`, `akses_level`) VALUES
(2,	'lisa',	'lisa@gmail.com',	'',	'lisa riyanti',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'Admin'),
(3,	'Sed nesciunt maxime',	'pejima@mailinator.net',	'Consequat Culpa ex',	'mandan',	'12345',	'Member');

DROP TABLE IF EXISTS `data_detail_pesan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_detail_pesan` AS select `detail_pesan`.`id` AS `id`,`detail_pesan`.`id_pesan` AS `id_pesan`,`detail_pesan`.`id_kopi` AS `id_kopi`,`detail_pesan`.`jumlah` AS `jumlah`,`kopi`.`nama` AS `nama`,`kopi`.`gambar` AS `gambar`,`kopi`.`stok` AS `stok`,`kopi`.`harga` AS `harga`,`kopi`.`satuan` AS `satuan`,`kopi`.`deskripsi` AS `deskripsi`,`kategori`.`nama_kategori` AS `nama_kategori`,`pemesanan`.`tgl_pesan` AS `tgl_pesan`,`pemesanan`.`nama_ekspedisi` AS `nama_ekspedisi`,`pemesanan`.`total_ongkir` AS `total_ongkir`,`pemesanan`.`status` AS `status`,`pemesanan`.`noresi` AS `noresi` from (((`detail_pesan` join `kopi` on((`kopi`.`id` = `detail_pesan`.`id_kopi`))) join `kategori` on((`kategori`.`id` = `kopi`.`id_kategori`))) join `pemesanan` on((`detail_pesan`.`id_pesan` = `pemesanan`.`id`)));

DROP TABLE IF EXISTS `data_keranjang`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_keranjang` AS select `kopi`.`nama` AS `nama`,`kopi`.`gambar` AS `gambar`,`kopi`.`stok` AS `stok`,`kopi`.`harga` AS `harga`,`kopi`.`satuan` AS `satuan`,`kopi`.`deskripsi` AS `deskripsi`,`keranjang`.`id_kopi` AS `id_kopi`,`keranjang`.`id_user` AS `id_user`,`keranjang`.`jumlah` AS `jumlah`,`keranjang`.`id` AS `id`,`kategori`.`nama_kategori` AS `nama_kategori` from ((`keranjang` join `kopi` on((`kopi`.`id` = `keranjang`.`id_kopi`))) join `kategori` on((`kategori`.`id` = `kopi`.`id_kategori`)));

DROP TABLE IF EXISTS `data_kopi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_kopi` AS select `kopi`.`id_kategori` AS `id_kategori`,`kopi`.`nama` AS `nama`,`kopi`.`gambar` AS `gambar`,`kopi`.`stok` AS `stok`,`kopi`.`harga` AS `harga`,`kopi`.`satuan` AS `satuan`,`kopi`.`deskripsi` AS `deskripsi`,`kategori`.`nama_kategori` AS `nama_kategori`,`kopi`.`id` AS `id` from (`kopi` join `kategori` on((`kategori`.`id` = `kopi`.`id_kategori`)));

DROP TABLE IF EXISTS `data_pemesanan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_pemesanan` AS select `pemesanan`.`id` AS `id`,`pemesanan`.`id_user` AS `id_user`,`pemesanan`.`tgl_pesan` AS `tgl_pesan`,`pemesanan`.`nama_ekspedisi` AS `nama_ekspedisi`,`pemesanan`.`total_ongkir` AS `total_ongkir`,`pemesanan`.`status` AS `status`,`pemesanan`.`noresi` AS `noresi`,`users`.`nama` AS `nama`,`users`.`email` AS `email`,`users`.`telepon` AS `telepon`,`users`.`username` AS `username` from (`pemesanan` join `users` on((`pemesanan`.`id_user` = `users`.`id`)));

-- 2019-08-20 18:19:42
