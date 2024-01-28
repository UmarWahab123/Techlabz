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
                            <h3>Manage Site SEO</h3>
                            <form class="forms-sample" method="post" action="{{route('save-setting')}}" id="add_company">
                                @csrf
                                <h5 class="card-title">Homepage SEO Setting</h5>
                                <div class="form-group">
                                    <label for="home_meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="home_meta_title" name="home_meta_title" placeholder="Meta Title" value="{{$setting->home_meta_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="home_meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="home_meta_keyword" name="home_meta_keyword" placeholder="Site Title" value="{{$setting->home_meta_keyword}}">
                                </div>

                                <div class="form-group">
                                    <label for="home_meta_description">Meta Description</label>
                                    <textarea class="form-control" id="home_meta_description" name="home_meta_description" placeholder="Meta Description" rows="5">{{$setting->home_meta_description}}</textarea>
                                    <span class="home_meta_description_error"></span>
                                </div>


                                <h5 class="card-title">Service Page SEO Setting</h5>
                                <div class="form-group">
                                    <label for="service_meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="service_meta_title" name="service_meta_title" placeholder="Meta Title" value="{{$setting->service_meta_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="service_meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="service_meta_keyword" name="service_meta_keyword" placeholder="Site Title" value="{{$setting->service_meta_keyword}}">
                                </div>

                                <div class="form-group">
                                    <label for="service_meta_description">Meta Description</label>
                                    <textarea class="form-control" id="service_meta_description" name="service_meta_description" placeholder="Meta Description"rows="5">{{$setting->service_meta_description}}</textarea>
                                    <span class="service_meta_description_error"></span>
                                </div>


                                <h5 class="card-title">About Us Page SEO Setting</h5>
                                <div class="form-group">
                                    <label for="about_meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="about_meta_title" name="about_meta_title" placeholder="Meta Title" value="{{$setting->about_meta_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="about_meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="about_meta_keyword" name="about_meta_keyword" placeholder="Site Title" value="{{$setting->about_meta_keyword}}">
                                </div>

                                <div class="form-group">
                                    <label for="about_meta_description">Meta Description</label>
                                    <textarea class="form-control" id="about_meta_description" name="about_meta_description" placeholder="Meta Description" rows="5">{{$setting->about_meta_description}}</textarea>
                                    <span class="about_meta_description_error"></span>
                                </div>


                                <h5 class="card-title">Contact Us Page SEO Setting</h5>
                                <div class="form-group">
                                    <label for="contact_meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="contact_meta_title" name="contact_meta_title" placeholder="Meta Title" value="{{$setting->contact_meta_title}}">
                                </div>

                                <div class="form-group">
                                    <label for="contact_meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="contact_meta_keyword" name="contact_meta_keyword" placeholder="Site Title" value="{{$setting->contact_meta_keyword}}">
                                </div>

                                <div class="form-group">
                                    <label for="contact_meta_description">Meta Description</label>
                                    <textarea class="form-control" id="contact_meta_description" name="contact_meta_description" placeholder="Meta Description"rows="5">{{$setting->contact_meta_description}}</textarea>
                                    <span class="contact_meta_description_error"></span>
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
                        url: ajax_url+"/save-seo-setting",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                               window.location.href = ajax_url+"/seo-setting";

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