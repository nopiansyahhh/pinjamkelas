@extends('layouts.dosen.master')

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
				<div class="">	
					<h4 class="title">Daftar Kehadiran Dosen</h4>
					<div class="card-header-right">
						<div class="form-inline">
							<form method="GET" action="{{url('dosenabsendetail')}}">
                                <label for="">Mata Kuliah</label>
                                <select name="smatkul" id="" class="form-control">
                                    <option value="">---pilih Matkul---</option>
                                    @foreach ($matkul as $item)
                                        <option value="{{$item->matid}}" @if ($item->matid == $smatkul) selected @endif>{{$item->nmatkul}}</option>
                                    @endforeach
                                </select>&nbsp;&nbsp;&nbsp;
                                <button class="btn" type="submit"><i class="fa fa-search"></i></button>
	                    	</form>
                    	</div>
                    </div>
				</div>
            </div>
		 <div class="card-body">
            <div class="card-block" id="data">
                @if ($data != NULL)
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-6">
                        <span>{{$data2->nama}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Jadwal</label>
                    <div class="col-sm-6">
                        <span>{{$data2->hari}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Jumlah SKS</label>
                    <div class="col-sm-6">
                        <span>{{$data2->sks}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Jam Mulai</label>
                    <div class="col-sm-6">
                        <span>{{$data2->jam_mulai}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Jam Selesai</label>
                    <div class="col-sm-6">
                        <span>{{$data2->jam_selesai}}</span>
                    </div>
                </div>
                <br><br>
                @endif
                <table class="table table-hover text-center">
                    <thead>
                        
                            <th class="text-center">No</th>
                            <th class="text-center">tanggal</th>
                            <th class="text-center">Status Absen</th>
                            <th class="text-center">Topik</th>
                            <th></th>
                    </thead>
                    <tbody>
                    @if ($data == NULL)
                        <tr class="text-center">
                            <td colspan="7">Silahkan Pilih Matkul terlebih dahulu</td>
                        </tr>
                    @else
                        <?php $no=0?>
                        @foreach ($data as $item)
                        <form action="{{route('statushadir')}}" method="POST">
                            @csrf
                        <?php $no++?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$item->dosen_tanggal_absen}}</td>
                                    <td>{{$item->dosen_status_absen != "" ? strtoupper($item->dosen_status_absen) : "Belum Absen"}}</td>
                                    <td>{{$item->topik}}</td>
                                </tr>
                            
                        @endforeach
                        </form>
                    @endif
                    </tbody>
                </table>
            </div>
          </div>
		</div>
	</div>
</div>
@endsection