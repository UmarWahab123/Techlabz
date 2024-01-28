@extends('super_admin.layouts.master')

@section('content')
<link href="<?php echo Config::get('app.url'); ?>/{{ URL::asset('assets/mohithg-switchery/switchery.min.css')}}" rel="stylesheet" type="text/css">

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <p class="card-title">Manage Products</p>
                    <div class="card-description">
                        <a class="btn btn-primary float-right" href="{{route('add-sales-product')}}">Add New Product</a>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="" style="width: 100%;">
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table" id="get_device_list">
                                <thead>
                                    <tr role="row">
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Brand</th>
                                        <th>Status</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('custom_script')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo Config::get('app.url'); ?>/{{ URL::asset('assets/mohithg-switchery/switchery.min.js')}}"></script>
<script>

$('#get_device_list').DataTable({
    processing: true,
    serverSide: true,
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "ordering": false,
    "bAutoWidth": false,
    "pageLength": 10,
    "ajax": {
        "url": ajax_url+'/get-sales-product-list',
        "dataType": "json",
        "type": "POST",
        "data": {_token: $('meta[name="csrf-token"]').attr('content')}
    },
    order: [],
    columns: [
        {data: 'title'},
        {data: 'service'},
        {data: 'sub_service'},
        {data: 'brand'},
        {data: 'status'},
        {data: 'action'},
    ],
    "drawCallback": function (settings, json) {
        $('#get_device_list').css('width', '100%');
        var elems = Array.prototype.slice.call(document.querySelectorAll('.jswitch'));
        elems.forEach(function(html) {
            new Switchery(html, { color: '#1bb99a', secondaryColor: '#ff5d48' });
            html.onchange = function(e) {
                if ($(this).is(':checked')) {
                    update_status(1 , $(this).data('id'))
                } else {
                    update_status(2 , $(this).data('id'))
                }
            }
        });
    }
});


function update_status(status , id){
    $.ajax({
        type: 'POST',
        url: ajax_url+'/update-service-status',
        data: {
            'id': id,
            'status': status,
            '_token': $('meta[name="csrf-token"]').attr('content'),
        },
        dataType: "json",
        success: function(response) {
            if (response.status) {
                
            } 
        },
        error: function(response) {
            toastr.error("Something went wrong", '', {
                "progressBar": true
            });
        }
    });
}

function delete_post(obj){
    console.log()
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure you want to delete this Record!',
        buttons: {
            confirm: {
                text: 'Yes',
                btnClass: 'btn btn-success',
                keys: ['enter'],
                action: function(e) {
                    let self = this;
                    self.showLoading();
                    $.ajax({
                        type: 'POST',
                        url: ajax_url+'/delete-post',
                        data: {
                            'id': $(obj).data('id'),
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                $('#get_device_list').DataTable().ajax.reload();
                                toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                                self.close();
                            } 
                        },
                        error: function(response) {
                            toastr.error("Something went wrong", '', {
                                "progressBar": true
                            });
                        }
                    });
                }
            },
            cancel: function() {
                return true;
            }
        }
    });
    
}


</script>
@endsection 




