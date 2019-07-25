@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span><h4>Edit Data Ruangan</h4></span></div>
			</div>
			<form method="post" action="{{url('dataruangan/'.$data->id.'/update')}}">
      		@csrf
		      <div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Pilih Gedung</label>
						<div class="col-sm-6">
							<select class="form-control" name="gedung_id">
								<option value="">--pilih Gedung--</option>
								@foreach($gedung as $gedungs)
									<option value="{{$gedungs->id}}" @if($data->gedung_id == $gedungs->id) selected @endif>{{$gedungs->gedung}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Ruangan</label>
						<div class="col-sm-6">
							<input class="form-control" name="ruangan" type="text" value="{{$data->ruangan}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Pilih Hari/Tanggal</label>
						<div class="col-sm-6">
							<!--<input class="form-control" name="hari" type="date">-->
							<select class="form-control" name="hari">
								<option>--pilih hari--</option>
								@foreach($hari as $haris)
									<option value="{{$haris}}" @if($data->hari == $haris) selected @endif>{{$haris}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Jam Mulai</label>
						<div class="col-sm-6">
							<input class="form-control" name="jamawal" type="time" value="{{$data->jamawal}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Jam Selesai</label>
						<div class="col-sm-6">
							<input class="form-control" name="jamakhir" type="time" value="{{$data->jamakhir}}">
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
		      						
					<a href="{{url('dataruangan')}}" class="btn btn-secondary">Close</a>
		        	<button type="submit" class="btn btn-warning">Update</button>
				
		      </div>
    		</form>
		</div>
	</div>
</div>
@endsection