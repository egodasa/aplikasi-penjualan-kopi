-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP VIEW IF EXISTS `data_detail_pesan`;
CREATE TABLE `data_detail_pesan` (`id` int(11), `id_pesan` int(11), `id_kopi` int(11), `jumlah` int(11), `nama` varchar(50), `gambar` varchar(255), `stok` int(11), `harga` int(11), `diskon` int(11), `satuan` varchar(50), `berat` float, `deskripsi` varchar(255), `nama_kategori` varchar(50), `tgl_pesan` datetime, `nama_ekspedisi` varchar(50), `total_ongkir` int(11), `status` enum('Belum bayar','Sedang diverifikasi','Pembayaran diterima','Pembayaran ditolak','Sudah dikirim'), `noresi` varchar(50), `sub_total` bigint(22));


DROP VIEW IF EXISTS `data_keranjang`;
CREATE TABLE `data_keranjang` (`nama` varchar(50), `gambar` varchar(255), `berat` float, `stok` int(11), `harga` int(11), `diskon` int(11), `satuan` varchar(50), `deskripsi` varchar(255), `id_kopi` int(11), `id_user` int(11), `jumlah` int(11), `id` int(11), `nama_kategori` varchar(50), `sub_total` bigint(22));


DROP VIEW IF EXISTS `data_kopi`;
CREATE TABLE `data_kopi` (`id_kategori` int(11), `diskon_persen` float, `berat` float, `nama` varchar(50), `gambar` varchar(255), `stok` int(11), `diskon` double, `harga` int(11), `satuan` varchar(50), `deskripsi` varchar(255), `nama_kategori` varchar(50), `id` int(11));


DROP VIEW IF EXISTS `data_pemesanan`;
CREATE TABLE `data_pemesanan` (`id` int(11), `id_pembayaran` int(11), `id_user` int(11), `tgl_pesan` date, `nama_ekspedisi` varchar(50), `total_ongkir` int(11), `alamat` text, `status` enum('Belum bayar','Sedang diverifikasi','Pembayaran diterima','Pembayaran ditolak','Sudah dikirim'), `noresi` varchar(50), `nama` varchar(50), `email` varchar(100), `telepon` varchar(20), `username` varchar(20), `jumlah_bayar` bigint(11), `nama_bank` varchar(50), `norek` varchar(30), `tgl_bayar` varchar(10), `status_bayar` varchar(15), `bank_tujuan` varchar(20), `norek_tujuan` varchar(30), `bukti_bayar` varchar(255), `total_bayar` decimal(54,0));


DROP VIEW IF EXISTS `data_penerimaan_stok`;
CREATE TABLE `data_penerimaan_stok` (`id` int(11), `id_kopi` int(11), `id_user` int(11), `tgl_terima` date, `jumlah` float, `no_faktur` varchar(50), `keterangan` text, `nama` varchar(50), `nama_user` varchar(50));


DROP TABLE IF EXISTS `detail_pesan`;
CREATE TABLE `detail_pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` int(11) NOT NULL,
  `id_kopi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `detail_pesan` (`id`, `id_pesan`, `id_kopi`, `jumlah`, `diskon`) VALUES
(1,	1,	2,	1,	0),
(2,	2,	2,	2,	0),
(3,	2,	2,	2,	0),
(4,	3,	2,	1,	0),
(5,	4,	2,	10,	0),
(6,	5,	2,	1,	0),
(7,	6,	3,	1,	0),
(8,	7,	3,	2,	0),
(9,	8,	5,	1,	0),
(10,	9,	2,	2,	0),
(11,	9,	3,	23,	0),
(12,	10,	3,	0,	0),
(13,	10,	3,	1,	0),
(14,	11,	3,	1,	0),
(15,	11,	3,	1,	0),
(17,	12,	4,	2,	0),
(18,	13,	3,	2,	0),
(19,	14,	3,	2,	3625),
(20,	15,	3,	5,	3625),
(21,	16,	3,	1,	3625),
(22,	16,	3,	6,	3625);

DELIMITER ;;

CREATE TRIGGER `kurang_stok` AFTER INSERT ON `detail_pesan` FOR EACH ROW
UPDATE kopi SET stok = stok - NEW.jumlah WHERE id = NEW.id_kopi;;

DELIMITER ;

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(1,	'Pulp natural'),
(2,	'Semi Wash'),
(4,	'Natural Proses');

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kopi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `keranjang` (`id`, `id_kopi`, `id_user`, `jumlah`, `diskon`) VALUES
(4,	3,	2,	1,	0),
(5,	4,	2,	1,	0),
(8,	5,	5,	0,	0);

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
  `berat` float NOT NULL,
  `diskon` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `kopi` (`id`, `id_kategori`, `nama`, `gambar`, `stok`, `harga`, `satuan`, `deskripsi`, `berat`, `diskon`) VALUES
(2,	3,	'Qui qui cumque sunt ',	'200819091046111800.png',	0,	3,	'Voluptatibus dolorib',	'Rerum omnis perspici',	300,	0),
(3,	1,	'Labah Rimbo',	'240819072647432600.jpg',	283,	145000,	'kg',	'Berasal dari Solok Desa Aie Dingin dan Aka Gadang, Solok. merupakan\r\nVarietas  Kartika, Andung sari, Ateng dan Sigararutang \r\n',	100,	2.5),
(4,	2,	'Limau Cirago',	'240819075333611300.jpg',	604,	150000,	'kg',	'Berasal dari Desa: Bukit Barisan merupakan Varietas  Kartika, Andung sari, dan Sigararutang\r\n\r\n',	100,	0),
(5,	4,	'Solok Radjo Natural',	'240819075625439600.jpg',	400,	150000,	'kg',	'Berasal  dari Solok Desa Aie Dingin dengan Varietas Kartika, Andung sari, dan Sigararutang\r\n',	100,	0);

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `norek` varchar(30) NOT NULL,
  `tgl_bayar` datetime NOT NULL,
  `status_bayar` enum('Belum Diperiksa','Diterima','Ditolak') NOT NULL DEFAULT 'Belum Diperiksa',
  `bank_tujuan` varchar(20) NOT NULL,
  `norek_tujuan` varchar(30) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pembayaran` (`id`, `id_pesan`, `jumlah_bayar`, `nama_bank`, `norek`, `tgl_bayar`, `status_bayar`, `bank_tujuan`, `norek_tujuan`, `bukti_bayar`) VALUES
(1,	1,	13,	'Nihil laudantium ip',	'Ea beatae consequat',	'1987-11-19 00:00:00',	'Diterima',	'Sit ea elit non pa',	'Ut sit sed laboris a',	'210819061101759300.jpg'),
(2,	2,	54,	'In libero architecto',	'Sit quis libero quod',	'2017-10-28 00:00:00',	'Diterima',	'Accusantium sit mole',	'Itaque voluptate ven',	'220819073500860600.jpg'),
(3,	2,	54,	'In libero architecto',	'Sit quis libero quod',	'2017-10-28 00:00:00',	'Belum Diperiksa',	'Accusantium sit mole',	'Itaque voluptate ven',	'220819073606802500.jpg'),
(4,	2,	45,	'Tempore est volupt',	'Dolor et nobis conse',	'2013-04-14 00:00:00',	'Diterima',	'Voluptate nulla aliq',	'Aut vitae ut aut rat',	'220819082308707500.jpg'),
(5,	4,	33030,	'bni',	'11111',	'0000-00-00 00:00:00',	'Belum Diperiksa',	'bni',	'2222',	'240819021828731300.jpg'),
(6,	5,	222,	'bni',	'1233',	'2019-08-26 00:00:00',	'Belum Diperiksa',	'bni',	'123344',	'260819024806937500.jpg'),
(7,	8,	161000,	'bni',	'1223455',	'0000-00-00 00:00:00',	'Belum Diperiksa',	'bni',	'122786892',	'260819030751354400.jpg'),
(8,	11,	356000,	'Bni',	'1236594',	'2019-09-25 00:00:00',	'Belum Diperiksa',	'Bni',	'5164994',	'250919020903049300.pdf'),
(9,	16,	0,	'',	'',	'0000-00-00 00:00:00',	'Belum Diperiksa',	'',	'',	'260919142941803600.jpg');

DROP TABLE IF EXISTS `pemesanan`;
CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `nama_ekspedisi` varchar(50) NOT NULL,
  `total_ongkir` int(11) NOT NULL,
  `status` enum('Belum bayar','Sedang diverifikasi','Pembayaran diterima','Pembayaran ditolak','Sudah dikirim') NOT NULL DEFAULT 'Belum bayar',
  `noresi` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pemesanan` (`id`, `id_user`, `tgl_pesan`, `nama_ekspedisi`, `total_ongkir`, `status`, `noresi`, `alamat`) VALUES
(1,	3,	'2019-08-20 00:00:00',	'',	0,	'Sudah dikirim',	'hkjkl',	''),
(2,	3,	'2019-08-22 00:00:00',	'',	0,	'Sudah dikirim',	'12dq2dww',	''),
(8,	4,	'2019-08-26 00:00:00',	'JNE REG',	11000,	'Sudah dikirim',	'hkjkl',	''),
(9,	3,	'2019-08-27 00:00:00',	'JNE OKE',	80000,	'Belum bayar',	'',	''),
(10,	4,	'2019-09-02 00:00:00',	'JNE REG',	11000,	'Belum bayar',	'',	''),
(11,	4,	'2019-09-25 00:00:00',	'JNE OKE',	33000,	'Pembayaran ditolak',	'',	''),
(12,	4,	'2019-09-25 00:00:00',	'JNE OKE',	57000,	'Belum bayar',	'',	''),
(13,	4,	'2019-09-25 00:00:00',	'JNE OKE',	40000,	'Belum bayar',	'',	'sdffddsfdsffdssdfd'),
(16,	4,	'2019-09-26 00:00:00',	'JNE YES',	10000,	'Sedang diverifikasi',	'',	'solok');

DROP TABLE IF EXISTS `penerimaan_stok`;
CREATE TABLE `penerimaan_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kopi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_terima` date NOT NULL,
  `jumlah` float NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `penerimaan_stok` (`id`, `id_kopi`, `id_user`, `tgl_terima`, `jumlah`, `no_faktur`, `keterangan`) VALUES
(4,	3,	10,	'2019-09-25',	100,	'F0121',	'Pembelian'),
(6,	4,	10,	'2019-09-26',	5,	'F0121',	'stok gudang'),
(7,	4,	10,	'2019-09-26',	1,	'FO21',	'STOK GUDANG');

DELIMITER ;;

CREATE TRIGGER `tambahStokPenerimaan` AFTER INSERT ON `penerimaan_stok` FOR EACH ROW
UPDATE kopi SET stok = stok + NEW.jumlah WHERE id = NEW.id_kopi;;

CREATE TRIGGER `kurangStokPenerimaan` BEFORE DELETE ON `penerimaan_stok` FOR EACH ROW
UPDATE kopi SET stok = stok - OLD.jumlah WHERE id = OLD.id_kopi;;

DELIMITER ;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `akses_level` enum('Admin','Member','Ketua Koperasi','Petugas Gudang') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `nama`, `email`, `telepon`, `username`, `password`, `akses_level`) VALUES
(3,	'Sed nesciunt maxime',	'egodasa@hotmail.com',	'Consequat Culpa ex',	'mandan',	'1234567890',	'Member'),
(4,	'lisa riyanti',	'lisariyanti009@gmail.com',	'083182397271',	'lisariyanti',	'123456',	'Member'),
(5,	'admin',	'admin',	'08123456788',	'admin',	'admin',	'Admin'),
(6,	'Harum unde consequat',	'cocep@mailinator.net',	'Molestias voluptas v',	'tiwep',	'12345',	'Member'),
(7,	'Dolorem ab quam labo',	'pylewy@mailinator.com',	'Cupiditate adipisci ',	'pakido',	'12345',	'Member'),
(8,	'Et aliquid nostrud e',	'cugujemer@mailinator.com',	'Proident facere eiu',	'ketua',	'12345',	'Ketua Koperasi'),
(9,	'Teuku',	'teuku@gmail.com',	'083182397272',	'Ketua',	'ketua',	'Ketua Koperasi'),
(10,	'Adi',	'adi@gmail.com',	'0821566497',	'Gudang',	'gudang',	'Petugas Gudang');

DROP TABLE IF EXISTS `data_detail_pesan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_detail_pesan` AS select `detail_pesan`.`id` AS `id`,`detail_pesan`.`id_pesan` AS `id_pesan`,`detail_pesan`.`id_kopi` AS `id_kopi`,`detail_pesan`.`jumlah` AS `jumlah`,`kopi`.`nama` AS `nama`,`kopi`.`gambar` AS `gambar`,`kopi`.`stok` AS `stok`,`kopi`.`harga` AS `harga`,`detail_pesan`.`diskon` AS `diskon`,`kopi`.`satuan` AS `satuan`,`kopi`.`berat` AS `berat`,`kopi`.`deskripsi` AS `deskripsi`,`kategori`.`nama_kategori` AS `nama_kategori`,`pemesanan`.`tgl_pesan` AS `tgl_pesan`,`pemesanan`.`nama_ekspedisi` AS `nama_ekspedisi`,`pemesanan`.`total_ongkir` AS `total_ongkir`,`pemesanan`.`status` AS `status`,`pemesanan`.`noresi` AS `noresi`,(`detail_pesan`.`jumlah` * (`kopi`.`harga` - `detail_pesan`.`diskon`)) AS `sub_total` from (((`detail_pesan` join `kopi` on((`kopi`.`id` = `detail_pesan`.`id_kopi`))) join `kategori` on((`kategori`.`id` = `kopi`.`id_kategori`))) join `pemesanan` on((`detail_pesan`.`id_pesan` = `pemesanan`.`id`)));

DROP TABLE IF EXISTS `data_keranjang`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_keranjang` AS select `kopi`.`nama` AS `nama`,`kopi`.`gambar` AS `gambar`,`kopi`.`berat` AS `berat`,`kopi`.`stok` AS `stok`,`kopi`.`harga` AS `harga`,`keranjang`.`diskon` AS `diskon`,`kopi`.`satuan` AS `satuan`,`kopi`.`deskripsi` AS `deskripsi`,`keranjang`.`id_kopi` AS `id_kopi`,`keranjang`.`id_user` AS `id_user`,`keranjang`.`jumlah` AS `jumlah`,`keranjang`.`id` AS `id`,`kategori`.`nama_kategori` AS `nama_kategori`,(`keranjang`.`jumlah` * (`kopi`.`harga` - `keranjang`.`diskon`)) AS `sub_total` from ((`keranjang` join `kopi` on((`kopi`.`id` = `keranjang`.`id_kopi`))) join `kategori` on((`kategori`.`id` = `kopi`.`id_kategori`)));

DROP TABLE IF EXISTS `data_kopi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_kopi` AS select `kopi`.`id_kategori` AS `id_kategori`,`kopi`.`diskon` AS `diskon_persen`,`kopi`.`berat` AS `berat`,`kopi`.`nama` AS `nama`,`kopi`.`gambar` AS `gambar`,`kopi`.`stok` AS `stok`,((`kopi`.`diskon` / 100) * `kopi`.`harga`) AS `diskon`,`kopi`.`harga` AS `harga`,`kopi`.`satuan` AS `satuan`,`kopi`.`deskripsi` AS `deskripsi`,`kategori`.`nama_kategori` AS `nama_kategori`,`kopi`.`id` AS `id` from (`kopi` join `kategori` on((`kategori`.`id` = `kopi`.`id_kategori`)));

DROP TABLE IF EXISTS `data_pemesanan`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_pemesanan` AS select `pemesanan`.`id` AS `id`,`pembayaran`.`id` AS `id_pembayaran`,`pemesanan`.`id_user` AS `id_user`,cast(`pemesanan`.`tgl_pesan` as date) AS `tgl_pesan`,`pemesanan`.`nama_ekspedisi` AS `nama_ekspedisi`,`pemesanan`.`total_ongkir` AS `total_ongkir`,`pemesanan`.`alamat` AS `alamat`,`pemesanan`.`status` AS `status`,`pemesanan`.`noresi` AS `noresi`,`users`.`nama` AS `nama`,`users`.`email` AS `email`,`users`.`telepon` AS `telepon`,`users`.`username` AS `username`,ifnull(`pembayaran`.`jumlah_bayar`,0) AS `jumlah_bayar`,ifnull(`pembayaran`.`nama_bank`,'') AS `nama_bank`,ifnull(`pembayaran`.`norek`,'') AS `norek`,max(ifnull(cast(`pembayaran`.`tgl_bayar` as date),'')) AS `tgl_bayar`,ifnull(`pembayaran`.`status_bayar`,'Belum Bayar') AS `status_bayar`,ifnull(`pembayaran`.`bank_tujuan`,'') AS `bank_tujuan`,ifnull(`pembayaran`.`norek_tujuan`,'') AS `norek_tujuan`,ifnull(`pembayaran`.`bukti_bayar`,'') AS `bukti_bayar`,sum(((`data_detail_pesan`.`jumlah` * `data_detail_pesan`.`sub_total`) + `pemesanan`.`total_ongkir`)) AS `total_bayar` from (((`pemesanan` join `users` on((`pemesanan`.`id_user` = `users`.`id`))) left join `pembayaran` on((`pembayaran`.`id_pesan` = `pemesanan`.`id`))) left join `data_detail_pesan` on((`data_detail_pesan`.`id_pesan` = `pemesanan`.`id`))) group by `pemesanan`.`id` order by `pemesanan`.`id` desc;

DROP TABLE IF EXISTS `data_penerimaan_stok`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `data_penerimaan_stok` AS select `a`.`id` AS `id`,`a`.`id_kopi` AS `id_kopi`,`a`.`id_user` AS `id_user`,`a`.`tgl_terima` AS `tgl_terima`,`a`.`jumlah` AS `jumlah`,`a`.`no_faktur` AS `no_faktur`,`a`.`keterangan` AS `keterangan`,`c`.`nama` AS `nama`,`b`.`nama` AS `nama_user` from ((`penerimaan_stok` `a` join `users` `b` on((`a`.`id_user` = `b`.`id`))) join `kopi` `c` on((`a`.`id_kopi` = `c`.`id`)));

-- 2019-09-26 16:45:27
