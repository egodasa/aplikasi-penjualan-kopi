@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Data user')
@section('sidebar_title', 'Data user ')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Data user')

@section('content')
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Telepon</th>
      <th>Username</th>
       <th>Akses level</th>
      <th>Aksi</th>
    </tr>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['nama'] }}</td>
        <td>{{ $data['email'] }}</td>
        <td>{{ $data['telepon'] }}</td>
        <td>{{ $data['username'] }}</td>
        <td>{{ $data['akses_level'] }}</td>

        <td>
          <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
          <a href="<?=site_url("admin/user/hapus?id=".$data['id'])?>" class="btn btn-danger">Hapus</a>
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
      elName("nama")[0].value = "";
      elName("email")[0].value = "";
      elName("telepon")[0].value = "";
      elName("username")[0].value = "";
      elName("password")[0].value = "";
      elName("akses_level")[0].value = "";
       
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('admin/user/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('admin/user/edit') }}";
      elName("id")[0].value = detail.id;
      elName("nama")[0].value = detail.nama;
      elName("email")[0].value = detail.email;
      elName("telepon")[0].value = detail.telepon;
      elName("username")[0].value = detail.username;
      elName("password")[0].value = detail.password;
      elName("akses_level")[0].value = detail.akses_level;
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
          <form id="form_modal" method="POST" action="{{ site_url('admin/user/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'email', 'class' => 'form-control', 'max' => 100, 'label' => 'Email']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'telepon', 'class' => 'form-control', 'max' => 20, 'label' => 'Telepon']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'username', 'class' => 'form-control', 'max' => 20, 'label' => 'Username']])

             @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'password', 'class' => 'form-control', 'max' => 50, 'label' => 'Password']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'akses_level', 'class' => 'form-control', 'max' => 50, 'label' => 'Akses level']])
          
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
