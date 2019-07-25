@extends('layouts.mahasiswa.master')
@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="card bg-blue order-card">
		    <div class="card-block">
		        <h6>Total Pengajuan</h6>
		        <h2 class="text-right"><i class="fa fa-random pull-left"></i><span>{{$data->total}}</span></h2>
		        <p class="mb-0">Menunggu Konfirmasi<span class="pull-right">{{$data->pending}}</span></p>
		    </div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-green order-card">
		    <div class="card-block">
		        <h6>Pinjaman Disetujui</h6>
		        <h2 class="text-right"><i class="fa fa-check pull-left"></i><span>@if($data->disetujui == "") 0 @else {{$data->disetujui}} @endif</span></h2>
		        <p class="mb-0">&nbsp;<span class="pull-right"></span></p>
		    </div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-pink order-card">
		    <div class="card-block">
		        <h6>Pinjaman Ditolak</h6>
		        <h2 class="text-right"><i class="fa fa-close pull-left"></i><span>{{$data->ditolak}}</span></h2>
		        <p class="mb-0">&nbsp;<span class="pull-right"></span></p>
		    </div>
		</div>
	</div>
	<div class="col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h5></h5>
				<div class="card-block">
					{!! $chart->html() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection