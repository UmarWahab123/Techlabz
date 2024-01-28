@extends('super_admin.layouts.master')

@section('content')
<style>
    .error {
        color: red;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Manage Profile</h4>
                            <form class="forms-sample" method="post" action="#" id="add_company">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="{{$setting->name}}">
                                    <span class="name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="{{$setting->email}}">
                                    <span class="email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="image">Profile Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Profile image">
                                </div>
                                <?php if(!empty($setting->image)) { ?>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.$setting->image; ?>" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="password">Change Password( If you want to change )</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                                    <span class="password_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 ladda-button" data-style="expand-right" id="add_company_button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection 

@section('custom_script')
    <script>

    $(function() {
            $("#add_company").validate({
                submitHandler: function() {
                    var l = Ladda.create(document.querySelector('#add_company_button'));
                    l.start();
                    var formData = new FormData($('#add_company')[0]);
                    $.ajax({
                        data: formData,
                        type: "POST",
                        url: ajax_url+"/save-profile",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                               window.location.href = ajax_url+"/profile";

                            } else {
                                toastr.error('Something went wrong!', '', {
                                    "progressBar": true
                                });
                            }
                            
                        },
                        error: function(response) {
                            l.stop();
                            toastr.error('Something went wrong!', '', {
                                "progressBar": true
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection 