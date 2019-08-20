@extends('template.layout')
@section('content')
  <h3>Data Detail pemesanan</h3>
	<button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
  <table class="table table-bordered table-stripped">
    <tr>
      <th>No</th>
      <th>ID pesan</th>
      <th>ID kopi</th>
      <th>jumlah</th>
      <th>ID user</th>
      <th>Tanggal pesan</th>
      <th>Nama Ekspedisi</th>
      <th>Total ongkir</th>
      <th>Status</th>
      <th>Nomor resi</th>
      <th>ID kategori</th>
      <th>Nama</th>
      <th>Gambar</th>
      <th>Stok</th>
      <th>Harga</th>
      <th>Satuan</th>
      <th>Deskripsi</th>
      <th>Aksi</th>
    </tr>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['id_pesan'] }}</td>
        <td>{{ $data['tgl_kopi'] }}</td>
        <td>{{ $data['jumlah'] }}</td>
        <td>{{ $data['id_user'] }}</td>
        <td>{{ $data['tgl_pesan'] }}</td>
        <td>{{ $data['nama_ekspedisi'] }}</td>
        <td>{{ $data['total_ongkir'] }}</td>
        <td>{{ $data['status'] }}</td>
        <td>{{ $data['noresi'] }}</td>
        <td>{{ $data['id_kategori'] }}</td>
        <td>{{ $data['nama'] }}</td>
        <td>{{ $data['gambar'] }}</td>
        <td>{{ $data['stok'] }}</td>
        <td>{{ $data['harga'] }}</td>
        <td>{{ $data['satuan'] }}</td>
        <td>{{ $data['deskripsi'] }}</td>

        <td>
          <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button>
          <button type="button" onclick="showConfirmationDelete('<?=site_url("detail-pesan/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
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
      elName("id_pesan")[0].value = "";
      elName("id_kopi")[0].value = "";
      elName("jumlah")[0].value = "";
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('detail-pesan/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('detail-pesan/edit') }}";
      elName("id")[0].value = detail.id;
      elName("id_pesan")[0].value = detail.id_pesan;
      elName("id_kopi")[0].value = detail.id_kopi;
      elName("jumlah")[0].value = detail.jumlah;
      
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
          <form id="form_modal" method="POST" action="{{ site_url('detail-pesan/tambah') }}">
            <input type="hidden" name="id">
            @include('components.form.input', ['_data' => ['name' => 'id_pesan', 'class' => 'form-control', 'max' =>11, 'label' => 'ID Pesan']])

            @include('components.form.input', ['_data' =>['name' => 'id_kopi', 'class' => 'form-control', 'max' =>11, 'label' => 'ID Kopi']])

           @include('components.form.input', ['_data' => ['type' => 'number''name' => 'jumlah', 'class' => 'form-control', 'max' =>11, 'label' => 'ID Pesan']])

            

            

    <div class="form-group">
      <label>Level</label>
      <select class="form-control" name="level">
        <option value="Admin">Admin</option>
        <option value="Member">Member</option>
      </select>
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
