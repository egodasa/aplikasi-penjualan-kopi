<div class="modal fade hide-modal" id="lupa-password">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="lupa-pass">Lupa Password</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ site_url('lupa-password') }}">
          	<div class="form-group">
          		<label>Masukkan email akun Anda</label>
          		<input type="email" class="form-control" name="email" />
          	</div>
          	<button type="submit" class="btn btn-danger">Reset Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>