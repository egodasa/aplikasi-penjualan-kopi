@extends('template.layout')
@section('content')
  <a href="{{ site_url('pemesanan') }}" class="btn btn-primary">< Kembali</a>
  <h3>Detail Pemesanan</h3>
  <div class="row">
    <div class="col-xs-12 col-sm-3">ID Pemesanan</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['id'] }}</div>
    <div class="col-xs-12 col-sm-3">Nama Pemesan</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['nama'] }}</div>
    
    
    <div class="col-xs-12 col-sm-3">Tanggal Pemesanan</div>
    <div class="col-xs-12 col-sm-3">{{ TanggalIndo($data_pemesanan['tgl_pesan']) }}</div>
    <div class="col-xs-12 col-sm-3">Email</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['email'] }}</div>
    
    <div class="col-xs-12 col-sm-3">Nama Ekspedisi</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['nama_ekspedisi'] }}</div>
    <div class="col-xs-12 col-sm-3">Telepon</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['telepon'] }}</div>
    
    <div class="col-xs-12 col-sm-3">Total Ongkir</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['total_ongkir'] }}</div>
    <div class="col-xs-12 col-sm-3">Status Pemesanan</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['status'] }}</div>
    
    <div class="col-xs-12 col-sm-3">No Resi</div>
    <div class="col-xs-12 col-sm-3">{{ $data_pemesanan['noresi] }}</div>
    <div class="col-xs-12 col-sm-3">Total Bayar</div>
    <div class="col-xs-12 col-sm-3"></div>
    
    
  </div>
  <?php
    {{ $total = 0 }}
  ?>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>Nama Kopi</th>
      <th>Foto</th>
      <th>harga</th>
      <th>Jumlah</th>
      <th>Sub Total</th>
    </tr>
    @foreach($data_list as $nomor => $data)
    {{ $total++ }}
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['nama'] }}</td>
        <td><img src="{{ base_url('assets/img/'.$data['gambar']) }}" width="300" height="300" /></td>
        <td>{{ rupiah($data['harga']) }}</td>
        <td>{{ $data['jumlah'] }}</td>
        <td>{{ rupiah(($data['harga']*$data['jumlah'])) }}</td>
      </tr>
    @endforeach
    <tr>
      <td colspan="5">Ongkir</td>
      <td>{{ rupiah($data_pemesanan['ongkir']) }}</td>
    </tr>
    <tr>
      <td colspan="5">Total Bayar</td>
      <td>{{ rupiah(($data_pemesanan['ongkir'] + $total)) }}</td>
    </tr>
  </table>
@endsection
