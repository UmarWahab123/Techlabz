@extends('super_admin.layouts.master')

@section('content')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Add New Post</p>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-post')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Post Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" required>
                                    <span class="title_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="slug">Post Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Post slug" required>
                                    <span class="slug_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="image">Post Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Post image" required>
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea class="form-control" id="short_description" name="short_description" placeholder="Short Description" rows="5"></textarea>
                                </div>
                                <div class="form-group" id="full-container">
                                    <label for="exampleFormControlTextarea1">Content</label>
                                    <div id="full-container">
                                    <div class="editor">
                                    
                                    </div>
                                    </div>
                                    <textarea class="form-control d-none" name="description"></textarea>
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
<script src="{{URL::asset('/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
 <script src="{{URL::asset('/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/js/scripts/forms/form-quill-editor.js')}}"></script>
<script>
    $(function() {
        $("#add_company").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_company_button'));
                    $('textarea[name=description]').val($('.ql-editor').html());
                l.start();
                var formData = new FormData($('#add_company')[0]);
                
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/save-post",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                            
                            toastr.success(response.message, '', {
                                "progressBar": true
                            });
                            window.location.href = ajax_url+"/manage-post";

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




