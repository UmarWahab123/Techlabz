@extends('super_admin.layouts.master')

@section('content')
<style>
    .table td img, .jsgrid .jsgrid-table td img {
        width: 100px;
        height: 100px;
    }

</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Order Detail</p>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-orders')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-12">
                        <div class="card px-2">
                            <div class="card-body">
                                <div class="container-fluid d-flex justify-content-between row">
                                    <div class="col-lg-3 ps-0 col-12">
                                    <p class="mt-5"><b>{{$order->first_name}} {{$order->last_name}}</b></p>
                                    <p class="mb-2"><b>{{$order->email}}</b></p>
                                    <p>{{$order->address}},<br>{{$order->address_2}},<br>{{$order->state}}, {{$order->zip_code}}, {{$order->country}}</p>
                                    </div>
                                    <div class="col-lg-3 pr-0 col-12">
                                    <p class="mt-5 mb-2 text-right"><b>Payment Info</b></p>
                                    <p class="text-right">Paypal,<br> {{$order->transaction_id}},<br> <?php 
                                     $checked= '';
                                     if($order->payment_status == 2) {
                                         $checked = '<span class="badge badge-success">Completed</span>';
                                     } else if($order->payment_status == 3) {
                                         $checked = '<span class="badge badge-danger">Failed</span>';
                                     }
                                    echo $checked;
                                    ?></p>
                                    </div>
                                </div>
                                <div class="container-fluid d-flex justify-content-between">
                                    <div class="col-lg-5 ps-0">
                                    <p class="mb-0 mt-5">Created Date : <?php echo date('Y-m-d g:i A',strtotime($order->created_at)); ?></p>
                                    </div>
                                </div>
                                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                                    <div class="table-responsive w-100">
                                        <table class="table">
                                        <thead>
                                            <tr class="bg-dark text-white">
                                                
                                                <th>Product Name</th>
                                                <th class="text-right">Price</th>
                                                <th>QTY</th>
                                                <th class="text-right">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $total_price = 0;
                                            if(!empty(@$order)) { 
                                                foreach (@$order->items as $key => $product) {
                                            ?>
                                            <tr data-id="{{$product->product->id}}">
                                                <td data-th="Product" >
                                                    <div class="row">
                                                        <div class="col-sm-3 hidden-xs"><img src="<?php echo url('/public').'/'.$product->product->image; ?>" width="100" height="100" class="img-responsive"/></div>
                                                        <div class="col-sm-9">
                                                            <h4>{{ @$product->product->title }} ( £{{@$product->product->price}})</h4>
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
                                            <?php } }?>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="container-fluid mt-5 w-100">
                                    <h4 class="text-right mb-5">Total : £ {{@$total_price}}</h4>
                                    <hr>
                                </div>
                                <div class="container-fluid w-100">
                                    <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <label> Add Tracking Url</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="tracking" placeholder="Tracking Url" required value="{{$order->tracking}}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit" id="add_company_button">Submit</button>
                                        </div>
                                    </div>
                                    <label id="tracking-error" class="error text-danger" for="tracking" style="display: none;">This field is required.</label>
                                    </form>
                                </div>
                                <button class="btn btn-primary" type="submit" data-id="{{$order->id}}" onclick="delete_post(this)">Mark As Complete This order</button>
                            </div>
                            
                        </div>
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
                        url: ajax_url+"/save-order",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                                location.reload();

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

        function delete_post(obj){
            console.log()
            $.confirm({
                title: 'Confirm!',
                content: 'Are you sure you want to change order status as Completed!',
                buttons: {
                    confirm: {
                        text: 'Yes',
                        btnClass: 'btn btn-success',
                        keys: ['enter'],
                        action: function(e) {
                            let self = this;
                            self.showLoading();
                            $.ajax({
                                type: 'POST',
                                url: ajax_url+'/complete-order',
                                data: {
                                    'id': $(obj).data('id'),
                                    '_token': $('meta[name="csrf-token"]').attr('content'),
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.status) {
                                        location.reload();
                                        toastr.success(response.message, '', {
                                            "progressBar": true
                                        });
                                        self.close();
                                    } 
                                },
                                error: function(response) {
                                    toastr.error("Something went wrong", '', {
                                        "progressBar": true
                                    });
                                }
                            });
                        }
                    },
                    cancel: function() {
                        return true;
                    }
                }
            });
            
        }

    </script>
@endsection 




