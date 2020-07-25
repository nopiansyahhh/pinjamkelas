@extends('layouts.mahasiswa.master')
@section('content')

<div class="row">
	<div class="col-md-4">
		<div class="card bg-blue order-card">
		    <div class="card-block">
		        <h6>TOTAL ABSEN</h6>
		        <h2 class="text-right"><i class="fa fa-random pull-left"></i><span>{{$data->total}}</span></h2>
		        <p class="mb-0">Belum Absen<span class="pull-right">{{$data->belumabsen}}</span></p>
		    </div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-green order-card">
		    <div class="card-block">
		        <h6>HADIR</h6>
		        <h2 class="text-right"><i class="fa fa-check pull-left"></i><span>{{$data->hadir}}</span></h2>
		        <p class="mb-0">Sakit<span class="pull-right">{{$data->sakit}}</span></p>
		    </div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card bg-pink order-card">
		    <div class="card-block">
		        <h6>MANGKIR</h6>
		        <h2 class="text-right"><i class="fa fa-close pull-left"></i><span>{{$data->mangkir}}</span></h2>
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