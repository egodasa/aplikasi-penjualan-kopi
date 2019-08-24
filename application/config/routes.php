<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Halaman/home';
$route['404_override'] = 'Autentikasi/dilarang';
$route['translate_uri_dashes'] = FALSE;

$route['pengguna']['GET'] = 'KelolaPengguna/daftar';                // Lihat Data
$route['pengguna/tambah']['POST'] = 'KelolaPengguna/prosesTambah';  // Proses Tambah Data
$route['pengguna/edit']['POST'] = 'KelolaPengguna/prosesEdit';             // Proses Edit Data
$route['pengguna/hapus']['GET'] = 'KelolaPengguna/prosesHapus';     // Hapus Data

$route['kopi']['GET'] = 'KelolaKopi/daftar';                // Lihat Data
$route['kopi/tambah']['POST'] = 'KelolaKopi/prosesTambah';  // Proses Tambah Data
$route['kopi/edit']['POST'] = 'KelolaKopi/prosesEdit';             // Proses Edit Data
$route['kopi/hapus']['GET'] = 'KelolaKopi/prosesHapus';     // Hapus Data

$route['user']['GET'] = 'KelolaUser/daftar';                // Lihat Data
$route['user/tambah']['POST'] = 'KelolaUser/prosesTambah';  // Proses Tambah Data
$route['user/edit']['POST'] = 'KelolaUser/prosesEdit';             // Proses Edit Data
$route['user/hapus']['GET'] = 'KelolaUser/prosesHapus';     // Hapus Data

$route['kategori']['GET'] = 'KelolaKategori/daftar';                // Lihat Data
$route['kategori/tambah']['POST'] = 'KelolaKategori/prosesTambah';  // Proses Tambah Data
$route['kategori/edit']['POST'] = 'KelolaKategori/prosesEdit';             // Proses Edit Data
$route['kategori/hapus']['GET'] = 'KelolaKategori/prosesHapus';     // Hapus Data

$route['pemesanan']['GET'] = 'KelolaPemesanan/daftar';                // Lihat Data
$route['pemesanan/tambah']['POST'] = 'KelolaPemesanan/prosesTambah';  // Proses Tambah Data
$route['pemesanan/edit']['POST'] = 'KelolaPemesanan/prosesEdit';             // Proses Edit Data
$route['pemesanan/hapus']['GET'] = 'KelolaPemesanan/prosesHapus';     // Hapus Data
$route['pemesanan/detail/(:num)']['GET'] = 'KelolaPemesanan/detailPemesanan/$1';     // Hapus Data

$route['konfirmasi-pembayaran']['POST'] = 'KelolaPembayaran/konfirmasiPembayaran';     // Hapus Data
$route['verifikasi-pembayaran']['POST'] = 'KelolaPembayaran/verifikasiPembayaran';     // Hapus Data
$route['update-no-resi']['POST'] = 'KelolaPemesanan/tambahNoResi';     // Hapus Data

$route['kopi/detail/(:num)']['GET'] = 'KelolaKopi/detailKopi/$1';                // Lihat Data
$route['kopi/detail/(:num)']['POST'] = 'KelolaKopi/tambahKeranjang/$1';                // Lihat Data

$route['keranjang']['GET'] = 'KelolaKopi/keranjang';                // Lihat Data
$route['keranjang/edit']['POST'] = 'KelolaKopi/editKeranjang/$1';   
$route['keranjang/hapus/(:num)']['GET'] = 'KelolaKopi/hapusKeranjang/$1';   
$route['checkout']['GET'] = 'KelolaKopi/checkout';   
$route['checkout']['POST'] = 'KelolaKopi/prosesCheckout';

$route['laporan-kopi']['GET'] = 'KelolaKopi/cetakLaporanKopi';
$route['laporan-pemesanan']['GET'] = 'KelolaPemesanan/laporanPemesanan';
$route['cetak-laporan-pemesanan']['GET'] = 'KelolaPemesanan/cetakLaporanPemesanan';

$route['login']['POST'] = 'Halaman/prosesLogin'; 
$route['registrasi']['POST'] = 'Halaman/prosesRegister'; 
$route['logout']['GET'] = 'Halaman/prosesLogout'; 

$route['kota']['GET'] = 'Halaman/getKota'; 
$route['provinsi']['GET'] = 'Halaman/getProvinsi'; 
$route['ongkir']['GET'] = 'Halaman/getOngkir'; 

$route['404']['GET'] = 'Autentikasi/dilarang'; 


// EOF Route admin
