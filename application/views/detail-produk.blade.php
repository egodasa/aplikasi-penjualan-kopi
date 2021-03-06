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
              <td>
              	@if($detail_kopi['diskon'] != 0)
              		{!! "<del>".rupiah($detail_kopi['harga'])."</del>, ".rupiah(($detail_kopi['harga'] - $detail_kopi['diskon'])) !!}
              	@else
              		{{ rupiah($detail_kopi['harga']) }}
              	@endif
              </td>
            </tr>
            <tr>
              <td><h4>Deskripsi</h4></td>
              <td>:</td>
              <td>{{ $detail_kopi['deskripsi'] }}</td>
            </tr>
            @if($detail_kopi['stok'] < 1)
            	<tr>
	              <td><h4>Stok</h4></td>
	              <td>:</td>
	              <td>0</td>
	            </tr>
              <tr>
                <td colspan="3"><h4>Maaf, stok sedang kosong</h4></td>
              </tr>
            @else
            	<tr>
	              <td><h4>Stok</h4></td>
	              <td>:</td>
	              <td>{{ $detail_kopi['stok'] }}</td>
	            </tr>
              @if(isset($_SESSION['id']))
                @if($_SESSION['akses_level'] == 'Member')
              <tr>
                <td colspan="3">
                  <form method="POST">
                    <input type="hidden" name="id_kopi" value="{{ $detail_kopi['id'] }}">
                    <input type="hidden" name="id_user" value="{{ $_SESSION['id'] }}">
                    <input type="hidden" name="diskon" value="{{ $detail_kopi['diskon'] }}">
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
            @endif
          </table>        
        </div>
      </div>
    </div>
  </div>
  <div class="addthis_sharing_toolbox" 
  data-url="<?=$_SERVER['PHP_SELF']?>" 
  data-title="{{ $detail_kopi['nama'] }}" 
  data-description="{{ $detail_kopi['deskripsi'] }}" 
  data-media="{{ base_url('assets/img/'.$detail_kopi['gambar']) }}"></div>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4db95bfa7c682ee0"></script>
@endsection



