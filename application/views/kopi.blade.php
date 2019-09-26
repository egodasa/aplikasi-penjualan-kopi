@extends('template.layout')
@section('content')
  <h3>Data Kopi</h3>
	<button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
	<div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
  <table class="table table-bordered table-stripped">
  	<thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Kategori</th>
      <th>Gambar</th>
      <th>Stok</th>
      <th>Harga</th>
      <th>Diskon</th>
      <th>Satuan</th>
      <th>Berat (gr)</th>
      <th>deskripsi</th>
      <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['nama'] }}</td>
        <td>{{ $data['nama_kategori'] }}</td>
        <td><img src="{{ base_url('assets/img/'.$data['gambar']) }}" width="300" height="300"></td>
        <td>{{ $data['stok'] }}</td>
        <td>{{ rupiah($data['harga']) }}</td>
        <td>{{ $data['diskon_persen']."% (".rupiah($data['diskon']).")" }}</td>
        <td>{{ $data['satuan'] }}</td>
        <td>{{ $data['berat'] }} gr</td>
        <td>{{ $data['deskripsi'] }}</td>
         

        <td>
          <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
          <button type="button" onclick="showConfirmationDelete('<?=site_url("kopi/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
  </div>
  </div>
  
  <script>
    var data = <?=json_encode($data_list)?>;
    
    function resetModal()
    {
      elId("form_modal").action = "";
      elId("judul_modal").innerHTML = "Tambah Data Baru";
      elName("id")[0].value = "";
      elName("id_kategori")[0].value = "";
      elName("nama")[0].value = "";
      elName("stok")[0].value = "";
      elName("harga")[0].value = "";
      elName("satuan")[0].value = "";
      elName("deskripsi")[0].value = "";
      elName("berat")[0].value = "";
      elName("diskon")[0].value = "";
      elId("gambar").innerHTML = "";
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('kopi/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('kopi/edit') }}";
      elName("id")[0].value = detail.id;
      elName("id_kategori")[0].value = detail.id_kategori;
      elName("nama")[0].value = detail.nama;
      elName("stok")[0].value = detail.stok;
      elName("harga")[0].value = detail.harga;
      elName("satuan")[0].value = detail.satuan;
      elName("berat")[0].value = detail.berat;
      elName("deskripsi")[0].value = detail.deskripsi;
      elName("diskon")[0].value = detail.diskon;
      if(detail.gambar != "")
      {
        elId("gambar").innerHTML = "<small>*Upload gambar baru untuk mengganti gambar lama.</small> <br> <img src='{{ base_url().'assets/img/' }}" + detail.gambar + "' width='300' height='300' />"
      }
      showModal("#modal");
    }
  </script>
  
  <div class="modal fade hide-modal" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Judul Modal</h4>
        </div>
        <div class="modal-body">
          <form id="form_modal" method="POST" action="{{ site_url('kopi/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            @include('components.form.select', ['_data' => ['name' => 'id_kategori', 'class' => 'form-control', 'label' => 'Kategori Kopi', 'options' => $data_kategori, 'val' => 'id', 'caption' => 'nama_kategori']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama Kopi']])

            @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'stok', 'class' => 'form-control', 'label' => 'Stok']])

            @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'harga', 'class' => 'form-control', 'label' => 'Harga']])
            
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'diskon', 'class' => 'form-control', 'label' => 'Diskon (persen)']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'satuan', 'class' => 'form-control', 'max' =>50, 'label' => 'Satuan']])
            
            @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'berat', 'class' => 'form-control', 'label' => 'Berat (gram)']])

            @include('components.form.textarea', ['_data' => ['type' => 'text', 'name' => 'deskripsi', 'class' => 'form-control', 'max' => 255, 'label' => 'Deskripsi']])
            
            <div class="form-group">
              <label>Foto/Gambar Kopi</label>
              <br>
              <p id="gambar"></p>
              <input type="file" name="gambar" class="form-control" />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="closeModal()">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
