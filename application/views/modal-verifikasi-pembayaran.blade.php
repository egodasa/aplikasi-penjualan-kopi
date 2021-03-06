<div class="modal fade hide-modal" id="modal-verifikasi-pembayaran">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="judul_modal">Verifikasi Pembayaran</h4>
    </div>
    <div class="modal-body">
      <form method="POST" action="{{ site_url('verifikasi-pembayaran') }}">
        <input type="hidden" name="id" />
        <input type="hidden" name="id_pembayaran" />
        @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'tgl_bayar', 'class' => 'form-control', 'label' => 'Tanggal Bayar', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'total_bayar', 'class' => 'form-control', 'label' => 'Jumlah Yang Harus Dibayar', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'number', 'name' => 'jumlah_bayar', 'class' => 'form-control', 'label' => 'Jumlah Bayar', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama_bank', 'class' => 'form-control', 'label' => 'Nama Bank (Pembayar)', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'norek', 'class' => 'form-control', 'label' => 'Nomor Rekening (Pembayar)', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'bank_tujuan', 'class' => 'form-control', 'label' => 'Bank Tujuan (Solok Radja)', 'readonly' => 'true']])
        @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'norek_tujuan', 'class' => 'form-control', 'label' => 'Nomor Rekening Tujuan (Solok Radja)', 'readonly' => 'true']])
        <div class="form-group">
          <label>Foto Bukti Pembayaran</label>
          <p>
            <a href="#" name="foto_bukti">
              <img src="#" name="foto_bukti" width="300" height="500" class="img-responsive" />
            </a>
          </p>
        </div>
        @include('components.form.select', ['_data' => ['name' => 'status_bayar', 'class' => 'form-control', 'label' => 'Status Pembayaran', 'val' => 'val', 'caption' => 'val', 'options' => [['val' => 'Diterima'], ['val' => 'Ditolak']]]])
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-danger">Verifikasi Pembayaran</button>
    </div>
    </form>
  </div>
</div>
</div>
