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
</br>
</br>
<table align="center" style="width: 100%;text-align: center;">
      <tr>
        <td>
          <img src="{{ base_url() }}assets/img/logo.png" width="300"/> <br>
          <span style="font-size:12px">Aie Dingin, Lembah Gumanti, Solok, Sumatera Barat 27371</span></br>
          <span style="font-size:12px">Email:solokradjo@gmail.com</span>
          <hr style="width: 700px; border-bottom: 3px solid black;">
        </td>
      </tr>
</table>

      <h2 align="center"><?=$judul?></b></h2>
      <table class="tabel_laporan">
      	<tr>
          <th>No</th>
          <th>Nama</th>
          <th>Tanggal Pesan</th>
          <th>Ekspedisi</th>
          <th>Ongkir</th>
          <th>Total Bayar</th>
        </tr>
        @foreach($data_list as $nomor => $data)
          <tr>
            <td>{{ ($nomor+1) }}</td>
            <td>{{ $data['nama'] }}</td>
            <td>{{ TanggalIndo($data['tgl_pesan']) }}</td>
            <td>{{ $data['nama_ekspedisi'] }}</td>
            <td>{{ rupiah($data['total_ongkir']) }}</td>
            <td>{{ rupiah($data['total_bayar']) }}</td>
          </tr>
        @endforeach
        </table>
      </table>
</body>
</html>
