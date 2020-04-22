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
					<label class="col-form-label col-sm-6"><h4>Data Mahasiswa</h4></label>
						<div class="col-sm-6 text-right">
							<div class="form-inline">
								<form method="get" action="{{url('/datamahasiswa')}}">
				                	<input type="" name="mahasiswacari" class="form-control" placeholder="cari . . .">&nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
				            		
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal1">
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
							<th>NIM</th>
							<th>Nama</th>
							<th>Prodi</th>
							<th>Semester</th>
							<th>Status</th>
							<th>Aksi</th>
						
					</thead>
				
				@foreach($data as $datas)
				
					<tbody>
				
							<td>{{$datas->row}}</td>
							<td>{{$datas->nim}}</td>
							<td>{{$datas->nama}}</td>
							<td>{{$datas->prodi}}</td>
							<td>{{$datas->semester}}</td>
							<td>{{$datas->status}}</td>
							<td><a href="{{url('mahasiswa/'.$datas->id.'/profile')}}" class="btn btn-success btn-sm">Edit</a>&nbsp;<a href="{{url('datamahasiswa/'.$datas->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda yakin menghapus data {{$datas->nama}}?')">Hapus</a></td>
						
				
					</tbody>
					@endforeach
				</table>

				
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/mahasiswaadd')}}" enctype="multipart/form-data">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">NIM</label>
					<div class="col-sm-5">
						<input type="text" name="nip" class="form-control" value="0{{$countnim}}" readonly="">
						<small class="form-text text-muted">Secara Default digunakan sebagai password mahasiswa</small>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Nama</label>
					<div class="col-sm-5">
						<input type="text" name="name" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Email Aktif</label>
					<div class="col-sm-5">
						<input type="text" name="email" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Prodi</label>
					<div class="col-sm-5">
						<select class="form-control" name="prodi">
							<option value="SI">Sistem Informasi</option>
							<option value="TI">Teknik Informatika</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">semester</label>
					<div class="col-sm-5">
						<input type="text" name="semester" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">JK</label>
					<div class="col-sm-5">
						<select class="form-control" name="jk">
							<option value="L">Laki-laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-5">
						<input type="date" name="tanggalahir" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Alamat</label>
					<div class="col-sm-5">
						<input type="text" name="alamat" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">No handphone</label>
					<div class="col-sm-5">
						<input type="text" name="nohp" class="form-control">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Foto</label>
					<div class="col-sm-5">
						<input type="file" name="foto" class="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-sm-offset-3 col-form-label">Status</label>
					<div class="col-sm-5">
						<select class="form-control" name="status">
							<option value="AKTIF">Aktif</option>
							<option value="NON AKTIF">Non Aktif</option>
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