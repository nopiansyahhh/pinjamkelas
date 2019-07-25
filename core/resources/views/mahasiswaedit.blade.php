@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('success'))
			<div class="alert alert-success">
				{{session('success')}}
			</div>
		@endif
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span><h4>Profile {{$data->nama}}</h4></span></div>
			</div>
			<form method="post" action="{{url('mahasiswa/'.$data->id.'/update')}}" enctype="multipart/form-data">
      		@csrf
		      <div class="card-body">
		      	<div class="row">
		      		<div class="col-md-3">
		      			<div class="card">
		      				<div class="card-body text-center">
		      					@if($data->foto != "")
		      					<img src="{{asset('foto/'.$data->foto)}}" width="200" height="250"><hr>
		      					<span><h4>{{$data->nama}}</h4></span>
		      					@else
		      					<img src="{{asset('assets/img/male.png')}}" width="200" height="250"><hr>
		      					<span><h4>{{$data->nama}}</h4></span>
		      					@endif
		      				</div>
		      			</div>
		      		</div>
		      		<div class="col-md-9">
		      			<div class="card">
		      				<div class="card-body">
		      					<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label">NIM</label>
									<div class="col-sm-6">
										
										<input type="text" name="nim" class="form-control" value="{{$data->nim}}" readonly="" id="nim">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label">Nama</label>
									<div class="col-sm-6">
										<input type="text" name="nama" class="form-control" value="{{$data->nama}}" readonly="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">Email Aktif</label>
									<div class="col-sm-6">
										<input type="email" name="email" class="form-control" value="{{$data->email}}" readonly="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">Prodi</label>
									<div class="col-sm-6">
										<select class="form-control" name="prodi" readonly="">
											<option value="SI" @if($data->prodi =="SI") selected @endif>Sistem Informasi</option>
											<option value="TI" @if($data->prodi=="TI") selected @endif>Teknik Informatika</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">semester</label>
									<div class="col-sm-6">
										<input type="text" name="semester" class="form-control" value="{{$data->semester}}" readonly="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">JK</label>
									<div class="col-sm-6">
										<select class="form-control" name="jk" readonly="">
											<option value="L" @if($data->jk == "L") selected @endif>Laki-laki</option>
											<option value="P" @if($data->jk == "P") selected @endif>Perempuan</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">Tanggal Lahir</label>
									<div class="col-sm-6">
										<input type="date" name="tanggalahir" class="form-control" value="{{$data->tanggalahir}}" readonly="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">Alamat</label>
									<div class="col-sm-6">
										<textarea name="alamat" class="form-control" readonly="">{{$data->alamat}}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">No handphone</label>
									<div class="col-sm-6">
										<input type="text" name="nohp" class="form-control" value="{{$data->nohp}}" readonly="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">Foto</label>
									<div class="col-sm-6">
										<input type="file" name="foto" class="form-control-file" value="{{$data->foto}}" readonly="">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 col-sm-offset-1 col-form-label ">Status</label>
									<div class="col-sm-6">
										<select class="form-control" name="status" readonly="">
											<option value="AKTIF" @if($data->status == "AKTIF") selected @endif>Aktif</option>
											<option value="NON AKTIF" @if($data->status == "NON AKTIF") selected @endif>Non Aktif</option>
										</select>
									</div>
								</div>
			      			</div>
			      			<div class="modal-footer">
			      				<a href="{{url('datamahasiswa')}}" class="btn btn-secondary">Close</a>
								<a href="#" id="editform" class="btn btn-primary">Edit</a>
						        <button type="submit" class="btn btn-warning" id="btnUpdate">Update</button>
			      			</div>
			      		</div>
			      	</div>
		      </div>     
    		</form>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		//$("#dataprofile").hide();
		//$(":input").hide();
		$("#btnUpdate").hide();
		$("#editform").click(function(e){
			console.log(e)
			$(":input").fadeOut("slow");
			$(":input").fadeIn("slow");
			$(":input").removeAttr("readonly");
			$("#btnUpdate").show();
			$("#editform").hide();
			//$("#nim").addAttr("readonly");
		})
	});
</script>
@endsection