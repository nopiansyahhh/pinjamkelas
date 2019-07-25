@extends(Auth::user()->role == 'baak' || Auth::user()->role == 'administrator' ? 'layouts.master' : 'layouts.mahasiswa.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('danger'))
				<div class="alert alert-danger">
					<ul><li>{{session('danger')}}</li></ul>
				</div>
			@endif
		<div class="card">
			<div class="card-header">
			@foreach($data as $datas)
				<div class="title"><span><h4>Pinjam Ruang Kelas {{$datas->ruangan}}</h4></span></div>
			</div>
			
			<form method="post" action="{{url('pinjamkelas/'.$datas->ruanganid.'/bookingadd')}}">
      		@csrf
		      <div class="card-block">
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
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Hari Pinjam</label>
						<div class="col-sm-6">
							<span>{{$datas->hari}}</span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Jam Mulai</label>
						<div class="col-sm-6">
							<span>{{substr($datas->jamawal,0,5)}}</span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Jam Selesai</label>
						<div class="col-sm-6">
							<span>{{substr($datas->jamakhir,0,5)}}</span>
						</div>
					</div>
				@if(Auth::user()->role == 'baak' || Auth::user()->role == 'administrator' )
		      		<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Masukkan NIM</label>
						<div class="col-sm-6">
							<input class="form-control" name="nim" type="text">
						</div>
					</div>
				@endif
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Tanggal Penggunaan</label>
						<div class="col-sm-6">
							<input class="form-control" name="tanggal" type="date">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-sm-offset-2 col-form-label">Alasan Pinjam</label>
						<div class="col-sm-6">
							<textarea class="form-control" name="ket" rows="4"></textarea>
						</div>
					</div>
		      </div>     
		      <div class="modal-footer">
						<a href="{{url('pinjamkelas')}}" class="btn btn-danger">Keluar</a>
			        	<button type="submit" class="btn btn-success">Pinjam</button>
			  </div>
    		</form>
    		@endforeach
		</div>
	</div>
</div>
@endsection