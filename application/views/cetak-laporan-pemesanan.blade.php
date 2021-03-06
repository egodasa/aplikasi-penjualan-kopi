<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kopi</title>
      <style>
            .tabel_laporan {
                  border: 1px solid black;
                  margin: 0 auto;
                  border-collapse: collapse;
                  font-size: 12px;
            }
            .tabel_laporan th, .tabel_laporan td {
                  border: 1px solid black;
                  border-collapse: collapse;
                  padding: 5px 10px;
            } 
            .tabel_laporan th {
                  background-color: #E0E0E0;
            }
      </style>
</head>
<body>
      <h2 align="center">
      	KOPERASI SERBA USAHA SOLOK RADJO <br>
      	Aie Dingin, Lembah Gumanti, Solok, Sumatera Barat, 27371 <br> 
      	Email:solokradjo@gmail.com <br> <br>
     LAPORAN PENJUALAN<br> <?=$judul?>
      </h2>
      <table class="tabel_laporan">
      	<tr>
          <th style="text-align: center;">No</th>
          <th>Nama</th>
          <th>Tanggal Pesan</th>
          <th>Nama Kopi</th>
          <th>Harga</th>
          <th style="text-align: center;">Jumlah</th>
          <th>Sub Total</th>
          <th>Ekspedisi</th>
          <th>Ongkir</th>
          <th>Total Bayar</th>
        </tr>
        <?php
        	$jumlah = 0;
        	$ongkir = 0;
        	$total_bayar = 0;
        	$harga = 0;
        	foreach($data_list as $nomor => $data):
        		$jumlah += $data['jumlah'];
        		$harga += $data['sub_total'];
        		$ongkir += $data['total_ongkir'];
        		$total_bayar += $data['sub_total'] + $data['total_ongkir'];
        ?>
          <tr>
            <td style="text-align: center;">{{ ($nomor+1) }}</td>
            <td>{{ $data['nama_pelanggan'] }}</td>
            <td>{{ TanggalIndo($data['tgl_pesan']) }}</td>
            <td>{{ $data['nama_kopi'] }}</td>
            <td>{{ rupiah($data['harga']) }}</td>
            <td style="text-align: center;">{{ $data['jumlah'] }}</td>
            <td>{{ rupiah($data['sub_total']) }}</td>
            <td>{{ $data['nama_ekspedisi'] }}</td>
            <td>{{ rupiah($data['total_ongkir']) }}</td>
            <td>{{ rupiah(($data['sub_total'] + $data['total_ongkir'])) }}</td>
          </tr>
        <?php
        	endforeach;
        ?>
	        <tr>
            <td>JUMLAH</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center;">{{ $jumlah }}</td>
            <td style="text-align: center;">{{ rupiah($harga) }}</td>
            <td></td>
            <td>{{ rupiah($ongkir) }}</td>
            <td>{{ rupiah($total_bayar) }}</td>
          </tr>
        </table>
        <br>
        <br>
        <br>
        <table style="margin: 0 auto; width: 100%;">
          <tr>
          	<td style="width: 70%;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
          	<td style="width: 30%;text-align: center;">
          		Solok, <?=TanggalIndo(date("Y-m-d"))?> <br>
			      	Mengetahui  
			      	<br>
			      	<br>
			      	<br>
			      	<br>
			      	<br>
			      	<?=$_SESSION['nama']?> 
          	</td>
          </tr>
        </table>
</body>
</html>
