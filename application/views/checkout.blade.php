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
              <th>Berat (gr) </th>
              <th colspan="2">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; ?>
            <?php $total_berat = 0; ?>
            <?php foreach($data_list as $nomor => $data): ?>
              <?php $total+= $data['jumlah'] * $data['harga']; ?>
              <?php $total_berat += $data['berat'] * $data['jumlah']; ?>
              <tr>
                <td><a href="<?= site_url('kopi/detail/'.$data['id_kopi']) ?>"><img src="<?= base_url('assets/img/'.$data['gambar']) ?>" width="100" alt="White Blouse Armani"></a></td>
                <td><a href="<?= site_url('kopi/detail/'.$data['id_kopi']) ?>"><?= $data['nama'] ?></a></td>
                <td>
                    <?= $data['jumlah'] ?>
                </td>
                <td><?= rupiah($data['harga']) ?></td>
                <td><?= ($data['berat']*$data['jumlah']); ?></td>
                <td colspan="2"><?= rupiah(($data['harga'] * $data['jumlah'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5">
                Total Berat
              </td>
              <td colspan="2">
                <?=$total_berat?> gr
              </td>
            </tr>
            <tr>
              <td colspan="2">
                Alamat Lengkap
              </td>
              <td colspan="5">
                <div class="form-group">
                  <textarea name="alamat" class="form-control"></textarea>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                Tujuan Pengiriman
              </td>
              <td colspan="5">
                <div class="row">
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label>Pilih Provinsi : </label>
                      <select name="id_provinsi" class="form-control">
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label>Pilih Kabupaten/Kota : </label>
                      <select name="id_kota" class="form-control">
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label>Pilih Kurir : </label>
                      <select name="kurir" class="form-control">
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                        <option value="pos">POS Indonesia</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                      <label>Pilih Layanan Kurir : </label>
                      <select name="layanan" class="form-control">
                      </select>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                Total Ongkir
              </td>
              <td colspan="2">
                <p name="keterangan_ongkir">Silahkan Pilih Tujuan Pengiriman</p>
                <input type="hidden" name="total_ongkir">
                <input type="hidden" name="nama_ekspedisi">
              </td>
            </tr>
            <tr>
              <th colspan="5">Total Harga Produk</th>
              <th colspan="2">
                {{ rupiah($total) }}
                <input type="hidden" value="{{ $total }}" name="sub_total">
                <input type="hidden" name="id_user" value="{{ $_SESSION['id'] }}">
                <input type="hidden" name="tgl_pesan" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="status" value="Belum bayar">
                <input type="hidden" name="noresi" value="">
              </th>
            </tr>
            <tr>
              <td colspan="5">
                Total Keseluruhan
              </td>
              <td colspan="2">
                <p name="total_keseluruhan">0</p>
              </td>
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

@section('script')
  <script>
    var id_kota_perusahaan = 421;
    var total_berat = <?=$total_berat?>;
    var data_kurir = [];
    
    function resetKota()
    {
      document.getElementsByName("id_kota")[0].selectedIndex = 0;
      document.getElementsByName("id_kota")[0].innerHTML = "<option value=''>Pilih Kota</option>";
    }
    function resetKurir()
    {
      document.getElementsByName("kurir")[0].selectedIndex = 0;
    }
    
    function resetLayananKurir()
    {
      document.getElementsByName("layanan")[0].selectedIndex = 0;
      document.getElementsByName("layanan")[0].innerHTML = "<option valie=''>Pilih Layanan</option>";
    }
    
    function getProvinsi()
    {
      resetKota();
      resetKurir();
      resetLayananKurir();
      
      axios.get("{{ site_url('provinsi') }}")
      .then(function(res){
        var data = res.data;
        if(data.code == 200)
        {
          document.getElementsByName("id_provinsi")[0].innerHTML = fillSelect(data.data, "province_id", "province", "", "Pilih Provinsi");
        }
        else
        {
          alert("Terdapat kesalahan dalam mengambil data provinsi. Silahkan refresh halaman kembali");
        }
      })
    }
    function getKota()
    {
      resetKurir();
      resetLayananKurir();
      var id_provinsi = document.getElementsByName("id_provinsi")[0].value;
      if(id_provinsi)
      {
        axios.get("{{ site_url('kota') }}?province=" + id_provinsi)
        .then(function(res){
          var data = res.data;
          if(data.code == 200)
          {
            document.getElementsByName("id_kota")[0].innerHTML = fillSelect(data.data, "city_id", "city_name", "", "Pilih Kota");
          }
          else
          {
            alert("Terdapat kesalahan dalam mengambil data provinsi. Silahkan refresh halaman kembali");
          }
        })
      }
      else
      {
        alert("Silahkan pilih provinsi terlebih dahulu");
      }
    }
    
    function getKurir()
    {
      resetLayananKurir();
      var id_kota_tujuan = document.getElementsByName("id_kota")[0].value;
      var kurir = document.getElementsByName("kurir")[0].value;
      if(id_kota_tujuan)
      {
        axios.get("{{ site_url('ongkir') }}?origin=" + id_kota_perusahaan + "&destination=" + id_kota_tujuan + "&weight=" + total_berat + "&courier=" + kurir)
          .then(function(res){
            var data = res.data;
            var data_layanan_kurir = data.data[0].costs;
            var layanan_kurir = "<option value=''>Pilih Layanan</option>";
            if(data_layanan_kurir.length == 0)
            {
              layanan_kurir = "<option>Layanan tidak tersedia</option>";
            }
            else
            {
              var count = data_layanan_kurir.length;
              for(var x = 0; x < count; x++)
              {
                layanan_kurir += "<option value='" + data.data[0].code.toUpperCase() + " " + data_layanan_kurir[x].service + "'>" + data_layanan_kurir[x].service  + "</option>";
                document.getElementsByName("layanan")[0].innerHTML = layanan_kurir;
              }
              data_kurir = data_layanan_kurir;
            }
          })
      }
      else
      {
        alert("Silahkan pilih kota tujuan terlebih dahulu");
      }
    }
    
    function hitungOngkir()
    {
      var layanan_kurir_terpilih = document.getElementsByName("layanan")[0].selectedIndex - 1;
      if(layanan_kurir_terpilih < 0)
      {
        document.getElementsByName("keterangan_ongkir")[0].innerHTML = "Silahkan Pilih Tujuan Pengiriman";
        document.getElementsByName("total_ongkir")[0].value = 0;
        document.getElementsByName("nama_ekspedisi")[0].value = "";
        document.getElementsByName("total_keseluruhan")[0].value = AutoNumeric.format(0, pengaturan_rupiah);
      }
      else
      {
        document.getElementsByName("keterangan_ongkir")[0].innerHTML = AutoNumeric.format(data_kurir[layanan_kurir_terpilih].cost[0].value, pengaturan_rupiah) + " (" + data_kurir[layanan_kurir_terpilih].cost[0].etd +" hari)";
        document.getElementsByName("total_ongkir")[0].value = data_kurir[layanan_kurir_terpilih].cost[0].value;
        document.getElementsByName("nama_ekspedisi")[0].value = document.getElementsByName("layanan")[0].value;
        document.getElementsByName("total_keseluruhan")[0].innerHTML = AutoNumeric.format((parseInt(data_kurir[layanan_kurir_terpilih].cost[0].value) + parseInt(document.getElementsByName("sub_total")[0].value)), pengaturan_rupiah);
      }
    }
    
    document.getElementsByName("id_provinsi")[0].addEventListener("change", getKota);
    document.getElementsByName("id_kota")[0].addEventListener("change", function(){
      resetKurir();
      resetLayananKurir();
    });
    document.getElementsByName("kurir")[0].addEventListener("change", getKurir);
    document.getElementsByName("layanan")[0].addEventListener("change", hitungOngkir);
    
    getProvinsi();
  </script>
  
  
@endsection

