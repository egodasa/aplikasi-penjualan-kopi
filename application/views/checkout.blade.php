@extends('template.layout-no-box')
@section('content')
  <div class="box">
    <form method="post">
      <h3>Checkout</h3>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th colspan="2">Produk</th>
              <th>Jumlah</th>
              <th>Harga </th>
              <th colspan="2">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; ?>
            @foreach($data_list as $nomor => $data)
              <?php $total+= $data['jumlah'] * $data['harga']; ?>
              <tr>
                <td><a href="{{ site_url('kopi/detail/'.$data['id_kopi']) }}"><img src="{{ base_url('assets/img/'.$data['gambar']) }}" width="100" alt="White Blouse Armani"></a></td>
                <td><a href="{{ site_url('kopi/detail/'.$data['id_kopi']) }}">{{ $data['nama'] }}</a></td>
                <td>
                    {{ $data['jumlah'] }}
                </td>
                <td>{{ rupiah($data['harga']) }}</td>
                <td>{{ rupiah(($data['harga'] * $data['jumlah'])) }}</td>
                <td></td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5">Total</th>
              <th colspan="2">
                {{ rupiah($total) }}
                <input type="hidden" value="{{ $total }}" name="sub_total">
                <input type="hidden" name="total_ongkir">
                <input type="hidden" name="nama_ekspedisi">
                <input type="hidden" name="id_user" value="{{ $_SESSION['id'] }}">
                <input type="hidden" name="tgl_pesan" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="status" value="Belum bayar">
                <input type="hidden" name="noresi" value="">
              </th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.table-responsive-->
      <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
        <div style="float: left;"><a href="{{ base_url() }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Lanjutkan Belanja</a></div>
        <div style="float: right;">
          <button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Proses Checkout</button>
        </div>
      </div>
    </form>
  </div>
@endsection

