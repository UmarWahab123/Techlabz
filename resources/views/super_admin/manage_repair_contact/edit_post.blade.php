@extends('super_admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Message</p>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-repair-contact')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                @csrf
                                <input type="hidden" name="id" value="{{$blog->id}}">
                                <div class="form-group">
                                    <p>Name: {{$blog->name}}</p>
                                    <p>Email: {{$blog->email}}</p>
                                    <p>Message: {{$blog->message}}</p>
                                    <div class="profile-feed">
                                    <?php if(!empty($blog->messages)) {
                                        
                                        foreach ($blog->messages as $key => $val) {
                                        ?>
                                            <div class="d-flex align-items-start profile-feed-item">
                                                <div class="ms-4">
                                                <h6>
                                                    {{@$val->name}}
                                                    <small class="ms-4 text-muted"><?php echo date('d-m-Y g:i A',strtotime($val->created_at)) ?></small>
                                                </h6>
                                                <p>
                                                {{@$val->message}}
                                                </p>
                                                </div>
                                            </div>
                                    <?php } }?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message">Reply</label>
                                    <textarea class="form-control" name="message" rows="5"></textarea>
                                    <span class="message_error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 ladda-button" data-style="expand-right" id="add_company_button">Send</button>
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
                        url: ajax_url+"/contact-service/save-contact",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                               window.location.href = ajax_url+"/contact-service/manage-contact";

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




