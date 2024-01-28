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
                            <h4 class="card-title">Manage Setting</h4>
                            <form class="forms-sample" method="post" action="{{route('save-setting')}}" id="add_company">
                                @csrf
                                <div class="form-group">
                                    <label for="site_title">Site Title</label>
                                    <input type="site_title" class="form-control" id="site_title" name="site_title" placeholder="Site Title" required value="{{$setting->site_title}}">
                                    <span class="site_title_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo" placeholder="Logo">
                                </div>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.@$setting->logo; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>

                                <div class="form-group">
                                    <label for="email">Contact Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Contact Email" required value="{{$setting->email}}">
                                    <span class="email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Contact Phone Number (Whatsapp Number)</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Contact Phone Number" required value="{{$setting->phone}}">
                                    <span class="phone_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="address">Contact Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Contact Address" required value="{{$setting->address}}">
                                    <span class="address_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="quillExample1">About Us</label>
                                    <div id="quillExample1" style="height: 500px;">
                                    <?php echo $setting->about_us; ?>
                                    </div>
                                    <textarea id="editor" name="description" style="display: none;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="site_description">Footer Site Description</label>
                                    <input type="text" class="form-control" id="site_description" name="site_description" placeholder="Footer Site Description" required value="{{$setting->site_description}}">
                                    <span class="site_description_error"></span>
                                </div>

                                <h5>Manage Social Page Links</h5>

                                <div class="form-group">
                                    <label for="facebook_link">Facebook Page Link</label>
                                    <input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder="Facebook Page Link" value="{{$setting->facebook_link}}">
                                    <span class="facebook_link_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="twitter_link">Twitter Page Link</label>
                                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder="Twitter Page Link" value="{{$setting->twitter_link}}">
                                    <span class="twitter_link_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="youtube_link">Youtube Page Link</label>
                                    <input type="text" class="form-control" id="youtube_link" name="youtube_link" placeholder="Youtube Page Link" value="{{$setting->youtube_link}}">
                                    <span class="youtube_link_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="instagram_link">Instagram Page Link</label>
                                    <input type="text" class="form-control" id="instagram_link" name="instagram_link" placeholder="Instagram Page Link" value="{{$setting->instagram_link}}">
                                    <span class="instagram_link_error"></span>
                                </div>


                                <h5>Manage Working Ours (Footer)</h5>
                                <div class="form-group">
                                    <label for="monday">Monday</label>
                                    <input type="text" class="form-control" id="monday" name="monday" placeholder="Monday Time" value="{{$setting->monday}}">
                                    <span class="monday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="tuesday">Tuesday</label>
                                    <input type="text" class="form-control" id="tuesday" name="tuesday" placeholder="Tuesday Time" value="{{$setting->tuesday}}">
                                    <span class="tuesday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="wednesday">Wednesday</label>
                                    <input type="text" class="form-control" id="wednesday" name="wednesday" placeholder="Wednesday Time" value="{{$setting->wednesday}}">
                                    <span class="wednesday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="thursday">Thursday </label>
                                    <input type="text" class="form-control" id="thursday" name="thursday" placeholder="Thursday Time" value="{{$setting->thursday}}">
                                    <span class="thursday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="friday">Friday</label>
                                    <input type="text" class="form-control" id="friday" name="friday" placeholder="Friday Time" value="{{$setting->friday}}">
                                    <span class="friday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="saturday">Saturday</label>
                                    <input type="text" class="form-control" id="saturday" name="saturday" placeholder="Saturday Time" value="{{$setting->saturday}}">
                                    <span class="saturday_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="sunday">Sunday</label>
                                    <input type="text" class="form-control" id="sunday" name="sunday" placeholder="Sunday Time" value="{{$setting->sunday}}">
                                    <span class="sunday_error"></span>
                                </div>

                                <h5>Copyright Text (Footer)</h5>
                                <div class="form-group">
                                    <label for="footer_copyright_text">Footer Copyright Text</label>
                                    <input type="text" class="form-control" id="footer_copyright_text" name="footer_copyright_text" placeholder="Footer Copyright Text" value="{{$setting->footer_copyright_text}}">
                                    <span class="footer_copyright_text_error"></span>
                                </div>

                                <h5>Manage Header Menu</h5>
                                <div class="form-group">
                                    <label for="header_phone">Header Phone Number</label>
                                    <input type="text" class="form-control" id="header_phone" name="header_phone" placeholder="Header Phone Number" value="{{$setting->header_phone}}">
                                    <span class="header_phone_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="header_email">Header Email</label>
                                    <input type="text" class="form-control" id="header_email" name="header_email" placeholder="Header Email" value="{{$setting->header_email}}">
                                    <span class="header_email_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="header_home_menu">Header Home Menu Name</label>
                                    <input type="text" class="form-control" id="header_home_menu" name="header_home_menu" placeholder="Header Home Menu Name" value="{{$setting->header_home_menu}}">
                                    <span class="header_home_menu_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="header_service_menu">Header Service Menu Name</label>
                                    <input type="text" class="form-control" id="header_service_menu" name="header_service_menu" placeholder="Header Service Menu Name" value="{{$setting->header_service_menu}}">
                                    <span class="header_service_menu_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="header_blog_menu">Header Blog Menu Name</label>
                                    <input type="text" class="form-control" id="header_blog_menu" name="header_blog_menu" placeholder="Header Blog Menu Name" value="{{$setting->header_blog_menu}}">
                                    <span class="header_blog_menu_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="header_about_menu">Header About Us Menu Name</label>
                                    <input type="text" class="form-control" id="header_about_menu" name="header_about_menu" placeholder="Header About Us Menu Name" value="{{$setting->header_about_menu}}">
                                    <span class="header_about_menu_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="header_contact_menu">Header Contact Us Menu Name</label>
                                    <input type="text" class="form-control" id="header_contact_menu" name="header_contact_menu" placeholder="Header Contact Us Menu Name" value="{{$setting->header_contact_menu}}">
                                    <span class="header_contact_menu_error"></span>
                                </div>
                                <h5>Home Slider Image</h5>
                                <div class="form-group">
                                    <label for="image">Slider Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Slider image">
                                </div>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.@$setting->image; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>
                                <div class="form-group">
                                    <label for="slider_text">Slider Text</label>
                                    <input type="text" class="form-control" id="slider_text" name="slider_text" placeholder="Slider Text" value="{{$setting->slider_text}}">
                                    <span class="slider_text_error"></span>
                                </div>


                                <div class="form-group">
                                    <label for="image_2">Slider Image 2</label>
                                    <input type="file" class="form-control" id="image_2" name="image_2" placeholder="Slider image 2">
                                </div>
                                <?php if(!empty($setting->image_2)) { ?>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.@$setting->image_2; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="slider_text_2">Slider Text 2</label>
                                    <input type="text" class="form-control" id="slider_text_2" name="slider_text_2" placeholder="Slider Text" value="{{$setting->slider_text_2}}">
                                    <span class="slider_text_2_error"></span>
                                </div>


                                <div class="form-group">
                                    <label for="image_3">Slider Image 3</label>
                                    <input type="file" class="form-control" id="image_3" name="image_3" placeholder="Slider image">
                                </div>
                                <?php if(!empty($setting->image_3)) { ?>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.@$setting->image_3; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="slider_text_3">Slider Text 3</label>
                                    <input type="text" class="form-control" id="slider_text_3" name="slider_text_3" placeholder="Slider Text" value="{{$setting->slider_text_3}}">
                                    <span class="slider_text_3_error"></span>
                                </div>



                                <div class="form-group">
                                    <label for="image_4">Slider Image 4</label>
                                    <input type="file" class="form-control" id="image_4" name="image_4" placeholder="Slider image">
                                </div>
                                <?php if(!empty($setting->image_4)) { ?>
                                <div class="form-group">
                                <img src="<?php echo url('/public').'/'.@$setting->image_4; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                </div>
                                <?php }?>
                                <div class="form-group">
                                    <label for="slider_text_4">Slider Text 4</label>
                                    <input type="text" class="form-control" id="slider_text_4" name="slider_text_4" placeholder="Slider Text" value="{{$setting->slider_text_4}}">
                                    <span class="slider_text_4_error"></span>
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
                        url: ajax_url+"/save-setting",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                               window.location.href = ajax_url+"/setting";

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