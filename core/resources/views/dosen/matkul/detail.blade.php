@extends('layouts.dosen.master')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="">	
					<h4 class="title">Detail</h4>
				</div>
            </div>
		 <div class="card-body">
          <div class="card-block" id="data">
            <br>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-6">
                        <span>{{$data2->nmatkul}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Jadwal</label>
                    <div class="col-sm-6">
                        <span>{{$data2->hari}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Pukul</label>
                    <div class="col-sm-6">
                        <span>{{substr($data2->jam_mulai,0,5)}}</span>&nbsp;-&nbsp;<span>{{substr($data2->jam_selesai,0,5)}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">SKS</label>
                    <div class="col-sm-6">
                        <span>{{$data2->sks}}</span>
                    </div>
                </div>                        
            <br><br><hr>
            <table class="table table-hover text-center">
                <thead>
                    
                        <th class="text-center">No</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th></th>
                </thead>
                <tbody>
                    <?php $no = 1?>
                    @foreach ($data as $item)
                    <?php $no +1 ?>
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->nim}}</td>
                            <td>{{$item->nama}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
		</div>
	</div>
</div>

@endsection