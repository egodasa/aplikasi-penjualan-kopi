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
      	Email:solokradjo@gmail.com <br> 
      	LAPORAN PENJUALAN PER TAHUN 
      </h2>
      <table class="tabel_laporan">
      	<tr>
          <th style="text-align: center;">No</th>
          <th>Nama Kopi</th>
          <th>Januari</th>
          <th>Februari</th>
          <th>Maret</th>
          <th>April</th>
          <th>Mei</th>
          <th>Juni</th>
          <th>Juli</th>
          <th>Agustus</th>
          <th>September</th>
          <th>Oktober</th>
          <th>November</th>
          <th>Desember</th>
        </tr>
        <?php
        	$jumlah = [0,0,0,0,0,0,0,0,0,0,0,0];
        	foreach($data_list as $nomor => $data):
        		$jumlah[0] += $data['januari'];
        		$jumlah[1] += $data['februari'];
        		$jumlah[2] += $data['maret'];
        		$jumlah[3] += $data['april'];
        		$jumlah[4] += $data['mei'];
        		$jumlah[5] += $data['juni'];
        		$jumlah[6] += $data['juli'];
        		$jumlah[7] += $data['agustus'];
        		$jumlah[8] += $data['september'];
        		$jumlah[9] += $data['oktober'];
        		$jumlah[10] += $data['november'];
        		$jumlah[11] += $data['desember'];
        ?>
          <tr>
            <td style="text-align: center;">{{ ($nomor+1) }}</td>
            <td>{{ $data['nama'] }}</td>
            <td>{{ rupiah($data['januari']) }}</td>
            <td>{{ rupiah($data['februari']) }}</td>
            <td>{{ rupiah($data['maret']) }}</td>
            <td>{{ rupiah($data['april']) }}</td>
            <td>{{ rupiah($data['mei']) }}</td>
            <td>{{ rupiah($data['juni']) }}</td>
            <td>{{ rupiah($data['juli']) }}</td>
            <td>{{ rupiah($data['agustus']) }}</td>
            <td>{{ rupiah($data['september']) }}</td>
            <td>{{ rupiah($data['oktober']) }}</td>
            <td>{{ rupiah($data['november']) }}</td>
            <td>{{ rupiah($data['desember']) }}</td>
          </tr>
        <?php
        	endforeach;
        ?>
	        <tr>
            <td>JUMLAH</td>
            <td></td>
            <?php
            	for($x = 0; $x < 12; $x++)
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
          	<td style="width: 10%;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
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
