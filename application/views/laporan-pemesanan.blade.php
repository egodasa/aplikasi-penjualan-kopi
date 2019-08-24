@extends('template.layout')
@section('content')
    <form action="{{ site_url('cetak-laporan-pemesanan') }}" target="_blank">
      <h4>Laporan Harian</h4>
      <input type="hidden" name="jenis" value="harian">
      @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_pesan', 'class' => 'form-control', 'label' => 'Pilih Tanggal']])
      <button type="submit" class="btn btn-primary">Cetak</button>
    </form>
    <form action="{{ site_url('cetak-laporan-pemesanan') }}" target="_blank">
      <h4>Laporan Bulanan</h4>
      <input type="hidden" name="jenis" value="bulanan">
      @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_pesan', 'class' => 'form-control', 'label' => 'Pilih Tanggal/Bulan']])
      <button type="submit" class="btn btn-primary">Cetak</button>
    </form>
    <form action="{{ site_url('cetak-laporan-pemesanan') }}" target="_blank">
      <h4>Laporan Tahunan</h4>
      <input type="hidden" name="jenis" value="tahunan">
      @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_pesan', 'class' => 'form-control', 'label' => 'Pilih Tanggal/Tahun']])
      <button type="submit" class="btn btn-primary">Cetak</button>
    </form>
    <form action="{{ site_url('cetak-laporan-pemesanan') }}" target="_blank">
      <h4>Laporan Berdasarkan Periode Waktu</h4>
      <input type="hidden" name="jenis" value="periode">
      @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_pesan_awal', 'class' => 'form-control', 'label' => 'Pilih Tanggal Awal']])
      @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_pesan_akhir', 'class' => 'form-control', 'label' => 'Pilih Tanggal Akhir']])
      <button type="submit" class="btn btn-primary">Cetak</button>
    </form>
  </div>
@endsection
