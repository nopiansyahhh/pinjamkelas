@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			@foreach($data as $datas)
				<div class="card-title"><span><h4>Konfirmasi Ruangan {{$datas->ruangan}}</h4></span></div>
			</div>
			
			<form method="post" action="{{url('konfirmasi/'.$datas->id.'/update')}}">
      		@csrf
		      <div class="modal-body">
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Gedung</label>
						<div class="col-sm-6">
							<span>{{$datas->gedung}}</span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Ruangan</label>
						<div class="col-sm-6">
							<span>{{$datas->ruangan}}</span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Hari / Jam Pinjam</label>
						<div class="col-sm-6">
							<span>{{$datas->hari}} </span><span>{{substr($datas->jamawal,0,5)}} - </span><span>{{substr($datas->jamakhir,0,5)}}</span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Tanggal Penggunaan Kelas</label>
						<div class="col-sm-6">
							<span>{{$datas->tanggal}}</span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Alasan Pinjam</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="ket" readonly="">{{$datas->ket}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Status</label>
						<div class="col-sm-6">
							<select class="form-control" name="status">
								<option value="Menunggu Konfirmasi">---</option>
								<option value="DISETUJUI" @if($datas->status == 'DISETUJUI') selected @endif>DISETUJUI</option>
								<option value="DITOLAK" @if($datas->status == 'DITOLAK') selected @endif>DITOLAK</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Tanggapan</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="kettolak">{{$datas->kettolak}}</textarea>
						</div>
					</div>
		      </div>     
		      <div class="modal-footer">
		      		<a href="{{url('/statuspinjam')}}" class="btn btn-secondary">Close</a>
		        	<button type="submit" class="btn btn-warning">Update</button>
		      </div>
    		</form>
    		@endforeach
		</div>
	</div>
</div>

@endsection