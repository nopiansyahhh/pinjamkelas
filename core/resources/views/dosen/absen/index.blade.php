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
					<h4 class="title">Absensi</h4>
					<div class="card-header-right">
						<div class="form-inline">
							<form method="GET" action="{{url('dosenabsen')}}">
                                <label for="">Mata Kuliah</label>
                                <select name="smatkul" id="" class="form-control">
                                    <option value="">---pilih Matkul---</option>
                                    @foreach ($matkul as $item)
                                        <option value="{{$item->matid}}" @if ($item->matid == $smatkul) selected @endif>{{$item->nmatkul}}</option>
                                    @endforeach
                                </select>&nbsp;&nbsp;&nbsp;
                                <label for="">Tanggal</label>
                                <input type="date" name="stanggal" class="form-control" value="{{$stanggal}}">
				                &nbsp;<button class="btn" type="submit"><i class="fa fa-search"></i></button>
	                    	</form>
                    	</div>
                    </div>
				</div>
            </div>
		 <div class="card-body">
          <div class="card-block" id="data">
            <br>
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
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Tanggal</label>
                    <div class="col-sm-6">
                        <span>{{$stanggal}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Generate Token Tap</label>
                    <div class="col-sm-3">
                        <span>@if($data2->status_generate=="") DISABLE @else AKTIF @endif</span>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-disabled="true">
                              <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">      
                                    <a class="dropdown-item" href="{{route('gendisable',$data2->matkulid)}}"><i class="" style=""></i>&nbsp;&nbsp;DISABLE
                                    </a>
                                    <div class="dropdown-item"></div>
                                    <a class="dropdown-item" href="{{route('genaktif',$data2->matkulid)}}" ><i class="" style="color:orange;"></i>&nbsp;&nbsp;AKTIF
                                    </a>           
                            </div>
                        </div>  
                    </div>
                </div>
                @if($data2->status_generate == 1)
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Generate Tap In</label>
                        <form action="{{route('generatetapin',$data2->matkulid)}}" method="POST">
                            @csrf
                            <div class="col-sm-4">                         
                                <input type="text" value="{{$data2->generate_tapin}}" class="form-control" name="gentapin">
                            </div>
                            <div><button class="btn btn-default">generate</button></div>
                        </form>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Generate Tap Out</label>
                        <form action="{{route('generatetapout',$data2->matkulid)}}" method="POST">
                            @csrf
                            <div class="col-sm-4">    
                                    <input type="text" value="{{$data2->generate_tapout}}" class="form-control">       
                            </div>
                            <div><button class="btn btn-default">generate</button></div>
                        </form>
                    </div>
                @endif
                <div class="form-group row">
                    <label class="col-sm-4 col-sm-offset-2 col-form-label">Tap Manual</label>
                    <div class="col-sm-3">
                        <span>@if($data2->statusbtntap==0) DISABLE @elseif($data2->statusbtntap==1) TAPIN AKTIF @elseif($data2->statusbtntap==2) TAPOUT AKTIF @else KEDUANYA AKTIF @endif</span>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-disabled="true">
                              <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">      
                                    <a class="dropdown-item" href="{{route('tapnonaktif',$data2->dosenmatkulid)}}"><i class="" style=""></i>&nbsp;&nbsp;NONAKTIF
                                    </a>
                                    <div class="dropdown-item"></div>
                                    <a class="dropdown-item" href="{{route('tapinaktif',$data2->dosenmatkulid)}}" ><i class="" style="color:orange;"></i>&nbsp;&nbsp;TAP IN AKTIF
                                    </a>
                                    <div class="dropdown-item"></div>
                                    <a class="dropdown-item" href="{{route('tapoutaktif',$data2->dosenmatkulid)}}" ><i class="" style="color:orange;"></i>&nbsp;&nbsp;TAP OUT AKTIF
                                    </a>
                                    <div class="dropdown-item"></div>
                                    <a class="dropdown-item" href="{{route('tapaktif',$data2->dosenmatkulid)}}"><i class="" style="color:orange;"></i>&nbsp;&nbsp;KEDUANYA AKTIF
                                    </a>            
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="form-group row">
                   <small id="" class="form-text text-muted col-sm-4 col-sm-offset-2">Tampilan Tombol</small>
                    <div class="col-sm-6">
                        <div class="col-sm-3">
                            @if($data2->statusbtntap == 1 || $data2->statusbtntap == 3)
                                    <button class="btn btn-success">Tap In</button>
                                    <input type="hidden" value="{{$data2->dosenid}}" name="dosen">
                            @else
                                <button class="btn btn-success" disabled>Tap In</button>
                            @endif
                        </div>
                        
                        <div class="col-sm-3">    
                            @if($data2->statusbtntap == 2 || $data2->statusbtntap == 3)   
                                    <button class="btn btn-success">Tap Out</button>
                                    <input type="hidden" value="{{$data2->dosenid}}" name="dosen">
                            @else
                                <button class="btn btn-success" disabled>Tap Out</button>
                            @endif 
                        </div>
                    </div>
                </div>
                <hr><br><br>
                <form action="{{route('dosenabsenupdate')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$smatkul}}" name="smatkul">
                    <input type="hidden" value="{{$stanggal}}" name="stanggal">
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Kehadiran Dosen</label>
                        <div class="col-sm-4">
                            <span>
                                <select name="statushadirdosen" id="" class="form-control">
                                    <option value=""></option>
                                    <option value="hadir" {{$data3->dosen_status_absen=='hadir' ? "selected" : ""}}>HADIR</option>
                                    <option value="izin" {{$data3->dosen_status_absen=='izin' ? "selected" : ""}}>IZIN</option>
                                    <option value="sakit" {{$data3->dosen_status_absen=='sakit' ? "selected" : ""}}>SAKIT</option>
                                    <option value="mangkir" {{$data3->dosen_status_absen=='mangkir' ? "selected" : ""}}>MANGKIR</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label">Topik Pembahasan</label>
                        <div class="col-sm-4">
                            <span>
                                <textarea name="dosen_topik" id="" cols="30" rows="5" class="form-control">{{$data3->topik}}</textarea>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-sm-offset-2 col-form-label"></label>
                        <div class="col-sm-6">
                            <span>
                                <button class="btn btn-primary">SAVE</button>
                            </span>
                        </div>
                    </div>
                </form>                         
            @else
                &nbsp;
            @endif
            <hr>
            <table class="table table-hover text-center">
                <thead>
                    
                        <th class="text-center">No</th>
                        <th class="text-center">NIM</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">tanggal</th>
                        <th class="text-center">TapIn</th>
                        <th class="text-center">TapOut</th>
                        <th class="text-center">Status</th>
                        <th></th>
                </thead>
                <tbody>
                @if ($data == NULL)
                    <tr class="text-center">
                        <td colspan="7">Silahkan Pilih Matkul dan tanggal terlebih dahulu</td>
                    </tr>
                @else
                    <?php $no=0?>
                    @foreach ($data as $item)
                    <form action="{{route('statushadir')}}" method="POST">
                        @csrf
                    <?php $no++?>
                            <tr>
                                <td>{{$no}} <input type="hidden" value="{{$item->absenid}}" name="absenid[]"></td>
                                <td>{{$item->nim}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->tglabsen}}</td>
                                <td>{{$item->tapin}}</td>
                                <td>{{$item->tapout}}</td>
                                <td class="col-md-2">
                                    <select name="statushadir[]" id="" class="form-control">
                                        <option value=""></option>
                                        <option value="belum tapout" {{$item->status_absen=='belum tapout' ? "selected" : ""}}>BELUM TAPOUT</option>
                                        <option value="hadir" {{$item->status_absen=='hadir' ? "selected" : ""}}>HADIR</option>
                                        <option value="izin" {{$item->status_absen=='izin' ? "selected" : ""}}>IZIN</option>
                                        <option value="sakit" {{$item->status_absen=='sakit' ? "selected" : ""}}>SAKIT</option>
                                        <option value="mangkir" {{$item->status_absen=='mangkir' ? "selected" : ""}}>MANGKIR</option>
                                    </select>
                                </td>
                            </tr>
                        
                    @endforeach
                @endif
                </tbody>
            </table>
          </div>
	      <div class="modal-footer">
	        <a href="" class="btn btn-secondary">Close</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
	      </div>
		</div>
	</div>
</div>

@endsection