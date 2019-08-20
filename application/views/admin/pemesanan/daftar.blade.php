@extends('components.layout_admin')

{{-- 
  Section tambahan:
  head : untuk penambahan kode didalam head
  script : untuk penambahan kode didalam script bagian paling bawah halaman
  sidebar : untuk mengatur menu pada sidebar
   --}}

@section('title', 'Data pemesanan')
@section('sidebar_title', 'Data pemesanan kopi ')
@section('user_image', 'images/img.jpg')
@section('username', 'Mandan')
@section('content_title', 'Data  pemesanan kopi')

@section('content')
  <button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>Id User</th>
      <th>Tanggal pesan</th>
      <th>Nama ekspedisi</th>
      <th>Total ongkir</th>
      <th>Aksi</th>
    </tr>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['id_user'] }}</td>
        <td>{{ $data['tgl_pesan'] }}</td>
        <td>{{ $data['nama_ekspedisi'] }}</td>
        <td>{{ $data['total_ongkir'] }}</td>
        <td>
          <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
          <a href="<?=site_url("admin/pemesanan/hapus?id=".$data['id'])?>" class="btn btn-danger">Hapus</a>
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
      elName("id_user")[0].value = "";
      elName("tgl_pesan")[0].value = "";
      elName("total_ongkir")[0].value = "";   
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('admin/pemesanan/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('admin/pemesanan/edit') }}";
      elName("id")[0].value = detail.id;
      elName("id_user")[0].value = detail.id_user;
      elName("tgl_pesan")[0].value = detail.tgl_pesan;
      elName("nama_ekspedisi")[0].value = detail.nama_ekspedisi;
      elName("total_ongkir")[0].value = detail.total_ongkir;
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
          <form id="form_modal" method="POST" action="{{ site_url('admin/pemesanan/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => [ 'name' => 'id_user', 'class' => 'form-control',  'label' => 'User', 'options' => $data_user, 'val' => 'id', 'caption' => 'username']])

            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_pesan', 'class' => 'form-control', 'max' => 50, 'label' => 'Tanggal Pesan']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama_ekspedisi', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama Ekspedisi']])

            @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'total_ongkir', 'class' => 'form-control', 'max' => 11, 'label' => 'Stok']])
          
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
