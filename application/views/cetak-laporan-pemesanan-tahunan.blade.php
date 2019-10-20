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
      	Email:solokradjo@gmail.com <br> <br> Laporan Penjualan  <?=$judul?>
      </h2>
      <table class="tabel_laporan">
      	<tr>
          <th style="text-align: center;">No</th>
          <th>Bulan</th>
          <th>Ongkos Kirim</th>
          <th>Total Bayar</th>
        </tr>
        <?php
        	$jumlah = [0,0];
        	foreach($data_list as $nomor => $data):
        		$jumlah[0] += $data['total_ongkir'];
        		$jumlah[1] += $data['sub_total'];
        ?>
          <tr>
            <td style="text-align: center;">{{ ($nomor+1) }}</td>
            <td>{{ namaBulan($data['bulan']) }}</td>
            <td>{{ rupiah($data['total_ongkir']) }}</td>
            <td>{{ rupiah($data['sub_total']) }}</td>
          </tr>
        <?php
        	endforeach;
        ?>
	        <tr>
            <td>JUMLAH</td>
            <td></td>
            <?php
            	for($x = 0; $x < 2; $x++)
            	{
            ?>
            	<td><?=rupiah($jumlah[$x])?></td>
            <?php
            	}
            ?>
          </tr>
        </table>
        <br>
        <br>
        <br>
        <table style="margin: 0 auto; width: 100%;">
          <tr>
          	<td style="width: 9%;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
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
