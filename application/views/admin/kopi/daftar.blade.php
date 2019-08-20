@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Data kopi')
@section('sidebar_title', 'Data kopi ')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Data kopi')

@section('content')
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>Id kategori</th>
      <th>Nama</th>
      <th>Gambar</th>
      <th>Stok</th>
      <th>Satuan</th>
      <th>Deskripsi</th>
      <th>Aksi</th>
    </tr>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['id_kategori'] }}</td>
        <td>{{ $data['nama'] }}</td>
        <td>{{ $data['gambar'] }}</td>
        <td>{{ $data['stok'] }}</td>
        <td>{{ $data['satuan'] }}</td>
        <td>{{ $data['deskripsi'] }}</td>
        <td>
          <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
          <a href="<?=site_url("admin/kopi/hapus?id=".$data['id'])?>" class="btn btn-danger">Hapus</a>
        </td>
      </tr>
    @endforeach
  </table>
  
  <script>
    var data = <?=json_encode($data_list)?>;
    
    function resetModal()
    {
      elId("form_modal").action = "";
      elId("judul_modal").innerHTML = "Tambah Data Baru";    
      elName("id")[0].value = "";
      elName("id_kategori")[0].value = "";
      elName("nama")[0].value = "";
      elName("gambar")[0].value = "";
      elName("stok")[0].value = "";
      elName("satuan")[0].value = "";
      elName("deskripsi")[0].value = "";
       
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('admin/kopi/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('admin/kopi/edit') }}";
      elName("id")[0].value = detail.id;
      elName("id_kategori")[0].value = detail.id_kategori;
      elName("nama")[0].value = detail.nama;
      elName("gambar")[0].value = detail.gambar;
      elName("stok")[0].value = detail.stok;
      elName("satuan")[0].value = detail.satuan;
      elName("deskripsi")[0].value = detail.deskripsi;
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
          <form id="form_modal" method="POST" action="{{ site_url('admin/kopi/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => [ 'name' => 'id_kategori', 'class' => 'form-control',  'label' => 'kategori', 'options' => $data_kategori, 'val' => 'id', 'caption' => 'nama_kategori']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'gambar', 'class' => 'form-control', 'max' => 255, 'label' => 'Gambar']])

            @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'stok', 'class' => 'form-control', 'max' => 11, 'label' => 'Stok']])

             @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'satuan', 'class' => 'form-control', 'max' => 50, 'label' => 'Satuan']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'deskripsi', 'class' => 'form-control', 'max' => 255, 'label' => 'Deskripsi']])
          
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
