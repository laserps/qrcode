@extends('Admin.layouts.layout')
@section('css_bottom')
@endsection
@section('body')
		<h2 class="page-title">
            {{$title_page or '' }}
            <div class="pull-right">
                <button class="btn btn-success btn-add">
                    + เพิ่ม {{$title_page or '' }}
                </button>
            </div>
        </h2>
            <div class="row">
                <div class="col-lg-12">
                    <section class="widget widhget-min-hight">
                        <div class="body no-margin">
                            <table class="table table-bordered table-hover" id="TableList">
                                <thead>
                                    <tr>
                                        <th>Activity Name</th>
                                        <th>Activity Links</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>QR Code</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
					</section>
                </div>
            </div>
<!-- Modal Add -->
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="FormAdd">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">เพิ่ม {{$title_page or 'ข้อมูลใหม่'}}</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="add_activity_name">Activity Name</label>
                    <input type="text" class="form-control" name="activity_name" id="add_activity_name"  placeholder="activity_name">
                </div>
                <div class="form-group">
                    <label for="add_working_time_start">Start Time</label>
                    <input type="text" class="form-control" name="working_time_start" id="add_working_time_start" placeholder="Start Time">
                </div>
                <div class="form-group">
                    <label for="add_working_time_end">End Time</label>
                    <input type="text" class="form-control" name="working_time_end" id="add_working_time_end" placeholder="End Time">
                </div>
                <!-- <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="" name="status" id="add_status"  value="T">
                    <label for="add_status">
                        status
                    </label>
                </div> -->
                <!-- <label class="checkbox-inline"><input type="radio" name="status" value="F">ไม่เปิดใช้งาน</label> -->
                <div class="form-group">
                  <label for="status">Status</label>
                     <div class="radio radio-primary">
                        <input type="radio" name="status" id="add_status1" value="T">
                        <label for="add_status1"> เปิดใช้งาน </label>
                    </div>
                    <div class="radio radio-primary">
                        <input type="radio" name="status" id="add_status2" value="F">
                        <label for="add_status2"> ปิดใช้งาน </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalAddQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormAdd">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">จัดการคำถาม</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-6">

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="color:black;">คำถาม</th>
                                    <th class="text-center" style="color:black;">เลือก</th>
                                </tr>
                            </thead>
                            <tbody id="allQuestion">

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="id" id="edit_user_id">
            <form id="FormEdit">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล {{$title_page or 'ข้อมูลใหม่'}}</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="add_activity_name">Activity Name</label>
                    <input type="text" class="form-control" name="activity_name" id="edit_activity_name"  placeholder="activity_name">
                </div>
                <div class="form-group">
                    <label for="edit_working_time_start">Start Time</label>
                    <input type="text" class="form-control" name="working_time_start" id="edit_working_time_start" placeholder="Start Time">
                </div>
                <div class="form-group">
                    <label for="edit_working_time_end">End Time</label>
                    <input type="text" class="form-control" name="working_time_end" id="edit_working_time_end" placeholder="End Time">
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                    <div class="radio radio-primary">
                        <input class="radio-danger" type="radio" name="status" id="edit_status" value="T">
                    <label class="form-check-label" for="inlineRadio1">เปิดใช้งาน</label>
                    </div>
                    <div class="radio radio-primary">
                      <input class="radio-danger" type="radio" name="status" id="edit_status" value="F">
                      <label class="form-check-label" for="inlineRadio2">ปิดใช้งาน</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <input type="hidden" name="id" id="edit_user_id">
            <form id="FormDetail">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">รายละเอียดข้อมูล {{$title_page}}</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="add_activity_name">Activity Name</label>
                    <input type="text" class="form-control" name="activity_name" id="detail_activity_name"  placeholder="activity_name" readonly>
                </div>
                <div class="form-group">
                    <label for="edit_working_time_start">Start Time</label>
                    <input type="text" class="form-control" name="working_time_start" id="detail_working_time_start" placeholder="Start Time" readonly>
                </div>
                <div class="form-group">
                    <label for="edit_working_time_end">End Time</label>
                    <input type="text" class="form-control" name="working_time_end" id="detail_working_time_end" placeholder="End Time" readonly>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                    <div class="radio radio-primary">
                        <input class="radio-danger" type="radio" name="status" id="detail_status" value="T" readonly>
                    <label class="form-check-label" for="inlineRadio1">เปิดใช้งาน</label>
                    </div>
                    <div class="radio radio-primary">
                      <input class="radio-danger" type="radio" name="status" id="edit_status" value="F" readonly>
                      <label class="form-check-label" for="inlineRadio2">ปิดใช้งาน</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalReward" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="FormReward">
				<input type="hidden" name="activity_id" id="activity_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล {{$title_page or 'ข้อมูลใหม่'}}</h4>
            </div>
            <div class="modal-body">
				<div class="row">
	                <div class="col-lg-12">
	                        <div class="body no-margin">
	                            <table class="table table-bordered table-hover" id="RewardList">
	                                <thead>
	                                    <tr>
											<th style="color:#000;">id</th>
											<th style="color:#000;">select</th>
					                        <th style="color:#000;">name</th>
					                        <th style="color:#000;">amount</th>
					                        <th></th>
	                                    </tr>
	                                </thead>
	                            </table>
	                        </div>
	                </div>
	            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js_bottom')
<script src="{{asset('assets/global/plugins/orakuploader/orakuploader.js')}}"></script>
<script>
    $('#add_working_time_start').timepicker();
    $('#add_working_time_end').timepicker();
    $('#edit_working_time_start').timepicker();
    $('#edit_working_time_end').timepicker();

     var TableList = $('#TableList').dataTable({
        "ajax": {
            "url": url_gb+"/admin/Activities/Lists",
            "data": function ( d ) {
                //d.myKey = "myValue";
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        "columns": [
            {"data" : "activity_name"},
            {"data" : "activity_url"},
            {"data" : "working_time_start"},
            {"data" : "working_time_end"},
            {"data" : "qr_code"},
            {"data" : "status"},
            {"data" : "created_at"},
            { "data": "action","className":"action text-center" }
        ]
    });
	var RewardList = $('#RewardList').dataTable({
	   "ajax": {
		   "url": url_gb+"/admin/Activities/RewardLists",
		   "data": function ( d ) {
			   //d.myKey = "myValue";
			   // d.custom = $('#myInput').val();
			   // etc
		   }
	   },
	   "columns": [
           {"data" : "id"},
           {"data" : "reward"},
           {"data" : "name"},
           {"data" : "amount"},
           { "data": "action","className":"action text-center" }
       ]
   });


   $('body').on('click','.btn-add-question',function(data){
       var str = "";
        $.ajax({
            method : "GET",
            "url": url_gb+"/admin/Questionall",
            dataType : 'json'
        }).done(function(rec){
            var str = '';
            $.each(rec, function(i,val){
                str +=
                `<tr>
                    <td>`+val.id+`</td>
                    <td><center><button class="btn btn-sm btn-primary">เลือก</button></center></td>
                </tr>`;
            });
            $('#allQuestion').html(str);
            ShowModal('ModalAddQuestion');
        });
    });

    $('body').on('click','.btn-add',function(data){
        ShowModal('ModalAdd');
    });
	$('body').on('click','.btn-reward',function(data){
		var btn = $(this);
		btn.button('loading');
		var id = $(this).data('id');
		$('#activity_id').val(id);
		btn.button("reset");
		RewardList.api().ajax.reload();
		$.ajax({
            method : "GET",
            url : url_gb+"/admin/Activities/getReward/"+id,
            dataType : 'json'
        }).done(function(rec){
			if(rec['F']) {
				$.each(rec['F'],function(k,v) {
					$('#ModalReward').find('tbody').find('input:checkbox[value="'+v+'"]').prop('checked',true);
					$('#ModalReward').find('tbody').find('input:checkbox[value="'+v+'"]').closest('tr').find('input:checkbox[name*="status_f"]').prop('checked',true);
				});
			}
			if(rec['T']) {
				$.each(rec['T'],function(k,v) {
					$('#ModalReward').find('tbody').find('input:checkbox[value="'+v+'"]').prop('checked',true);
					$('#ModalReward').find('tbody').find('input:checkbox[value="'+v+'"]').closest('tr').find('input:checkbox[name*="status_t"]').prop('checked',true);
				});
			}
		});
		ShowModal('ModalReward');
    });
    $('body').on('click','.btn-edit',function(data){
        var btn = $(this);
        btn.button('loading');
        var id = $(this).data('id');
        $('#edit_user_id').val(id);
        $.ajax({
            method : "GET",
            url : url_gb+"/admin/Activities/"+id,
            dataType : 'json'
        }).done(function(rec){
            $('#edit_activity_name').val(rec.activity_name);
            $('#edit_status').val(rec.status);
            $('#edit_working_time_start').val(rec.working_time_start);
            $('#edit_working_time_end').val(rec.working_time_end);
            $('#edit_activity_url').val(rec.activity_url);
            $('input[value="'+rec.status+'"]').prop('checked',true);

            btn.button("reset");
            ShowModal('ModalEdit');
        }).error(function(){
            swal("system.system_alert","system.system_error","error");
            btn.button("reset");
        });
    });

    $('#FormAdd').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        focusInvalid: false,
        rules: {

        },
        messages: {

        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            var btn = $(form).find('[type="submit"]');
            var data_ar = removePriceFormat(form,$(form).serializeArray());
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Activities",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableList.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalAdd').modal('hide');
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

    $('#FormEdit').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        focusInvalid: false,
        rules: {

        },
        messages: {

        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            var btn = $(form).find('[type="submit"]');
            var id = $('#edit_user_id').val();
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Activities/"+id,
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableList.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalEdit').modal('hide');
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });
    $('#FormReward').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        focusInvalid: false,
        rules: {

        },
        messages: {

        },
        highlight: function (e) {
            validate_highlight(e);
        },
        success: function (e) {
            validate_success(e);
        },

        errorPlacement: function (error, element) {
            validate_errorplacement(error, element);
        },
        submitHandler: function (form) {
            if(CKEDITOR!==undefined){
                for ( instance in CKEDITOR.instances ){
                    CKEDITOR.instances[instance].updateElement();
                }
            }
            var btn = $(form).find('[type="submit"]');
            btn.button("loading");
            $.ajax({
                method : "POST",
                url : url_gb+"/admin/Activities/RewardAccept",
                dataType : 'json',
                data : $(form).serialize()
            }).done(function(rec){
                btn.button("reset");
                if(rec.status==1){
                    TableList.api().ajax.reload();
                    resetFormCustom(form);
                    swal(rec.title,rec.content,"success");
                    $('#ModalReward').modal('hide');
                }else{
                    swal(rec.title,rec.content,"error");
                }
            }).error(function(){
                swal("system.system_alert","system.system_error","error");
                btn.button("reset");
            });
        },
        invalidHandler: function (form) {

        }
    });

	$('body').on('click','.btn-delete',function(e){
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        swal({
            title: "คุณต้องการลบสินค้าใช่หรือไม่",
            text: "หากคุณลบจะไม่สามารถุเรียกคืนข้อมูกลับมาได้",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ใช่ ฉันต้องการลบ",
            cancelButtonText: "ยกเลิก",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(data) {
            if(data){
                $.ajax({
                    method : "POST",
                    url : url_gb+"/admin/Activities/Delete/"+id,
                    data : {ID : id}
                }).done(function(rec){
                    if(rec.status==1){
                        swal(rec.title,rec.content,"success");
                        TableList.api().ajax.reload();
                    }else{
                        swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
                    }
                }).error(function(data){
                    swal("ระบบมีปัญหา","กรุณาติดต่อผู้ดูแล","error");
                });
            }
        });
    });
// $('body').on('click','.btn-detail',function(data){
//         var btn = $(this);
//         btn.button('loading');
//         var id = $(this).data('id');
//         // $('#edit_user_id').val(id);
//         $.ajax({
//             method : "GET",
//             url : url_gb+"/admin/Activities/Detail/"+id,
//             dataType : 'json'
//         }).done(function(rec){
//             // console.log(rec);
//             $('#detail_activity_name').val(rec.activity_name);
//             $('#detail_status').val(rec.status);
//             $('#detail_working_time_start').val(rec.working_time_start);
//             $('#detail_working_time_end').val(rec.working_time_end);
//             $('#detail_activity_url').val(rec.activity_url);
//             $('input[value="'+rec.status+'"]').prop('checked',true);

//             btn.button("reset");
//             ShowModal('ModalDetail');
//         }).error(function(){
//             swal("system.system_alert","system.system_error","error");
//             btn.button("reset");
//         });
//     });


</script>
@endsection
