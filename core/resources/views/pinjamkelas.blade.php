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
				<div class="card-title">
					<div class="form-group row">
					<label class="col-sm-6"><h4>List Ruang Kelas Tersedia</h4></label>
						<div class="col-sm-6 text-right">
							<div class="form-inline">
								<form method="get" action="{{url('/pinjamkelas')}}">
					                <input type="" name="pinjamsearch" class="form-control" placeholder="cari . . .">&nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
									@if(Auth::user()->role == 'baak' || Auth::user()->role == 'administrator')
										
										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
										  Tambah Data
										</button>
									
									@endif
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-block" id="data">
				<table class="table table-hover text-center">
					<thead>
						
							<th class="text-center">No</th>
							<th class="text-center">Gedung</th>
							<th class="text-center">Ruangan</th>
							<th class="text-center">Jadwal</th>
							<th class="text-center">Status</th>
							<th></th>
					</thead>
				
					<tbody>
						<?php $no=0?>
						@foreach($data as $datas)
						<?php $no++?>
						<tr>
							<td>{{$no}}</td>
							<td>{{$datas->gedung}}</td>
							<td>{{$datas->ruangan}}</td>
							<td><span class="uppercase">{{$datas->hari}}</span> {{substr($datas->jamawal,0,5)}} -  {{substr($datas->jamakhir,0,5)}}</td>
							<td>
								@if ($datas->status == "Aktif")
								<span class="text text-success"><i class="fa fa-check-circle-o"></i> Tersedia</span> 
								@else
								<span class="text text-muted"><i class="fa fa-ban"></i> Tidak Tersedia</span>
								@endif
							</td>
							<td>
								@if ($datas->status == "Aktif")
								<a href="{{url('pinjamkelas/'.$datas->ruanganid.'/booking')}}" class="btn btn-success btn-sm">Pinjam</a>
								@else
								<button class="btn btn-secondary btn-sm" disabled="">Pinjam</button>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>				
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Gedung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{url('dataruangan/add')}}">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Pilih Gedung</label>
					<div class="col-sm-6">
						<select class="form-control" name="gedung_id">
							<option>--pilih Gedung--</option>
							@foreach($gedung as $gedungs)
								<option value="{{$gedungs->id}}">{{$gedungs->gedung}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Ruangan</label>
					<div class="col-sm-6">
						<input class="form-control" name="ruangan" type="text">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Pilih Hari/Tanggal</label>
					<div class="col-sm-6">
						<!--<input class="form-control" name="hari" type="date">-->
						<select class="form-control" name="hari">
							<option>--pilih hari--</option>
							@foreach($hari as $haris)
								<option value="{{$haris}}">{{$haris}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Jam Mulai</label>
					<div class="col-sm-6">
						<input class="form-control" name="jamawal" type="time">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Jam Selesai</label>
					<div class="col-sm-6">
						<input class="form-control" name="jamakhir" type="time">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Status</label>
					<div class="col-sm-6">
						<select class="form-control" name="status">
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif">Non Aktif</option>
						</select>
					</div>
				</div>
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
    	</form>
    </div>
  </div>
</div>
@endsection