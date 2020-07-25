@extends('layouts.mahasiswa.master')
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
				<div class="">	
					<h4 class="title">Absensi</h4>
					<div class="card-header-right">
						<div class="form-inline">
							<form method="get" action="">
                                <select name="smatkul" id="" class="form-control">
                                    <option value="">---pilih Matkul---</option>
                                    @foreach ($matkul as $item)
                                        <option value="{{$item->matid}}" @if ($item->matid == $smatkul) selected @endif>{{$item->nmatkul}}</option>
                                    @endforeach
                                </select>
				                &nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
	                    	</form>
                    	</div>
                    </div>
				</div>
            </div>
            
            <div class="card-block" id="data"><br>
                @if ($data2 != NULL)
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Mata Kuliah</label>
                        <div class="col-sm-6">
                            <span>{{$data2->nmatkul}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Dosen</label>
                        <div class="col-sm-6">
                            <span>{{$data2->namadosenya}}</span>
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
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Tanggal Hari Ini</label>
                        <div class="col-sm-6">
                            <span>{{date('Y-m-d')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Generate Token Tap</label>
                        <div class="col-sm-3">
                            <span>@if($data2->status_generate==0) DISABLE @else AKTIF @endif</span> 
                        </div>
                    </div>
                    @if($data2->status_generate == 1)
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Generate Tap In</label>
                        <form action="{{route('absentokenin',$data2->matkulid)}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$data2->dosenid}}" name="dosen">
                            <div class="col-sm-4">                         
                                <input type="text" value="{{old('gentapin')}}" class="form-control" name="gentapin">
                                @if(session('error'))
                                    <div class="" role="">
                                        <span class="badge badge-danger">{{session('error')}}</span>
                                    </div>
                                @endif
                                <small class="text-muted">Harap Menghubungi dosen untuk mendapatkan kode TapOut</small>
                            </div>
                            <div><button class="btn btn-success">Tap In</button></div>
                        </form>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Generate Tap Out</label>
                        <form action="{{route('absentokenout',$data2->matkulid)}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$data2->dosenid}}" name="dosen">
                            <div class="col-sm-4">    
                                    <input type="text" value="{{old('gentapout')}}" class="form-control" name="gentapout">
                                    @if(session('errorr'))
                                    <div class="" role="">
                                        <span class="badge badge-danger">{{session('errorr')}}</span>
                                    </div>
                                @endif
                                    <small class="text-muted">Harap Menghubungi dosen untuk mendapatkan kode TapOut</small>
                            </div>
                            <div><button class="btn btn-success">Tap Out</button></div>
                        </form>
                    </div>
                @endif
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Absen / Tap</label>
                        <div class="col-sm-6">
                            <div class="col-sm-3">
                                @if($data2->statusbtntap == 1 || $data2->statusbtntap == 3)
                                    <form action="{{route('tapin',['smatkul'=>$smatkul])}}" method="post">
                                    @csrf    
                                        <button class="btn btn-success">Tap In</button>
                                        <input type="hidden" value="{{$data2->dosenid}}" name="dosen">
                                    </form>
                                @else
                                    <button class="btn btn-default" disabled>Tap In</button>
                                @endif
                            </div>
                            
                            <div class="col-sm-3">    
                                @if($data2->statusbtntap == 2 || $data2->statusbtntap == 3)
                                    <form action="{{route('tapout',['smatkul'=>$smatkul])}}" method="post">
                                        @csrf    
                                        <button class="btn btn-success">Tap Out</button>
                                        <input type="hidden" value="{{$data2->dosenid}}" name="dosen">
                                    </form>
                                @else
                                    <button class="btn btn-default" disabled>Tap Out</button>
                                @endif 
                            </div>
                        </div>
                        <small id="" class="form-text text-muted">Jika Button "Disable" dosen belum mengaktifkannya atau anda sudah Tap</small>
                    </div>                         
                    <hr>
                @else
                    &nbsp;
                @endif
				<table class="table table-hover">
					<thead>	
                        <th class="text-center">No</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Tap In</th>
                        <th class="text-center">Tap Out</th>
                        <th class="text-center">Status</th>
					</thead>
					<tbody class="text-center">
                        @if ($data == NULL)
                            <tr class="text-center">
                                <td colspan="7">Silahkan Pilih Mata Kuliah terlebih dahulu</td>
                            </tr>
                        @else
                            <?php $no=0;?>
                            @foreach ($data as $item)    
                            <?php $no++;?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->tglabsen}}</td>
                                <td>{{substr($item->tapin,0,5)}}</td>
                                <td>{{substr($item->tapout,0,5)}}</td>
                                <td>{{strtoupper($item->status_absen)}}</td>
                                <td></td>
                            </tr>
                            @endforeach
						@endif
					</tbody>
				</table>
				<div class="pull-right">{{--$data->appends(['statuspinjamsearch' => request('statuspinjamsearch')])->links()--}}

				{{--$data->links()--}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection