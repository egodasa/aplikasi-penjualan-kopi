@extends('template.layout')
@section('content')
  <h3>Data user</h3>
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Email</th>
      <th>Telepon</th>
      <th>username</th>
      <th>Level</th>
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
          <button type="button" onclick="showConfirmationDelete('<?=site_url("user/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
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
      elId("form_modal").action = "{{ site_url('user/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('user/edit') }}";
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
          <form id="form_modal" method="POST" action="{{ site_url('user/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama']])

            @include('components.form.input', ['_data' => ['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'max' => 100, 'label' => 'Email']])

             @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'telepon', 'class' => 'form-control', 'max' => 20, 'label' => 'Telepon']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'username', 'class' => 'form-control', 'max' => 20, 'label' => 'Username']])

            @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password', 'class' => 'form-control', 'max' => 50, 'label' => 'Password']])

            @include('components.form.select', ['_data' => ['name' => 'akses_level', 'class' => 'form-control', 'label' => 'level user', 'val' => 'val', 'caption' => 'val', 'options' => [['val' => 'Admin'], ['val' => 'Member']]]])
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
