@extends('layouts.master')

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
					<label class="col-form-label col-sm-6"><h4>Data Ruangan</h4></label>
						<div class="col-sm-6 text-right">
							<div class="form-inline">
							<!-- Button trigger modal -->
								<form method="get" action="{{url('/dataruangan')}}">
					                <input type="" name="ruangansearch" class="form-control" placeholder="cari . . .">&nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					            	
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
									  Tambah Data
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-block table-responsive">
				<table class="table table-hover text-center">
					<thead>
						
							<th>No</th>
							<th>Gedung</th>
							<th>Ruangan</th>
							<th>Hari</th>
							<th>Jam Mulai</th>
							<th>Jam Selesai</th>
							<th>Status</th>
							<th>Aksi</th>
					</thead>
				
					<tbody>
						<?php $no=0?>
						@foreach($data as $datas)
						<?php $no++?>
						<tr>
							<td>{{$no}}</td>
							<td>{{$datas->gedung}}</td>
							<td>{{$datas->ruangan}}</td>
							<td>{{$datas->hari}}</td>
							<td>{{substr($datas->jamawal,0,5)}}</td>
							<td>{{substr($datas->jamakhir,0,5)}}</td>
							<td>{{$datas->status}}</td>
							<td><a href="{{url('dataruangan/'.$datas->ruanganid.'/edit')}}" class="btn btn-success btn-sm">Edit</a>&nbsp;<a href="{{url('dataruangan/'.$datas->ruanganid.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a></td>
						</tr>
						@endforeach
					</tbody>
				
				</table>
				<div class="pull-right">{{$data->links()}}</div>
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
						<select class="form-control" name="gedung_id" required="">
							<option value="">--pilih Gedung--</option>
							@foreach($gedung as $gedungs)
								<option value="{{$gedungs->id}}">{{$gedungs->gedung}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Ruangan</label>
					<div class="col-sm-6">
						<input class="form-control" name="ruangan" type="text" required="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Pilih Hari/Tanggal</label>
					<div class="col-sm-6">
						<!--<input class="form-control" name="hari" type="date">-->
						<select class="form-control" name="hari" required="">
							<option>--pilih hari--</option>
							@foreach($hari as $haris)
								<option value="{{$haris}}">{{$haris}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group row {{$errors->has('jamawal') ? 'has-error' :''}}">
					<label class="col-sm-4 col-form-label">Jam Mulai</label>
					<div class="col-sm-6">
						<input class="form-control" name="jamawal" type="time" value="{{old('jamawal')}}" required="">
						@if($errors->has('jamawal'))
					    	<span class="help-block">{{$errors->first('jamawal')}}</span>
					    @endif
					</div>
				</div>
				<div class="form-group row {{$errors->has('jamakhir') ? 'has-error' :''}}">
					<label class="col-sm-4 col-form-label">Jam Selesai</label>
					<div class="col-sm-6">
						<input class="form-control" name="jamakhir" type="time" value="{{old('jamakhir')}}" required="">
					</div>
					@if($errors->has('jamawal'))
				    	<span class="help-block">{{$errors->first('jamakhir')}}</span>
				    @endif
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