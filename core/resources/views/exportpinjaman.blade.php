<table>
					<thead>
						<tr>
							<th>No</th>
							<th>Peminjam NIM</th>
							<th>Gedung</th>
							<th>Ruangan</th>
							<th>Hari</th>
							<th>jam Mulai</th>
							<th>jam Selesai</th>
							<th>Tanggal Penggunaan</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=0;?>
						@foreach($data as $datas)
						<?php $no++;?>
						<tr>
							<td>{{$no}}</td>
							<td>{{$datas->mahasiswa_id}}</td>
							<td>{{$datas->gedung}}</td>
							<td>{{$datas->ruangan}}</td>
							<td>{{$datas->hari}}</td>
							<td>{{substr($datas->jamawal,0,5)}}</td> 
							<td>{{substr($datas->jamakhir,0,5)}}</td>
							<td>{{date('d-m-Y', strtotime($datas->tanggal))}}</td>
							<td>
								@if($datas->pinjamstatus == "Menunggu Konfirmasi")
								<h2><span>{{$datas->pinjamstatus}}</span></h2>
								@elseif($datas->pinjamstatus == "DISETUJUI")
								<h2><span>{{$datas->pinjamstatus}}</span></h2>
								@else
								<h2><span>{{$datas->pinjamstatus}}</span></h2><span>
								@endif

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>