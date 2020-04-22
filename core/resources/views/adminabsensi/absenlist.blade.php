@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><span><h4>Data Absen</h4></span></div>
			</div>
			<div class="card-body">
	      <div class="modal-body">
            <form method="GET" action="{{url('dataabsen')}}">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-4">
                        <select name="dosen" id="" class="form-control">
                            <option value="">---pilih Dosen---</option>
                            @foreach ($datadosen as $item)
                                <option value="{{$item->nim}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-2 col-form-label">Matkul</label>
                    <div class="col-sm-4">
                        <select name="matkul" id="" class="form-control">
                            <option value="1">---pilih Matkul---</option>
                            @foreach ($datamatkul as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @endforeach
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4">
                        <input type="date" name="tanggal" class="form-control" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <span class="col-sm-7"></span>
                    <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>           
        </div>
        <input type="text" name="tanggal" class="form-control" value="">
          <div class="card-block" id="data">
            <table class="table table-hover text-center">
                <thead>
                    
                        <th class="text-center">No</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Absensi</th>
                        <th class="text-center">TapIn</th>
                        <th class="text-center">TapOut</th>
                        <th class="text-center">Status</th>
                        <th></th>
                </thead>
            
                <tbody>
                </tbody>
            </table>
          </div>
	      <div class="modal-footer">
	        <a href="" class="btn btn-secondary">Close</a>
	        <button type="submit" class="btn btn-primary">Update</button>
	      </div>
		</div>
	</div>
</div>

@endsection