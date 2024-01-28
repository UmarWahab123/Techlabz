@extends('super_admin.layouts.master')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php if(!empty(@$blog->id)) { ?>
                    <p class="card-title">Edit Service</p>
                    <?php } else {?>
                        <p class="card-title">Add Service</p>
                    <?php }?>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-service')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                @csrf
                                <input type="hidden" name="id" value="{{@$blog->id}}">
                                <div class="form-group">
                                    <label for="title">Service Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" required  value="{{@$blog->title}}">
                                    <span class="title_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Post Slug" required  value="{{@$blog->slug}}">
                                    <span class="slug_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="image">Service Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Post image">
                                </div>
                                <?php if(!empty($blog->image)) { ?>
                                    <div class="form-group">
                                        <img src="<?php echo url('/public').'/'.@$blog->image; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                    </div>
                                <?php }?>

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

                                <div class="form-group d-none">
                                    <label for="quillExample1">Content</label>
                                    <div id="quillExample1" style="height: 300px;">
                                        <?php echo @$blog->description;  ?>
                                    </div>
                                    <textarea id="editor" name="text" style="display: none;"><?php echo @$blog->description;  ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2 ladda-button save-btn" data-style="expand-right" id="add_company_button">Submit</button>
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
        $('#add_company').click(function(){
            $('#editor').val($('#quillExample1').find('.ql-editor').html());
        });

    var quill = new Quill('#quillExample1', {
      modules: {
        toolbar: [
          [{
            header: [1, 2, false]
          }],
          ['bold', 'italic', 'underline'],
          ['image', 'code-block']
        ]
      },
      placeholder: 'Compose an epic...',
      theme: 'snow' // or 'bubble'
    });

    $(function() {
            $("#add_company").validate({
                submitHandler: function() {
                    var l = Ladda.create(document.querySelector('#add_company_button'));
                    l.start();
                    var formData = new FormData($('#add_company')[0]);
                    
                    $.ajax({
                        data: formData,
                        type: "POST",
                        url: ajax_url+"/save-service",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                            //    window.location.href = ajax_url+"/manage-service";

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




