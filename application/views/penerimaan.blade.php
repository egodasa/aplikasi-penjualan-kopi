@extends('template.layout')
@section('content')
  <h3>Data Penerimaan Stok</h3>
	<button type="button" onclick="showModalTambah()" class="btn btn-primary">Tambah Data</button>
	
	<div class="table-responsive">
    <div style="overflow:auto; max-height:650px; margin:0px 0 0px 0;">
  <table class="table table-bordered table-stripped">
  	<thead>
    <tr>
      <th>No</th>
      <th>No Faktur</th>
      <th>Nama Produk</th>
      <th>Jumlah Diterima</th>
      <th>Tanggal Diterima</th>
      <th>Keterangan</th>
      <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data_list as $nomor => $data)
      <tr>
        <td>{{ ($nomor+1) }}</td>
        <td>{{ $data['no_faktur'] }}</td>
        <td>{{ $data['nama'] }}</td> 
				<td>{{ $data['jumlah'] }}</td> 
				<td>{{ TanggalIndo($data['tgl_terima']) }}</td> 
				<td>{{ $data['keterangan'] }}</td>
        <td>
          <!-- <button type="button" onclick="showModalEdit({{ $nomor }})" class="btn btn-success">Edit</button> -->
          <button type="button" onclick="showConfirmationDelete('<?=site_url("penerimaan/hapus?id=".$data['id'])?>')" class="btn btn-danger">Hapus</button>
        	<a href="<?=site_url("penerimaan/detail/faktur/".$data['id'])?>" target="_blank" class="btn btn-success">Cetak Faktur</a>
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
      elName("id_kopi")[0].value = "";
      elName("id_user")[0].value = "<?=$_SESSION['id']?>";
      elName("tgl_terima")[0].value = "";
      elName("jumlah")[0].value = "";
      elName("no_faktur")[0].value = "";
      elName("keterangan")[0].value = "";
    }
    
    function closeModal()
    {
      resetModal();
      hideModal("#modal");
    }
    
    function showModalTambah()
    {
      resetModal();
      elId("form_modal").action = "{{ site_url('penerimaan/tambah') }}";
      showModal("#modal");
    }
    
    function showModalEdit(id)
    {
      elId("judul_modal").innerHTML = "Edit Data";
      resetModal();
      var detail = data[id]; 
      elId("form_modal").action = "{{ site_url('penerimaan/edit') }}";
      elName("id_kopi")[0].value = detail.id;
      elName("id_user")[0].value = "<?=$_SESSION['id']?>";
      elName("tgl_terima")[0].value = detail.tgl_diterima;
      elName("jumlah")[0].value = detail.jumlah;
      elName("no_faktur")[0].value = detail.no_faktur;
      elName("keterangan")[0].value = detail.keterangan;
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
          <form id="form_modal" method="POST" action="{{ site_url('penerimaan/tambah') }}" enctype='multipart/form-data'>
            <input type="hidden" name="id">
            <input type="hidden" name="id_user" value="{{ $_SESSION['id'] }}">
            @include('components.form.select', ['_data' => ['name' => 'id_kopi', 'class' => 'form-control', 'label' => 'Pilih Kopi', 'options' => $data_kopi, 'val' => 'id', 'caption' => 'nama']])

            @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_terima', 'class' => 'form-control', 'label' => 'Tanggal Diterima']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'jumlah', 'class' => 'form-control', 'label' => 'Jumlah']])

            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'no_faktur', 'class' => 'form-control', 'label' => 'No Faktur']])

            @include('components.form.textarea', ['_data' => ['type' => 'text', 'name' => 'keterangan', 'class' => 'form-control', 'label' => 'Keterangan']])
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
