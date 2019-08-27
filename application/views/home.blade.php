@extends('template.layout-no-box')
@section('content')
  <div id="hot">
  <div class="box py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="main-slider" class="owl-carousel owl-theme">
            <div class="item"><img src="{{ base_url('img/main-slider1.jpg') }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ base_url('img/main-slider2.jpg') }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ base_url('img/main-slider3.jpg') }}" alt="" class="img-fluid"></div>
            <div class="item"><img src="{{ base_url('img/main-slider4.jpg') }}" alt="" class="img-fluid"></div>
          </div>
          <!-- /#main-slider-->
        </div>
        <div class="col-md-12">
          <h2 class="mb-0">PRODUK</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="row-products">
    @foreach($data_list as $nomor => $data)
      <div class="col-md-4 col-sm-4">
        <div class="product">
          <div class="flip-container">
            <div class="flipper">
              <div class="front">
                <a href="{{ site_url('kopi/detail/'.$data['id']) }}">
                  <img src="{{ base_url('assets/img/'.$data['gambar']) }}" class="img-responsive">
                </a>
              </div>
              <div class="back">
                <a href="{{ site_url('kopi/detail/'.$data['id']) }}">
                  <img src="{{ base_url('assets/img/'.$data['gambar']) }}" alt="" class="img-responsive">
                </a>
              </div>
            </div>
          </div>
          <a href="detail.html" class="invisible">
            <img src="{{ base_url('assets/img/'.$data['gambar']) }}" alt="" class="img-responsive">
          </a>
          <div class="text">
            <h3><a href="{{ site_url('kopi/detail/'.$data['id']) }}">{{ $data['nama'] }}</a></h3>
            <p class="price">{{ rupiah($data['harga']) }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  </div>
@endsection

