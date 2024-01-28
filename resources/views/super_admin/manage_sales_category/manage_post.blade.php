@extends('super_admin.layouts.master')

@section('content')
<link href="{{ URL::asset('assets/mohithg-switchery/switchery.min.css')}}" rel="stylesheet" type="text/css">

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <p class="card-title">Manage Sales Category</p>
                    <div class="card-description">
                        <a class="btn btn-primary float-right" href="{{route('add-sales-category')}}">Add Sales Category</a>
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
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Added On</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                
                                </table>
                            </div>
                            <!-- <table id="get_device_list" class="display expandable-table dataTable no-footer table-responsive" style="width: 100%;">
                                <thead>
                                    <tr role="row">
                                        <th >Image</th>
                                        <th >Post Name</th>
                                        <th >Post Short Description</th>
                                        <th >Status</th>
                                        <th >Created at</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table> -->
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
<script src="{{ URL::asset('assets/mohithg-switchery/switchery.min.js')}}"></script>
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
        "url": ajax_url+'/get-sales-category-list',
        "dataType": "json",
        "type": "POST",
        "data": {_token: $('meta[name="csrf-token"]').attr('content')}
    },
    order: [],
    columns: [
        {data: 'title'},
        {data: 'status'},
        {data: 'created_at'},
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
        url: ajax_url+'/update-post-status',
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
        content: 'Are you sure you want to delete this Category!',
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
                        url: ajax_url+'/delete-sales-category',
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




