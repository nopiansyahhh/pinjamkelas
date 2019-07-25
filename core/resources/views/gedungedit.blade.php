@extends('layouts.master')
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span><h4>Edit Data Gedung</h4></span></div>
			</div>
			<div class="card-body">
				<form method="post" action="{{url('datagedung/'.$data->id.'/update')}}">
					@csrf
				<div class="form-group row">
					<label class="col-sm-3 col-sm-offset-2 col-form-label">Nama Gedung</label>
					<div class="col-sm-6">
						<input type="text" name="gedung" class="form-control" value="{{$data->gedung}}">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-sm-offset-2 col-form-label">Status</label>
					<div class="col-sm-6">
						<select class="form-control" name="status">
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif" @if($data->status == 'Non Aktif') selected @endif>Non Aktif</option>
						</select>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<a href="{{url('datagedung')}}" class="btn btn-secondary">Close</a>
	        	<button type="submit" class="btn btn-primary">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>

@endsection