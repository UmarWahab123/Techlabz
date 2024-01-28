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
                            <h4 class="card-title">Homepage Setting</h4>
                            <form class="forms-sample" method="post" action="{{route('save-setting')}}" id="add_company">
                                @csrf
                                <h5>Computer Repair Service Section Text</h5>
                                <div class="form-group">
                                    <label for="section_title_1">Title</label>
                                    <input type="section_title_1" class="form-control" id="section_title_1" name="section_title_1" placeholder="Title" required value="{{$setting->section_title_1}}">
                                    <span class="section_title_1_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_description_1">Description</label>
                                    <div id="section_description_1" style="height: 200px;">
                                        <?php echo @$setting->section_description_1;  ?>
                                    </div>
                                    <textarea id="editor" name="section_description_1" style="display: none;"><?php echo @$setting->section_description_1;  ?></textarea>
                                </div>

                                <h5>IT Support & Repair Services Section Text</h5>
                                <div class="form-group">
                                    <label for="section_title_2">Title</label>
                                    <input type="section_title_2" class="form-control" id="section_title_2" name="section_title_2" placeholder="Title" required value="{{$setting->section_title_2}}">
                                    <span class="section_title_2_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_description_2">Description</label>
                                    <div id="section_description_2" style="height: 200px;">
                                        <?php echo @$setting->section_description_2;  ?>
                                    </div>
                                    <textarea id="editor_2" name="section_description_2" style="display: none;"><?php echo @$setting->section_description_2;  ?></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="section_image_2">Right Side Image</label>
                                    <input type="file" class="form-control" id="section_image_2" name="section_image_2" placeholder="Image">
                                </div>
                                <div class="form-group">
                                    <img src="<?php echo url('/public').'/'.@$setting->section_image_2; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>


                                <h5>Our Repairing Services Section Text</h5>
                                <div class="form-group">
                                    <label for="section_title_3">Title</label>
                                    <input type="section_title_3" class="form-control" id="section_title_3" name="section_title_3" placeholder="Title" required value="{{$setting->section_title_3}}">
                                    <span class="section_title_3_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_description_3">Description</label>
                                    <div id="section_description_3" style="height: 200px;">
                                        <?php echo @$setting->section_description_3;  ?>
                                    </div>
                                    <textarea id="editor_3" name="section_description_3" style="display: none;"><?php echo @$setting->section_description_3;  ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="section_image_3">Left Side Image</label>
                                    <input type="file" class="form-control" id="section_image_3" name="section_image_3" placeholder="Image">
                                </div>
                                <div class="form-group">
                                    <img src="<?php echo url('/public').'/'.@$setting->section_image_3; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>
                                
                                <h5>Services Section Text</h5>
                                <div class="form-group">
                                    <label for="service_title">Title</label>
                                    <input type="service_title" class="form-control" id="service_title" name="service_title" placeholder="Title" required value="{{$setting->service_title}}">
                                    <span class="service_title_error"></span>
                                </div>

                                <h5>Amazon Deal Section Text</h5>
                                <div class="form-group">
                                    <label for="amazon_section">Title</label>
                                    <input type="amazon_section" class="form-control" id="amazon_section" name="amazon_section" placeholder="Title" required value="{{$setting->amazon_section}}">
                                    <span class="amazon_section_error"></span>
                                </div>
                                

                                <h5>Why choose Tech Labz Section Text</h5>

                                <div class="form-group">
                                    <label for="why_title">Title</label>
                                    <input type="why_title" class="form-control" id="why_title" name="why_title" placeholder="Title" required value="{{$setting->why_title}}">
                                    <span class="why_title_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_title_4">Title 1</label>
                                    <input type="section_title_4" class="form-control" id="section_title_4" name="section_title_4" placeholder="Title" required value="{{$setting->section_title_4}}">
                                    <span class="section_title_4_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_description_4">Description 1</label>
                                    <textarea class="form-control" id="section_description_4" name="section_description_4"  placeholder="Description" rows="5">{{$setting->section_description_4}}</textarea>
                                    <span class="section_description_4_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_title_5">Title 2</label>
                                    <input type="section_title_5" class="form-control" id="section_title_5" name="section_title_5" placeholder="Title" required value="{{$setting->section_title_5}}">
                                    <span class="section_title_5_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_description_5">Description 2</label>
                                    <textarea class="form-control" id="section_description_5" name="section_description_5"  placeholder="Description" rows="5">{{$setting->section_description_5}}</textarea>
                                    <span class="section_description_5_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_title_6">Title 3</label>
                                    <input type="section_title_6" class="form-control" id="section_title_6" name="section_title_6" placeholder="Title" required value="{{$setting->section_title_6}}">
                                    <span class="section_title_6_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="section_description_6">Description 3</label>
                                    <textarea class="form-control" id="section_description_6" name="section_description_6"  placeholder="Description" rows="5">{{$setting->section_description_6}}</textarea>
                                    <span class="section_description_6_error"></span>
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
        $('#editor').val($('#section_description_1').find('.ql-editor').html());
    });
    var quill = new Quill('#section_description_1', {
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

    $('#add_company').click(function(){
        $('#editor_2').val($('#section_description_2').find('.ql-editor').html());
    });
    var quill = new Quill('#section_description_2', {
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

    $('#add_company').click(function(){
        $('#editor_3').val($('#section_description_3').find('.ql-editor').html());
    });
    var quill = new Quill('#section_description_3', {
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
                        url: ajax_url+"/save-home-setting",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                               window.location.href = ajax_url+"/home-setting";

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