@extends('layouts.dosen.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span><h4>Detail Data</h4></span></div>
			</div>
			<div class="card-body">
      <form method="POST" action="{{route('dosendataupdate')}}">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-2 col-form-label">Nama</label>
					<div class="col-sm-6">
						<input type="text" name="name" class="form-control" value="{{$data->name}}">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-2 col-form-label">Login</label>
					<div class="col-sm-6">
						<input type="text" name="nim" class="form-control" value="{{$data->nim}}">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-2 col-form-label">Password</label>
					<div class="col-sm-6">
						<input type="password" name="password" class="form-control" id="password">
						<small class="form-text text-muted">kosongkan jika tidak ingin diubah</small>
					</div>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Update</button>
	      </div>
    	</form>
		</div>
	</div>
</div>
@endsection