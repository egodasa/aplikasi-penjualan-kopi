<div class="modal fade hide-modal" id="modal-konfirmasi-pembayaran">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="judul_modal">Konfirmasi Pembayaran</h4>
    </div>
    <div class="modal-body">
      <form method="POST" action="{{ site_url('konfirmasi-pembayaran') }}" enctype='multipart/form-data'>
        <input type="hidden" name="id_pesan" />
        @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_bayar', 'class' => 'form-control', 'label' => 'Tanggal Bayar']])
        @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'total_bayar', 'class' => 'form-control', 'label' => 'Jumlah Yang Harus Dibayar', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'jumlah_bayar', 'class' => 'form-control', 'label' => 'Jumlah Bayar']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama_bank', 'class' => 'form-control', 'label' => 'Nama Bank (Pembayar)']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'norek', 'class' => 'form-control', 'label' => 'Nomor Rekening (Pembayar)']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'bank_tujuan', 'class' => 'form-control', 'value' => 'BNI', 'label' => 'Bank Tujuan (Solok Radja)']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'norek_tujuan', 'class' => 'form-control', 'value' => '0606841492', 'label' => 'Nomor Rekening Tujuan (Solok Radja)']])
        @include('components.form.input', ['_data' => ['type' => 'file', 'name' => 'bukti_bayar', 'class' => 'form-control', 'label' => 'Bukti Pembayaran']])
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-danger">Konfirmasi Pembayaran</button>
    </div>
    </form>
  </div>
</div>
</div>
