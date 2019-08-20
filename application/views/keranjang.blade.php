@extends('template.layout-no-box')
@section('content')
  <div class="box">
    <form method="post" action="{{ site_url('keranjang/edit') }}">
      <h3>Keranjang Belanja</h3>
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
                <td><a href="#"><img src="{{ base_url('assets/img/'.$data['gambar']) }}" width="100" alt="White Blouse Armani"></a></td>
                <td><a href="#">{{ $data['nama'] }}</a></td>
                <td>
                    <input type="hidden" name="id[]" value="{{ $data['id'] }}" >
                    <input type="number" value="{{ $data['jumlah'] }}" name="jumlah[]" class="form-control" />
                </td>
                <td>{{ rupiah($data['harga']) }}</td>
                <td>{{ rupiah(($data['harga'] * $data['jumlah'])) }}</td>
                <td><a href="{{ site_url('keranjang/hapus/'.$data['id']) }}"><i class="fa fa-trash-o"></i></a></td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5">Total</th>
              <th colspan="2">{{ rupiah($total) }}</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.table-responsive-->
      <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
        <div style="float: left;"><a href="{{ base_url() }}" class="btn btn-success"><i class="fa fa-chevron-left"></i> Lanjutkan Belanja</a></div>
        <div style="float: right;">
          <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-refresh"></i> Ubah Keranjang</button>
          <a href="{{ site_url('checkout') }}" class="btn btn-primary">Checkout <i class="fa fa-chevron-right"></i></a>
        </div>
      </div>
    </form>
  </div>
@endsection

