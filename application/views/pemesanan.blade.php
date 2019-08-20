@extends('template.layout')
@section('content')
  <h3>Data Pemesanan</h3>
  <?=alertBootstrap("Pesan!", "Harap lakukan pembayaran segera agar pemesanan yang dilakukan bisa segera diproses oleh pihak Radja Solok", "warning")?>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>ID Pesan</th>
      @if($_SESSION['akses_level'] == "Admin")
      <th>Nama</th>
      @endif
      <th>Tanggal pesan</th>
      <th>Nama Ekspedisi</th>
      <th>Total ongkir</th>
      <th>Status</th>
      <th>Nomor resi</th>
      <th>Aksi</th>
    </tr>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['id'] }}</td>
        @if($_SESSION['akses_level'] == "Admin")
        <td>{{ $data['nama'] }}</td>
        @endif
        <td>{{ TanggalIndo($data['tgl_pesan']) }}</td>
        <td>{{ $data['nama_ekspedisi'] }}</td>
        <td>{{ $data['total_ongkir'] }}</td>
        <td>{{ $data['status'] }}</td>
        <td>{{ $data['noresi'] }}</td>
         
        <td>
          <button type="button" onclick="showConfirmationDelete('<?=site_url("pemesanan/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
          <a href="{{ site_url('detail-pemesanan?id_pemesanan='.$data['id']) }}" class="btn btn-warning">Detail Pemesanan</a>
        </td>
      </tr>
    @endforeach
  </table>
@endsection
