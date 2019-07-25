@extends(Auth::user()->role == 'admin' ? 'layouts.master' : 'layouts.mahasiswa.master')
@section('content')

<div class="row">
	<div class="col-sm-12 col-md-12">
		@if(session('success'))
			<div class="alert alert-success">
				{{session('success')}}
			</div>
		@endif
		<div class="card">
			<div class="card-header">
				<h4>Riwayat Pinjam Kelas</h4>
				<div class="card-header-right">
					<div class="form-inline">
						<form method="get" action="{{url('/riwayatpinjaman')}}">
		                <input type="" name="riwayatcari" class="form-control" placeholder="cari . . .">&nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
		            	</form>
		            </div>
	            </div>
            </div>
			<div class="card-block">
				@foreach($data as $datas)
				<div class="card list-view-mt-10">
					<div class="card-block">
						<!-- status -->
						@if($datas->pinjamstatus == "Menunggu Konfirmasi")
						<span class="badge badge-warning">{{$datas->pinjamstatus}}</span>
						@elseif($datas->pinjamstatus == "DISETUJUI")
						<span class="badge badge-success">{{$datas->pinjamstatus}}</span>
						@else
						<span class="badge badge-danger">{{$datas->pinjamstatus}}</span>
						@endif			
						<div class="media-body">
							<div class="heading">
								<h5>Ruangan {{$datas->ruangan}}</h5>
								<h6>Tanggal Penggunaan: {{date('d-m-Y', strtotime($datas->tanggal))}} | Jadwal Kelas: {{$datas->hari}}, {{substr($datas->jamawal,0,5)}} - {{substr($datas->jamakhir,0,5)}}</h6>
							</div>
							<p>Alasan Pinjam: {{$datas->ket}}<hr></p>
							<p>Tanggapan Baak: <span class="badge badge-primary">{{$datas->kettolak}}</span></p>
						</div>
					</div>
				</div>
				@endforeach
			<div class="pull-right">{{$data->links()}}</div>
			</div>

		</div>
	</div>
</div>
@endsection