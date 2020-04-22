@extends(Auth::user()->role == 'baak' || Auth::user()->role == 'administrator' ? 'layouts.master' : 'layouts.mahasiswa.master')
@section('content')

<div class="row">
	<div class="col-sm-12">
		@if(session('success'))
			<div class="alert alert-success">
				{{session('success')}}
			</div>
		@endif
		<div class="card">
			<div class="card-header">
				<div class="">	
					<h4 class="title">List Status Peminjaman</h4>
					<div class="card-header-right">
						<div class="form-inline">
							<form method="get" action="{{url('/statuspinjam')}}">
				                <input type="" name="statuspinjamsearch" class="form-control" placeholder="cari . . .">&nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					         
					         @if(Auth::user()->role == 'administrator' || Auth::user()->role == 'baak')
					         	<a href="{{url('export-statuspinjaman')}}" class="btn btn-warning" onclick="return confirm('anda akan mengeskport status pinjaman?')">Excel</a>
	                    	@endif
	                    	</form>
                    	</div>
                    </div>
				</div>
			</div>
			<div class="card-block" id="data">
				<table class="table table-hover">
					<thead>
						
							<th class="text-center">No</th>
							<th class="text-center">Peminjam</th>
							<th class="text-center">Ruangan</th>
							<th class="text-center">Jadwal Pinjam</th>
							<th class="text-center">Tanggal Penggunaan</th>
							<th class="text-center">Status</th>
							@if (Auth::user()->role == 'admin') <th>Aksi</th> @endif
					</thead>
					<tbody class="text-center">
						<?php //$no=0;?>
						@foreach($data as $no => $datas)
						<?php //$no++;?>
						<tr>
							<td>{{ ++$no + ($data->currentPage()-1) * $data->perPage() }}</td>
							<td>{{$datas->mahasiswa_id}}</td>
							<td>{{$datas->gedung}}.{{$datas->ruangan}}</td>
							<td>{{$datas->hari}} {{substr($datas->jamawal,0,5)}} - {{substr($datas->jamakhir,0,5)}}</td>
							<td>{{date('d-m-Y', strtotime($datas->tanggal))}}</td>
							<td>
								@if($datas->pinjamstatus == "Menunggu Konfirmasi")
								<h2><span class="badge badge-warning">{{$datas->pinjamstatus}}</span></h2>
								@elseif($datas->pinjamstatus == "DISETUJUI")
								<h2><span class="badge badge-success">{{$datas->pinjamstatus}}</span></h2>
								@else
								<h2<span class="badge badge-danger">{{$datas->pinjamstatus}}</span></h2<span>
								@endif

							</td>
							@if(Auth::user()->role=='baak' || Auth::user()->role=='administrator' )
							<td><a href="{{url('konfirmasi/'.$datas->peminjamanid.'/detail')}}" class="btn btn-primary btn-sm">Konfirmasi</a></td>
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pull-right">{{$data->appends(['statuspinjamsearch' => request('statuspinjamsearch')])->links()}}

				{{--$data->links()--}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection