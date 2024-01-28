@extends('super_admin.layouts.master')

@section('content')


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
                                <div class="form-group">
                                    <label for="quillExample1">Content</label>
                                    <!-- <div id="quillExample1" style="height: 300px;">
                                    </div> -->
                                    <textarea id="editor" name="description"></textarea>
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
    tinymce.init({
        height:500,
      selector: '#editor',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script>

    <script>
        // $('#editor').summernote();
    // $('#add_company').click(function(){
    //     $('#editor').val($('#quillExample1').find('.ql-editor').html());
    // });
    // var quill = new Quill('#quillExample1', {
    //   modules: {
    //     toolbar: [
    //       [{
    //         header: [1, 2, false]
    //       }],
    //       ['bold', 'italic', 'underline'],
    //       ['image', 'code-block', 'link']
    //     ]
    //   },
    //   placeholder: 'Compose an epic...',
    //   theme: 'snow' // or 'bubble'
    // });

    $(function() {
            $("#add_company").validate({
                submitHandler: function() {
                    var l = Ladda.create(document.querySelector('#add_company_button'));
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




