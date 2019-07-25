@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span><h4>Edit Data Admin</h4></span></div>
			</div>
			<div class="card-body">
      <form method="POST" action="{{url('adminlist/'.$data->id.'/update')}}">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-2 col-form-label">Nama</label>
					<div class="col-sm-6">
						<input type="text" name="name" class="form-control" value="{{$data->name}}">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-2 col-form-label">Number Login</label>
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
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-2 col-form-label">Role</label>
					<div class="col-sm-6">
						<select class="form-control" name="role">
							<option value="administrator" @if($data->role == 'administrator') selected @endif>Administrator</option>
							<option value="baak" @if($data->role == 'baak') selected @endif>BAAK</option>
						</select>
					</div>
				</div>
			
	      </div>
	      <div class="modal-footer">
	        <a href="{{url('/adminlist')}}" class="btn btn-secondary">Close</a>
	        <button type="submit" class="btn btn-primary">Update</button>
	      </div>
    	</form>
		</div>
	</div>
</div>

@endsection