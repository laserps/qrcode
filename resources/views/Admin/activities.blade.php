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
                                        <th>QR Code</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                </div>
            </div>

<!-- Modal -->
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
                    <label for="add_activity_url">Activity Link</label>
                    <input type="text" class="form-control" name="activity_url" id="add_activity_url"  placeholder="activity_url">
                </div>
                <div class="form-group">
                    <label for="add_activity_url">Start Time</label>
                    <input type="time" class="form-control" name="working_time_start" id="add_working_time_start"  placeholder="Start Time">
                </div>
                <div class="form-group">
                    <label for="add_activity_url">End Time</label>
                    <input type="time" class="form-control" name="working_time_end" id="add_working_time_end"  placeholder="End Time">
                </div>
                <!-- <div class="checkbox checkbox-primary">
                    <input type="checkbox" class="" name="status" id="add_status"  value="T">
                    <label for="add_status">
                        status
                    </label>
                </div> -->
                <div class="form-group">
                  <label for="add_guest_type_id">Status</label>
                    <div class="radio radio-danger">
                        <input class="radio-danger" type="radio" name="guest_type_id" id="add_guest_type_id" value="T">
                    <label class="form-check-label" for="inlineRadio1">เปิดใช้งาน</label>
                    </div>
                    <div class="radio radio-danger">
                      <input class="radio-danger" type="radio" name="guest_type_id" id="add_guest_type_id" value="F">
                      <label class="form-check-label" for="inlineRadio2">ปิดใช้งาน</label>
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
<!-- Modal -->
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
                    <label for="edit_activity_name">activity_name</label>
                    <input type="text" class="form-control" name="activity_name" id="edit_activity_name"  placeholder="activity_name">
                </div>
        
                <div class="form-group">
                    <label for="edit_status">status</label>
                    <input type="text" class="form-control" name="status" id="edit_status"  placeholder="status">
                </div>
        
                <div class="form-group">
                    <label for="edit_activity_url">activity_url</label>
                    <input type="text" class="form-control" name="activity_url" id="edit_activity_url"  placeholder="activity_url">
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
            {"data" : "qr_code"},
            {"data" : "status"},
            {"data" : "created_at"},
            { "data": "action","className":"action text-center" }
        ]
    });
    $('body').on('click','.btn-add',function(data){
        ShowModal('ModalAdd');
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
            $('#edit_activity_url').val(rec.activity_url);
            
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

    
</script>
@endsection