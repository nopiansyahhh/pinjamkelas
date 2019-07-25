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
				<h4>Data Gedung</h4>
				<div class="card-header-right">	
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal1" data-backdrop="false" data-dismiss="modal">
					  Tambah Data
					</button>
				</div>
			</div>
			<div class="card-block">
				<table class="table table-hover text-center">
					<thead>
						
							<th>No</th>
							<th>Gedung</th>
							<th>Status</th>
							<th>Aksi</th>
						
					</thead>
				<?php $no=0;?>
				@foreach($data as $datas)
				<?php $no++;?>
					<tbody>
						
							<td>{{$no}}</td>
							<td>{{$datas->gedung}}</td>
							<td>{{$datas->status}}</td>
							<td><a href="{{url('datagedung/'.$datas->id.'/edit')}}" class="btn btn-success btn-sm">Edit</a>&nbsp;<a href="{{url('datagedung/'.$datas->id.'/delete')}}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus {{$datas->gedung}}?')">Hapus</a></td>
						
					</tbody>
				@endforeach
				</table>

				
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Gedung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/gedungadd')}}">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Nama Gedung</label>
					<div class="col-sm-6">
						<input type="text" name="gedung" class="form-control">
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