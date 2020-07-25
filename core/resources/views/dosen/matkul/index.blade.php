@extends('layouts.dosen.master')

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
				<h4>Jadwal Matkul</h4>
				<div class="card-header-right">	
					<!-- Button trigger modal -->
				</div>
			</div>
			<div class="card-block">
				<table class="table table-hover text-center">
					<thead>
						
							<th>No</th>
							<th>Matkul</th>
                            <th>SKS</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
							<th>Jumlah Mahasiswa</th>
						
					</thead>
				<?php $no=0;?>
				@foreach($data as $datas)
				<?php $no++;?>
					<tbody>
						
							<td>{{$no}}</td>
							<td><a href="{{route('detailmatkul',$datas->id)}}">{{$datas->nama}}</a></td>
							<td>{{$datas->sks}}</td>
                            <td>{{$datas->hari}}</td>
                            <td>{{$datas->jam_mulai}}</td>
                            <td>{{$datas->jam_selesai}}</td>
                            <td>{{$datas->jmlmahasiswa}}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Matkul</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{url('/matkuladd')}}">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Nama Matkul</label>
					<div class="col-sm-6">
						<input type="text" name="nama" class="form-control">
					</div>
                </div>
                <div class="form-group row">
					<label class="col-sm-4 col-form-label">SKS</label>
					<div class="col-sm-6">
						<input type="text" name="sks" class="form-control">
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