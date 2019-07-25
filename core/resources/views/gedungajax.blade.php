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
				<div class="card-title">
					<div class="form-group row">
					<label class="col-form-label col-sm-6"><h5>Data Gedung</h5></label>
						<div class="col-sm-6 text-right">	
							<!-- Button trigger modal -->
							<a href="javascript:void(0)" id="create-new-user" class="btn btn-primary btn-sm" data-toggle="" data-target="">
							  Tambah Data
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-hover text-center">
					<thead>
						
							<th>No</th>
							<th>Nama Gedung</th>
							<th>Status</th>
							<th>Aksi</th>
						
					</thead>
					<tbody id="user-crud">
				<?php $no=0;?>
				@foreach($data as $datas)
				<?php $no++;?>
					
						<tr id="user_id_{{$datas->id}}">
							<td data-id="{{$datas->row}}">{{$datas->row}}</td>
							<td>{{$datas->gedung}}</td>
							<td>{{$datas->status}}</td>
							<td><a href="javascript:void(0)" id="edit-user" data-id="{{$datas->id}}" class="btn btn-success btn-sm">Edit</a>
								&nbsp;<a href="javascript:void(0)" id="delete-user" data-id="{{$datas->id}}" data-gedung="{{$datas->gedung}}" class="btn btn-danger btn-sm">Hapus</a></td>
						</tr>
					
				@endforeach
				</tbody>
				</table>

				
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Gedung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="" id="userForm" name="userForm" action="">
      	@csrf
	      <div class="modal-body">
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Nama Gedung</label>
					<div class="col-sm-6">
						<input type="text" name="gedung" class="form-control" id="gedung" value="">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-4 col-form-label">Status</label>
					<div class="col-sm-6">
						<select class="form-control" name="status" id="status">
							<option value="Aktif">Aktif</option>
							<option value="Non Aktif">Non Aktif</option>
						</select>
					</div>
				</div>
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" id="btn-save" class="btn btn-primary" value="add">Save changes</button>
	        <input type="hidden" name="update_id" value="" id="update_id">
	      </div>
    	</form>
    </div>
    
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function () {
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $("#create-new-user").click(function(){
	    	$("#exampleModalLabel").html("Tambah Data")
	    	$("#btn-save").val("add")
	    	$("#userForm").trigger("reset")
	    	$("#exampleModal").modal("show")
	    });

		$('body').on('click', '#edit-user',function () {
			var gedung_id = $(this).data("id");
			//var gedung = $(this).data("gedung");
			$.get('gedungajaxedit/' + gedung_id + '/edit', function(data){
				//var gedung = $(this).data("id");
				$('#btn-save').val("edit-user");
				$('#exampleModalLabel').html("Edit User");
				$('#exampleModal').modal('show');
				$('#gedung').val(data.gedung);
				//console.log(gedung);
				$('#status').val(data.status);
				$('#update_id').val(gedung_id);
				//alert('tes')
			});
		});

		$("body").on('click', '#delete-user', function(){
			var user_id = $(this).data("id")
			var gedung = $(this).data("gedung")
			confirm("Apakah Anda yakin ingin menghapus " + gedung + "?")
			$("#user_id_" + user_id).fadeOut("slow")
			$.ajax({
				type:"get",
				url: "{{ url('gedungajax')}}"+'/'+user_id+'/delete',
				success: function(data){
						$("#user_id_" + user_id).remove();
				},
				error: function(data){
					console.log('Error', data)
				}

			});
		});

		$("body").on('click','#btn-save', function(){
			var type = "post"
			var id = $("#update_id").val()
			var actionA = $("#btn-save").val()
			var ajaxUrl = "{{url('gedungajaxadd')}}"
			var formData = {
				gedung:$("#gedung").val(),
				status:$("#status").val(),
				no:$("#no").data("id")+1,
			};
			if (actionA == "edit-user"){
				type = "post"
				ajaxUrl = "{{url('gedungajaxedit')}}"+'/'+ id+'/update'
			}
			$.ajax({
				type: type,
				url: ajaxUrl,
				data: formData,
				dataType: 'json',
				success: function(data){
					var link = '<tr id="user_id_' + data.id + '"><td>'+data.no+'</td><td>' + data.gedung + '</td><td>' + data.status + '</td>';
                		link += '<td><a class="btn btn-success btn-sm" href="javascript:void(0)" id="edit-user" data-id="' + data.id + '">Edit</a>&nbsp;';
                		link += '<a href="javascript:void(0)" class="btn btn-danger btn-sm" id="delete-user" data-id="' + data.id + '">Delete</a></td></tr>';
				

					if(actionA == "add"){
						$("#user-crud").append(link)
						$(link).fadeIn("slow")
					}else{
						$("user_id_" + data.id).replaceWith(link)
					}

					$("#userForm").trigger("reset")
					$("#exampleModal").modal("hide")
				},
				error: function(e){
					console.log('error', data)
				}


			})
		});

		/*$("#btn-save").click(function(e){
			//e.prevenDefault();
			var type = "post"
			var id = $("body").data("id")
			var actionA = $("#btn-save").val()
			var ajaxUrl = "{{url('gedungajaxadd')}}"
			var formData = {
				gedung:$("#gedung").val(),
				status:$("#status").val(),
			};
			if (actionA == "edit-user"){
				type = "post"
				ajaxUrl = "{{url('gedungajaxedit')}}"+'/'+ id+'/update'
			}
			$.ajax({
				type: type,
				url: ajaxUrl,
				data: formData,
				dataType: 'json',
				success: function(data){
					var link = '<tr id="user_id_' + data.id + '"><td>{{$no}}</td><td>' + data.gedung + '</td><td>' + data.status + '</td>';
                		link += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
                		link += '<button class="btn btn-danger delete-link" value="' + data.id + '">Delete</button></td></tr>';
				

					if(actionA == "add"){
						$("#user-crud").append(link)
						$(link).fadeIn("slow")
					}else{
						$("user_id_"+data.id).replaceWith(link)
					}

					$("#userForm").trigger("reset")
					$("#exampleModal").modal("hide")
				},
				error: function(e){
					console.log('error', data)
				}


			})
		});*/

		/*if($("#userForm").length > 0){
			$("#userForm").validate({
				submitHandler : function(form){
					var action = $("$btn-save").val()
					$("#btn-save").html("mengirim data...")
					$.ajax({
						data: $('#userForm').serialize(),
						url:"{{url('/gedungajaxadd')}}",
						type:'post',
						dataType:'json',
						success: function(data){
							var dataInput = '<tr id="user_id_'+data.id+'"><td>{{$no}}</td><td>'+data.gedung+'</td><td>'+data.status+'<td>';
							user += '<td><a href="javascript:void(0)" id="edit-user" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              				user += '<td><a href="javascript:void(0)" id="delete-user" data-id="' + data.id + '" class="btn btn-danger delete-user">Delete</a></td></tr>';
							if (actionType == "create-user") {
                 				 $('#users-crud').prepend(user);
				              } else {
				                  $("#user_id_" + data.id).replaceWith(user);
				              }
				 
				              $('#userForm').trigger("reset");
				              $('#exampleModal').modal('hide');
				              $('#btn-save').html('Save Changes');
				              
				          },
				          error: function (data) {
				              console.log('Error:', data);
				              $('#btn-save').html('Save Changes');
				          }
					})
				}
			})
		}*/



	});
</script>
@endsection
