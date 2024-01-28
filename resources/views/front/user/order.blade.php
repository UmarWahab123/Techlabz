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

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="style_link" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();" href="javascript:void(0);">
                                    <span class="align-middle">Log Out</span>
                                </a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <h6>My Orders</h6>
                                
                                    <div class="table-responsive w-100">
                                        <table class="table">
                                            <thead>
                                                <tr class="">
                                                    <th width="50%">Product Name</th>
                                                    <th  width="20%">Price</th>
                                                    <th width="10%">QTY</th>
                                                    <th  width="20%">Total Price</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                            <?php
                                                $total_price = 0;
                                                if(!empty(@$order_info)) {
                                                    foreach (@$order_info as $key => $order) { 
                                                    foreach (@$order->items as $key => $product) {
                                                ?>
                                                <tr data-id="{{$product->product->id}}">
                                                <td data-th="Product" >
                                                    <div class="row">
                                                        <div class="col-sm-3 hidden-xs"><img src="<?php echo url('/public').'/'.$product->product->image; ?>" width="100" height="100" class="img-responsive"/></div>
                                                        <div class="col-sm-9">
                                                            <p>{{ @$product->product->title }} ( £{{@$product->product->price}})</p>
                                                            <?php if(!empty(@$product->harddisk)) { ?>
                                                            <div class="attributes">Hard Disk: {{ @$product->harddisk->name }} 
                                                            <?php if(@$product->harddisk->price > 0) { ?>    
                                                                (+£{{@$product->harddisk->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?>
                                                                        </div>
                                                                        <?php }?>
                                                            <?php if(!empty(@$product->ram)) { ?>
                                                            <div class="attributes">Ram: {{@$product->ram->name}} <?php if(@$product->ram->price > 0) { ?>    
                                                                (+£{{@$product->ram->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?></div>
                                                            <?php }?>
                                                            <?php if(!empty(@$product->warrenty)) { ?>
                                                            <div class="attributes">Warranty: {{@$product->warrenty->name}} <?php if(@$product->warrenty->price > 0) { ?>    
                                                                (+£{{@$product->warrenty->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?></div>
                                                            <?php }?>

                                                            <?php if(!empty(@$product->os)) { ?>
                                                            <div class="attributes">Operating System: {{@$product->os->name}} <?php if(@$product->os->price > 0) { ?>    
                                                                (+£{{@$product->os->price}})
                                                            <?php } else {?>
                                                                (Included)
                                                            <?php }?></div>
                                                            <?php }?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-th="Price"><b>£ <?php echo @$product->product->price + @$product->disk->price + @$product->ram->price + @$product->warrenty->price + @$product->os->price  ?> </b></td>
                                                <td data-th="Quantity">
                                                    {{@$product->quantity}}
                                                </td>
                                                <td data-th="Subtotal" class="text-center"><b>£ <?php $price =  @$product->product->price + @$product->disk->price + @$product->ram->price + @$product->warrenty->price + @$product->os->price; echo $price * $product->quantity;  $total_price += $price * $product->quantity; ?> </b></td>
                                            </tr>
                                                <?php } } } else {} ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <div class="container-fluid w-100">
                                        <h5 class="text-right">Total : £ 599.98</h5>
                                    </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection 