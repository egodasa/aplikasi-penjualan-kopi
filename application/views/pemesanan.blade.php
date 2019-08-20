@extends('template.layout')
@section('content')
  <h3>Data Pemesanan</h3>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>ID Pesan</th>
      <th>Nama</th>
      <th>Tanggal pesan</th>
      <th>Nama Ekspedisi</th>
      <th>Total ongkir</th>
      <th>Status</th>
      <th>Nomor resi</th>
      <th>status</th>
      <th>Aksi</th>
    </tr>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['id'] }}</td>
        <td>{{ $data['nama'] }}</td>
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
