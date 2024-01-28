@extends('front.layouts.master')

@section('content')
<style>
    .style_link {
        text-decoration: none;
        display: block;
        width: 100%;
        height: 100%;
    }
</style>
<!-- <div class="container-fluid page-body-wrapper full-page-wrapper" style="background-color: #f5f7ff;">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0 mt-50 mb-50">
            <div class="col-lg-5 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5 bg-white">
                    <div class="text-center">
                        <div class="brand-logo">
                            <h3>User Dashboard</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<section style="background-color: #f5f7ff;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <?php if(!empty(Auth::user()->image)) { ?>
                        <img src="<?php echo url('/public').'/'.Auth::user()->image; ?>"  class="rounded-circle img-fluid" style="width: 130px; height: 130px;">
                            <?php } else {?>
                        <img src="https://i.pinimg.com/474x/0a/a8/58/0aa8581c2cb0aa948d63ce3ddad90c81.jpg"  class="rounded-circle img-fluid" style="width: 130px; height: 130px;">
                        <?php }?>
                        <h5 class="my-3">{{Auth::user()->name}}</h5>
                        <p class="text-muted mb-1">{{Auth::user()->email}}</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item p-3 <?php if(\Request::route()->getName() == 'user.dashboard') {echo 'active'; } ?>">
                                <a class="style_link <?php if(\Request::route()->getName() == 'user.dashboard') {echo 'text-white'; } ?>" href="{{route('user.dashboard')}}">Dashboard</a>
                            </li>
                            <li class="list-group-item p-3 <?php if(\Request::route()->getName() == 'user.profile') {echo 'active'; } ?>">
                                <a class="style_link <?php if(\Request::route()->getName() == 'user.profile') {echo 'text-white'; } ?>" href="{{route('user.profile')}}">Edit Profile</a>
                            </li>
                            <li class="list-group-item p-3 <?php if(\Request::route()->getName() == 'user.order') {echo 'active'; } ?>">
                                <a class="style_link <?php if(\Request::route()->getName() == 'user.order') {echo 'text-white'; } ?>" href="{{route('user.order')}}">My Orders</a>
                            </li>
                            <!-- <li class="list-group-item p-3 <?php if(\Request::route()->getName() == 'user.wishlist') {echo 'active'; } ?>">
                                <a class="style_link <?php if(\Request::route()->getName() == 'user.wishlist') {echo 'text-white'; } ?>" href="{{route('user.wishlist')}}">My Wishlist</a>
                            </li> -->
                            <li class="list-group-item p-3">
                                <a class="style_link" href="javascript:;">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form class="forms-sample" method="post" id="add_company">
                                @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="first_name">Name</label>
                                <input type="text" class="form-control" id="first_name" name="name" placeholder="Name" required value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted"></span>
                            </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" disbaled readonly value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Profile image">
                        </div>
                        <div class="mb-3">
                            <label for="address2">Phone</label>
                            <input type="text" class="form-control" id="address2" name="phone" placeholder="Phone" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="" name="address" value="{{ Auth::user()->address }}">
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="country">Country</label>
                                <select class="custom-select d-block w-100 form-control" id="country" name="country" required="">
                                    <option value="">Choose...</option>
                                    <option value="UK" <?php if(Auth::user()->country == 'UK') { echo "selected"; } ?>>United Kingdom</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="County/State" required value="{{ Auth::user()->state }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="zip">ZipCode</label>
                                <input type="text" class="form-control" id="zip" name="zipcode" placeholder="" required value="{{ Auth::user()->zipcode }}">
                            </div>
                        </div>
                        
                        <button class="btn btn-theme-colored1 btn-sm ladda-button" data-style="expand-right" id="add_company_button"  type="submit">Save</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection 


@section('script-bottom')
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
                        url: ajax_url+"/user/save-profile",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });

                                setTimeout(function() {
                                    location.reload();
                                }, 2500);

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