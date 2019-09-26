<html>
	<head>
		<title>Faktur Penerimaan</title>
		<style>
			.tabel_laporan {
				border: 1px solid black;
				padding: 5px;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<table style="width: 100%;">
			<tr>
				<td style="width: 50%;">
					<h3>Faktur Penerimaan Stok</h3>
				</td>
				<td style="width: 50%;text-align: center;">
					<img src="http://solok-radja.dafma.id/assets/img/logo-small.png" width="100" />
				</td>
			</tr>
		</table>
		
		<table style="width: 100%;">
			<tr>
		    <td style="width: 25%;">No Faktur</td>
		    <td style="width: 30%;">{{ $data['no_faktur'] }}</td>
		    <td style="width: 20%;">Nama Petugas</td>
		    <td style="width: 25%;">{{ $data['nama_user'] }}</td>
	    </tr>
	    <tr>
		    <td>Tanggal Terima</td>
		    <td>{{ TanggalIndo($data['tgl_terima']) }}</td>
		    <td>Keterangan</td>
		    <td>{{ $data['keterangan'] }}</td>
	    </tr>
	   </table>
	  <table class="tabel_laporan" style="width: 100%;">
	    <tr>
	      <th class="tabel_laporan">No</th>
	      <th class="tabel_laporan">Nama Kopi</th>
	      <th class="tabel_laporan">Jumlah</th>
	    </tr>
	      <tr>
	        <td class="tabel_laporan">1</td>
	        <td class="tabel_laporan"><?= $data['nama'] ?></td>
	        <td class="tabel_laporan"><?= $data['jumlah'] ?></td>
	      </tr>
	      <tr>
	      	<td class="tabel_laporan" colspan="2" style="font-weight: bold;text-align: right;">TOTAL</td>
	      	<td class="tabel_laporan"><?= $data['jumlah'] ?></td>
	      </tr>
	  </table>
	</body>
</html>