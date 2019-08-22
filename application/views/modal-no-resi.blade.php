<div class="modal fade hide-modal" id="modal-update-no-resi">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
      </button>
      <h4 class="modal-title" id="judul_modal">Tambahkan Nomor Resi Pengiriman</h4>
    </div>
    <div class="modal-body">
      <form method="POST" action="{{ site_url('update-no-resi') }}">
        <input type="hidden" name="id" />
        @include('components.form.input', ['_data' => ['type' => 'date', 'name' => 'noresi', 'class' => 'form-control', 'label' => 'Nomor Resi']])
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-danger">Simpan</button>
    </div>
    </form>
  </div>
</div>
</div>
