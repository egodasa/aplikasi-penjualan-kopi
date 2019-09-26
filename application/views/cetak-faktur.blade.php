<html>
	<head>
		<title>Faktur</title>
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
					<h3>Faktur Pemesanan</h3>
				</td>
				<td style="width: 50%;text-align: center;">
					<img src="http://solok-radja.dafma.id/assets/img/logo-small.png" width="100" />
				</td>
			</tr>
		</table>
		
		<table style="width: 100%;">
			<tr>
		    <td style="width: 25%;">No Invoice</td>
		    <td style="width: 30%;">INV/{{ $data_pemesanan['id']."/".$data_pemesanan['id_user']."/".str_replace("-","", $data_pemesanan['tgl_pesan']) }}</td>
		    <td style="width: 20%;">Nama Pemesan</td>
		    <td style="width: 25%;">{{ $data_pemesanan['nama'] }}</td>
	    </tr>
	    <tr>
		    <td>Tanggal Pemesanan</td>
		    <td>{{ TanggalIndo($data_pemesanan['tgl_pesan']) }}</td>
		    <td>Email</td>
		    <td>{{ $data_pemesanan['email'] }}</td>
	    </tr>
	    <tr>
		    <td>Nama Ekspedisi</td>
		    <td>{{ $data_pemesanan['nama_ekspedisi'] }}</td>
		    <td>Telepon</td>
		    <td>{{ $data_pemesanan['telepon'] }}</td>
	    </tr>
	    <tr>
		    <td>Total Ongkir</td>
		    <td>{{ $data_pemesanan['total_ongkir'] }}</td>
		    <td>Status Pemesanan</td>
		    <td>{{ $data_pemesanan['status'] }}</td>
	    </tr>
	    <tr>
		    <td>No Resi</td>
		    <td>{{ $data_pemesanan['noresi'] }}</td>
		    <td>Total Bayar</td>
		    <td>{{ rupiah($data_pemesanan['total_bayar']) }}</td>
	    </tr>
	    <tr>
	    	<td>Alamat Tujuan</td>
		    <td colspan="3">{{ $data_pemesanan['alamat'] }}</td>
	    </tr>
	   </table>
	  <?php
	    $total = 0;
	  ?>
	  <table class="tabel_laporan" style="width: 100%;">
	    <tr>
	      <th class="tabel_laporan">No</th>
	      <th class="tabel_laporan">Nama Kopi</th>
	      <th class="tabel_laporan">harga</th>
	      <th class="tabel_laporan">Jumlah</th>
	      <th class="tabel_laporan">Sub Total</th>
	    </tr>
	    <?php foreach($data_list as $nomor => $data): ?>
	      <?php $total+= $data['sub_total'] ?>
	      <tr>
	        <td  class="tabel_laporan"><?= ($nomor+1) ?></td>
	        <td  class="tabel_laporan"><?= $data['nama'] ?></td>
	        <td  class="tabel_laporan"><?= rupiah($data['harga']-$data['diskon']) ?></td>
	        <td  class="tabel_laporan"><?= $data['jumlah'] ?></td>
	        <td  class="tabel_laporan"><?= rupiah($data['sub_total']) ?></td>
	      </tr>
	    <?php endforeach; ?>
	    <tr>
	      <td colspan="4" class="tabel_laporan">Ongkir</td>
	      <td  class="tabel_laporan">{{ rupiah($data_pemesanan['total_ongkir']) }}</td>
	    </tr>
	    <tr>
	      <td colspan="4"  class="tabel_laporan">Total Bayar</td>
	      <td  class="tabel_laporan">{{ rupiah(($data_pemesanan['total_ongkir'] + $total)) }}</td>
	    </tr>
	  </table>
	</body>
</html>