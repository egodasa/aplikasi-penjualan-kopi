@extends('template.layout')
@section('content')
  <h3>Data Pemesanan</h3>
  <?php if($_SESSION['akses_level'] == "Admin"): ?>
    <?=alertBootstrap("Pesan!", "Harap lakukan verifikasi pembayaran segera setelah pelanggan telah melakukan pembayaran", "warning")?>
  <?php else: ?>
    <?=alertBootstrap("Pesan!", "Harap lakukan pembayaran segera agar pemesanan yang dilakukan bisa segera diproses oleh pihak Radja Solok", "warning")?>
  <?php endif; ?>
  
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
          <button type="button" onclick="showConfirmationDelete('<?=site_url("pemesanan/hapus?id=".$data['id'])?>')" class="btn btn-danger btn-sm">Hapus</button>
          <a href="{{ site_url('pemesanan/detail/'.$data['id']) }}" class="btn btn-warning btn-sm">Detail Pemesanan</a>
          <a href="{{ site_url('pemesanan/detail/faktur/'.$data['id']) }}" target="_blank" class="btn btn-success btn-sm">Cetak Faktur</a>
          
          @if($_SESSION['akses_level'] == "Member" )
            @if(in_array($data['status'], ["Belum bayar", "Pembayaran ditolak"]))
              <button onclick="showModalKonfirmasi({{ $nomor }})" class="btn btn-primary btn-sm">Konfirmasi Pembayaran</button>
            @endif
          @else
            @if(in_array($data['status'], ["Sedang diverifikasi"]))
              <button onclick="showModalVerifikasi({{ $nomor }})" class="btn btn-primary btn-sm">Verifkasi Pembayaran</button>
            @elseif($data['status'] == "Pembayaran diterima")
              <button onclick="showModalNoResi({{ $nomor }})" class="btn btn-primary btn-sm">Tambah Nomor Resi</button>
            @endif
          @endif
          
          <?php
          	if(!empty($data['noresi']))
          	{
          ?>
          	<a href="https://cekresi.com/?noresi=<?=$data['noresi']?>" class="btn btn-primary btn-sm" target="_blank">Lacak Paket</a>
          <?php
          	}
          ?>
        </td>
      </tr>
    @endforeach
  </table>
  
  @include('modal-konfirmasi-pembayaran')
  @include('modal-verifikasi-pembayaran')
  @include('modal-update-no-resi')
  
  <script>
    var data = <?=json_encode($data_list)?>;
    function showModalKonfirmasi(id)
    {
      document.getElementsByName("id_pesan")[0].value = data[id].id;
      document.getElementsByName("total_bayar")[0].value = data[id].total_bayar;
      showModal("#modal-konfirmasi-pembayaran");
    }
    function showModalVerifikasi(id)
    {
      document.getElementsByName("id")[0].value = data[id].id;
      document.getElementsByName("id_pembayaran")[0].value = data[id].id_pembayaran
      document.getElementsByName("total_bayar")[1].value = data[id].total_bayar;
      document.getElementsByName("tgl_bayar")[1].value = data[id].tgl_bayar;
      document.getElementsByName("jumlah_bayar")[1].value = data[id].jumlah_bayar;
      document.getElementsByName("nama_bank")[1].value = data[id].nama_bank;
      document.getElementsByName("norek")[1].value = data[id].norek;
      document.getElementsByName("bank_tujuan")[1].value = data[id].bank_tujuan;
      document.getElementsByName("norek_tujuan")[1].value = data[id].norek_tujuan;
      document.getElementsByName("foto_bukti")[0].href = "{{ base_url('assets/img/') }}" + data[id].bukti_bayar;
      document.getElementsByName("foto_bukti")[1].src = "{{ base_url('assets/img/') }}" + data[id].bukti_bayar;
      showModal("#modal-verifikasi-pembayaran");
    }
    function showModalNoResi(id)
    {
      document.getElementsByName("id")[1].value = data[id].id;
      showModal("#modal-update-no-resi");
    }
  </script>
@endsection
