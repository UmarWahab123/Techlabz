@extends('super_admin.layouts.master')

@section('content')
<link href="<?php echo Config::get('app.url'); ?>/{{ URL::asset('assets/mohithg-switchery/switchery.min.css')}}" rel="stylesheet" type="text/css">

<?php 

function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header bg-white">
                    <p class="card-title">Manage Database Backup</p>
                    <div class="card-description">
                        <a class="btn btn-primary float-right ladda-button" data-style="expand-right" href="javascript:;" id="take_backup">Create New Database Backup</a>
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
                                        <th>File Name</th>
                                        <th >Size</th>
                                        <th> Backup Date </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                    <?php if(!empty($backups)) { 
                                        foreach ($backups as $key => $val) {
                                        ?>
                                    <tr>
                                        <td><?php echo @$val['file_name']; ?></td>
                                        <td><?php echo formatSizeUnits(@$val['file_size']); ?></td>
                                        <td><?php echo date('d-m-Y',@$val['last_modified']); ?></td>
                                        <td><a class="btn btn-primary" href="<?php echo url("/").'/storage/app/'.@$val['file_path'] ?>" target="_blank" download>Download File</a></td>
                                    </tr>
                                    <?php }} ?>
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
<script>


$('#take_backup').on('click',function(){

    delete_post();

});




function delete_post(){
    console.log()
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure you want to backup Database!',
        buttons: {
            confirm: {
                text: 'Yes',
                btnClass: 'btn btn-success',
                keys: ['enter'],
                action: function(e) {
                    let self = this;
                    self.showLoading();

                    var l = Ladda.create(document.querySelector('#take_backup'));
                    l.start();

                    $.ajax({
                        type: 'POST',
                        url: ajax_url+'/make-backup',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status) {
                                toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                                self.close();
                                l.stop();
                                // location.reload();
                            } 
                        },
                        error: function(response) {
                            l.stop();
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




