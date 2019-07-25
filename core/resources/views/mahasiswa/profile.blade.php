@extends('layouts.mahasiswa.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		@if(session('success'))
			<div class="alert alert-success">
				{{session('success')}}
			</div>
		@endif
		<div class="card">
			<div class="card-block">
				<h4 class="title">Profile {{$data->nama}}</h4>
			</div>
			<form method="post" action="{{url('mahasiswa/'.$data->id.'/update')}}" enctype="multipart/form-data">
      		@csrf
		      <div class="card">
		      	<div class="row">
		      		<div class="col-md-4">
		      			<div class="card-block">
		      				<div class="text-center">
		      					<img src="{{asset('foto/'.$data->foto)}}" width="200" height="250" class=""><hr>
		      					<span><h4>{{$data->nama}}</h4></span>
		      				</div>
		      			</div>
		      		</div>
		      		<div class="col-md-8">
		      			<div class="card">
		      				<div class="card-block">
		      					<div class="form-group row">
									<label class="col-sm-3 col-form-label ">Status</label>
									<div class="col-sm-7">
										<span class="text-green">{{$data->status}}</span>
									</div>
								</div>
			      				<div class="form-group row">
											<label class="col-sm-3 col-form-label">NIM</label>
											<div class="col-sm-7">
												<label class="col-form-label">{{$data->nim}}</label>
												<input type="hidden" name="nim" value="{{$data->nim}}" id="nim">
											</div>
										</div>
										<div class="form-group row">
										<label class="col-sm-3 col-form-label ">Prodi</label>
										<div class="col-sm-7">
											<label class="col-form-label">{{$data->prodi}}</label>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">semester</label>
										<div class="col-sm-7">
											<span>{{$data->semester}}</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">Nama</label>
										<div class="col-sm-7">
											<input type="text" name="nama" class="form-control" value="{{$data->nama}}" readonly="" id="readonly">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">Email Aktif</label>
										<div class="col-sm-7">
											<input type="email" name="email" class="form-control" value="{{$data->email}}" readonly="" id="readonly">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">JK</label>
										<div class="col-sm-7">
											<select class="form-control" name="jk" readonly="" id="readonly" disabled="">
												<option value="L" @if($data->jk == "L") selected @endif>Laki-laki</option>
												<option value="P" @if($data->jk == "P") selected @endif>Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">Tanggal Lahir</label>
										<div class="col-sm-7">
											<input type="date" name="tanggalahir" class="form-control" value="{{$data->tanggalahir}}" readonly="" id="tanggal">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">Alamat</label>
										<div class="col-sm-7">
											<textarea name="alamat" class="form-control" readonly="" id="readonly">{{$data->alamat}}</textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">No handphone</label>
										<div class="col-sm-7">
											<input type="text" name="nohp" class="form-control" value="{{$data->nohp}}" readonly="" id="readonly">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label ">Foto</label>
										<div class="col-sm-7">
											<input type="file" name="foto" class="form-control-file" value="{{$data->foto}}" readonly="" id="readonly">
										</div>
									</div>
									<div class="modal-footer">
										<a href="#" class="btn btn-secondary">Close</a>
										<a href="#" id="editform" class="btn btn-primary">Edit</a>
								        <button type="submit" class="btn btn-warning" id="btnUpdate">Update</button>
							        </div>
				      			</div>
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
		$('#nim').hide();
		$("#btnUpdate").hide();
		$("#editform").click(function(e){
			console.log(e)
			$(":input").fadeOut("slow");
			$(":input").fadeIn("slow");
			$(":input").removeAttr("readonly");
			$(":input").removeAttr("disabled");
			$("#btnUpdate").show();
			$("#editform").hide();
			//$("#nim").addAttr("readonly");
		})
	});
</script>
@endsection