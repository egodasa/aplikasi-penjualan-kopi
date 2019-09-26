@extends('template.layout')
@section('content')
	<h3>Reset Password</h3>
	<p>Silahkan masukkan password baru pada form dibawah ini:</p>
	<form action="" method="POST">
		<input type="hidden" value="{{ $token }}" name="token" />
		<div class="form-group">
			<label>Password Baru</label>
			<input type="password" name="password" class="form-control" />
		</div>
		<button type="submit" class="btn btn-success">Reset Password</button>
	</form>
@endsection
