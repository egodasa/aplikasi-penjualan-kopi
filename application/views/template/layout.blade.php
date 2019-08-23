<!DOCTYPE html>
<html lang="en">
@include('template.head', ['judul' => 'Koperasi Serba Usaha Solok Radja'])
	<body>
		<div class="navbar navbar-default yamm" role="navigation" id="navbar">
			<div class="container">
		@include('template.navbar')
			</div>
		</div>
		<div id="all">
			<div id="content">
				<div class="container">
          <div class="box">
            <div class="box-body">
            <!-- CONTENT -->
						@yield('content')
					<!-- EOF CONTENT -->
            </div>     
          </div>
					
					
				</div>
		@include('template.footer-atas')
		@include('template.footer-bawah')
			</div>
		</div>
		@include('template.javascript')
    <script src="{{ base_url() }}assets/js/pnotify/pnotify.js"></script>
    <script src="{{ base_url() }}assets/js/pnotify/pnotify.buttons.js"></script>
    <script src="{{ base_url() }}assets/js/pnotify/pnotify.nonblock.js"></script>
    <script>
      $('.table').DataTable();
      function elId(id)
      {
        return document.getElementById(id);
      }
      function elName(name)
      {
        return document.getElementsByName(name);
      }
      function showModal(id)
      {
        $(id).modal("show");
      }
      function hideModal(id)
      {
        $(id).modal("hide");
      }
      function showConfirmationDelete(url)
      {
        document.getElementById("url_hapus").href = url;
        showModal('#modal_hapus');
      }
    </script>
    
    @section('script')
      <!-- Custom Script -->
    @show
    
    <script>
      $('.table').DataTable();
    </script>
    
    {{ showNotifikasi() }}
    
    <!-- modal untuk peringatan hapus -->
    <div class="modal fade hide-modal" id="modal_hapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Peringatan!</h4>
        </div>
        <div class="modal-body">
          <h5>Apakah Anda yakin untuk menghapus data ini?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="hideModal('#modal_hapus')">Batal</button>
          <a id="url_hapus" href="" class="btn btn-danger">Hapus Data</a>
        </div>
      </div>
    </div>
  </div>
    <div class="modal fade hide-modal" id="modal-login">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Login Pengguna</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ site_url('login') }}">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'username', 'class' => 'form-control', 'max' => 20, 'label' => 'Username']])
            @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password', 'class' => 'form-control', 'max' => 50, 'label' => 'Password']])
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    <div class="modal fade hide-modal" id="modal-registrasi">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="judul_modal">Registrasi User Baru</h4>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ site_url('registrasi') }}">
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'username', 'class' => 'form-control', 'max' => 20, 'label' => 'Username']])
            @include('components.form.input', ['_data' => ['type' => 'password', 'name' => 'password', 'class' => 'form-control', 'max' => 50, 'label' => 'Password']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'nama', 'class' => 'form-control', 'max' => 50, 'label' => 'Nama Lengkap']])
            @include('components.form.input', ['_data' => ['type' => 'email', 'name' => 'email', 'class' => 'form-control', 'max' => 50, 'label' => 'Email']])
            @include('components.form.input', ['_data' => ['type' => 'text', 'name' => 'telepon', 'class' => 'form-control', 'max' => 15, 'label' => 'No Telpon/No HP']])
            <input type="hidden" name="akses_level" value="Member">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Registrasi</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @yield('script')
	</body>
</html>
