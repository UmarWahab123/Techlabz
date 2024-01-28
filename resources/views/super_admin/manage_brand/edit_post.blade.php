@extends('super_admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Edit Brand</p>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-brand')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                @csrf
                                <input type="hidden" name="id" value="{{$blog->id}}">
                                
                                <div class="form-group">
                                    <label for="title">Brand Name</label>
                                    <input type="text" class="form-control" name="title" placeholder="Brand Name" value="{{@$blog->title}}" required/>

                                    <span class="title_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input type="text" class="form-control" name="slug" placeholder="Slug" required value="{{@$blog->slug}}"/>
                                    <span class="slug_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Brand Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Brand image">
                                </div>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.@$blog->image; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title"  value="{{@$blog->meta_title}}">
                                    <span class="meta_title_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword"  value="{{@$blog->meta_keyword}}">
                                    <span class="meta_keyword_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description"  value="{{@$blog->meta_description}}">
                                    <span class="meta_description_error"></span>
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
                        url: ajax_url+"/save-brand",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                                window.location.href = ajax_url+"/manage-brand";

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




