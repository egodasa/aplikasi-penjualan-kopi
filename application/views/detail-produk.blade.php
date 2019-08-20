@extends('template.layout-no-box')
@section('content')
  <div class="box">
    <div class="box-title">
      <h2>Detail Produk</h2>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-xs-12 col-md-4">
          <img class="img-responsive" src="{{ base_url('assets/img/'.$detail_kopi['gambar']) }}">
        </div>
        <div class="col-xs-12 col-md-8">
          <table style="width: 100%;">
            <tr>
              <td><h4>Nama</h4></td>
              <td>:</td>
              <td>{{ $detail_kopi['nama'] }}</td>
            </tr>
            <tr>
              <td><h4>Harga</h4></td>
              <td>:</td>
              <td>{{ rupiah($detail_kopi['harga']) }}</td>
            </tr>
            <tr>
              <td><h4>Deskripsi</h4></td>
              <td>:</td>
              <td>{{ $detail_kopi['deskripsi'] }}</td>
            </tr>
            <tr>
              <td><h4>Stok</h4></td>
              <td>:</td>
              <td>{{ $detail_kopi['stok'] }}</td>
            </tr>
            @if($detail_kopi['stok'] < 1)
              <tr>
                <td colspan="3"><h4>Maaf, stok sedang kosong</h4></td>
              </tr>
            @else
              @if(isset($_SESSION['id']))
              <tr>
                <td colspan="3">
                  <form method="POST">
                    <input type="hidden" name="id_kopi" value="{{ $detail_kopi['id'] }}">
                    <input type="hidden" name="id_user" value="{{ $_SESSION['id'] }}">
                    <div class="input-group">
                      <input type="number" max="{{ $detail_kopi['stok'] }}" name="jumlah" placeholder="Jumlah Pesan" class="form-control" />
                      <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">
                          Tambahkan Ke Keranjang
                        </button>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
              @endif
            @endif
          </table>        
        </div>
      </div>
    </div>
  </div>
@endsection

