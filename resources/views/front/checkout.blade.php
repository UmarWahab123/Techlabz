@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .thumb img{
        text-align: center;
    }
    .main-content-area article .post-excerpt .mascot-post-excerpt {
        font-size: 0.97rem;
    }
    .tm-sc-blog.blog-style1-current-theme article .entry-content .entry-meta {
        font-size: 28px;
        margin-bottom: 0px;
        padding-top: 0px;
        margin-top: 0px;
    }
    .tm-sc-blog.blog-style1-current-theme article .entry-content{
        padding: 20px 30px 30px 30px;
    }
    .modal-confirm {		
	color: #434e65;
	width: 525px;
}
.modal-confirm .modal-content {
	padding: 20px;
	font-size: 16px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	background: #47c9a2;
	border-bottom: none;   
	position: relative;
	text-align: center;
	margin: -20px -20px 0;
	border-radius: 5px 5px 0 0;
	padding: 35px;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 36px;
	margin: 10px 0;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: 15px;
	right: 15px;
	color: #fff;
	text-shadow: none;
	opacity: 0.5;
}
.modal-confirm .close:hover {
	opacity: 0.8;
}
.modal-confirm .icon-box {
	color: #fff;		
	width: 95px;
	height: 95px;
	display: inline-block;
	border-radius: 50%;
	z-index: 9;
	border: 5px solid #fff;
	padding: 15px;
	text-align: center;
}
.modal-confirm .icon-box i {
	font-size: 64px;
	margin: -4px 0 0 -4px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #eeb711 !important;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border-radius: 30px;
	margin-top: 10px;
	padding: 6px 20px;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #eda645 !important;
	outline: none;
}
.modal-confirm .btn span {
	margin: 1px 3px 0;
	float: left;
}
.modal-confirm .btn i {
	margin-left: 1px;
	font-size: 20px;
	float: right;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
   </style>
@endsection
@section('content')

<div class="main-content-area">
    <!-- Section: inner-header -->
    <section class="page-title divider layer-overlay overlay-dark-8 section-typo-light bg-img-center">
        <div class="container pt-90 pb-90">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row ">
                    <div class="col-md-12 text-center">
                        <h2 class="title text-white">Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
    <div class="container">
      <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-muted">Product Information</span>
              </h4>
              <ul class="list-group mb-3">
                <?php
                    $total_price = 0;
                        if(!empty($product_list)) { 
                        foreach ($product_list as $key => $product) {
                    ?>
                  <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                          <p class="my-0"><b>{{ @$product['product']->title }} ( <strong style="font-weight: 600;">£{{@$product['product']->price}})</b></strong> </p>
                          <!-- <small class="text-muted">{@{$product->title}}</small> -->
                          <?php if(!empty(@$product['disk'])) { ?>
                          <div class="attributes">Hard Disk: <strong style="font-weight: 600;">{{ @$product['disk']->name }} 
                            <?php if(@$product['disk']->price > 0) { ?>    
                                (+£{{@$product['disk']->price}})
                            <?php } else {?>
                                (Included)
                            <?php }?>
                                        </strong></div>
                                        <?php }?>

                                        <?php if(!empty(@$product['ram'])) { ?>
                            <div class="attributes">Ram: <strong style="font-weight: 600;">{{@$product['ram']->name}} <?php if(@$product['ram']->price > 0) { ?>    
                                    (+£{{@$product['ram']->price}})
                                <?php } else {?>
                                    (Included)
                                <?php }?></strong></div>
                                <?php }?>
                                <?php if(!empty(@$product['warrenty'])) { ?>
                                <div class="attributes">Warranty: <strong style="font-weight: 600;">{{@$product['warrenty']->name}} <?php if(@$product['warrenty']->price > 0) { ?>    
                                    (+£{{@$product['warrenty']->price}})
                                <?php } else {?>
                                    (Included)
                                <?php }?></strong></div>
                                <?php }?>
                                <?php if(!empty(@$product['os'])) { ?>
                                <div class="attributes">Operating System: <strong style="font-weight: 600;">{{@$product['os']->name}} <?php if(@$product['os']->price > 0) { ?>    
                                    (+£{{@$product['os']->price}})
                                <?php } else {?>
                                    (Included)
                                <?php }?></strong></div><?php }?>
                      </div>
                      <!-- <span class="text-muted"style="width: 80px;"><i class="fa fa-gbp"></i>190</span> -->
                  </li>
                  <li class="list-group-item d-flex justify-content-between border-top-0">
                      <span><i class="fa fa-gbp"></i> <?php echo @$product['product']->price + @$product['disk']->price + @$product['ram']->price + @$product['warrenty']->price + @$product['os']->price  ?> x {{@$product['quantity']}}</span>
                      <strong style="font-weight: 600;"><i class="fa fa-gbp"></i> <?php $price =  @$product['product']->price + @$product['disk']->price + @$product['ram']->price + @$product['warrenty']->price + @$product['os']->price; echo $price * $product['quantity'];  $total_price += $price * $product['quantity']; ?></strong>
                  </li>
                <?php } }?>
                  <li class="list-group-item d-flex justify-content-between">
                      <span>Total (GBP)</span>
                      <strong  style="font-weight: 600;"><i class="fa fa-gbp"></i>{{$total_price}}</strong>
                  </li>
              </ul>
          </div>
          <div class="col-md-8 order-md-1">
                <div id="billing_form">
              <h4 class="mb-3">Billing address</h4>
              <hr class="mb-4">
              <form class="needs-validation" id="add_company">
                    @csrf
                    <input type="hidden" name="product_id" value="{{@$product->id}}">
                  <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="first_name">First name</label>
                          <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{Auth::user()->name}}" required>
                      </div>
                      <div class="col-md-6 mb-3">
                          <label for="last_name">Last name</label>
                          <input type="text" class="form-control" id="last_name" name="last_name" placeholder=" Last Name" value="" required>
                      </div>
                  </div>
                  <div class="mb-3">
                      <label for="email">Email <span class="text-muted"></span>
                      </label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required value="{{Auth::user()->email}}">
                  </div>
                  <div class="mb-3">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" placeholder="1234 Main St" required name="address" value="{{Auth::user()->address}}">
                  </div>
                  <div class="mb-3">
                      <label for="address2">Address 2 <span class="text-muted">(Optional)</span>
                      </label>
                      <input type="text" class="form-control" id="address2" name="address_2" placeholder="Apartment or suite">
                  </div>
                  <div class="row">
                      <div class="col-md-5 mb-3">
                          <label for="country">Country</label>
                          <select class="custom-select d-block w-100 form-control" id="country" name="country" required>
                              <option value="">Choose...</option>
                              <option value="UK" <?php if(Auth::user()->country == 'UK') { echo "selected"; } ?> >United Kingdom</option>
                          </select>
                      </div>
                      <div class="col-md-4 mb-3">
                          <label for="state">State</label>
                          <input type="text" class="form-control" id="state" name="state" placeholder="County/State" required value="{{Auth::user()->state}}">
                      </div>
                      <div class="col-md-3 mb-3">
                          <label for="zip">ZipCode</label>
                          <input type="text" class="form-control" id="zip" name="zip" value="{{Auth::user()->zipcode}}" placeholder="" required>
                      </div>
                  </div>
                  
                  <button class="btn btn-theme-colored1 btn-sm" type="submit" id="add_company_button">Checkout</button>
              </form>
            </div>
            <div id="payment_form" style="display:none">
                <h4 class="mb-3">Complete Payment</h4>
                <hr class="mb-4">
                <div id="paypal-button-container"></div>
                <input type="hidden" id="reference_id" />
            </div>
          </div>
      </div>
  </div>
    </section>
    <div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body text-center">
				<h4>Great!</h4>	
				<p>Order Created Successfully.</p>
			</div>
		</div>
	</div>
</div> 

</div>

@endsection

@section('script-bottom')

<!-- TEST -->
<script src="https://www.paypal.com/sdk/js?client-id=AecsprbyFCSImlXXfVvSBsFHiNgra5mnKFLB56rQyu9TBTAqAK2y-V8NXfa_c2Om-mKq2IrKK6GRpxN9&currency=GBP&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script>

<!-- LIVE -->
<!-- <script src="https://www.paypal.com/sdk/js?client-id=AU8D46tdadA5xs1nWeM6EJKDo1tOTLhzYkVddu4-es-Hr6iSaVaL_6sRzY-yxtBEBSQqi2bvLSLjBVut&currency=GBP&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script> -->


        <script>
          const paypalButtonsComponent = paypal.Buttons({
              // optional styling for buttons
              // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
              style: {
                color: "gold",
                shape: "rect",
                layout: "vertical"
              },

              // set up the transaction
              createOrder: (data, actions) => {
                  // pass in any options from the v2 orders create call:
                  // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                  const createOrderPayload = {
                      purchase_units: [
                          {
                            reference_id: $('#reference_id').val(),
                            amount: {
                                value: "<?php echo @$total_price ?>"
                            }
                          }
                      ]
                  };

                  return actions.order.create(createOrderPayload);
              },

              // finalize the transaction
              onApprove: (data, actions) => {
                  const captureOrderHandler = (details) => {
                      const payerName = details.payer.name.given_name;
                      console.log(details)
                      complete_payment(details)
                      console.log('Transaction completed');
                  };

                  return actions.order.capture().then(captureOrderHandler);
              },

              // handle unrecoverable errors
              onError: (err) => {
                toastr.error('An error prevented the buyer from checking out with PayPal', '', {
                                "progressBar": true,
                                "positionClass": "toast-top-center",
                                "showDuration": "10000",
                                "hideDuration": "10000",
                                "timeOut": "10000",
                                "extendedTimeOut": "10000",
                            });
              }
          });

          paypalButtonsComponent
              .render("#paypal-button-container")
              .catch((err) => {
                  console.error('PayPal Buttons failed to render');
              });
        </script>
<script>

function complete_payment(response) {

    $('.loading_1').show();
    formData = new FormData();
    formData.append( 'info', JSON.stringify(response));
    formData.append( 'transaction_id', response.id);
    formData.append( 'status', response.status);
    formData.append( 'reference_id',  $('#reference_id').val());
    $.ajax({
        data: formData,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: ajax_url+"/complete-payment",
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            
            if(response.status) {
                console.log(response)  
                $('.loading_1').hide(); 
                toastr.success('Order Created Successfully!', '', {
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "showDuration": "10000",
                    "hideDuration": "10000",
                    "timeOut": "10000",
                    "extendedTimeOut": "10000",
                });

                setTimeout(function () {
                    window.location.href = "{{ route('homepage')}}";
                 }, 5000);
            } else {
                
                toastr.error('Something went wrong!', '', {
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "showDuration": "10000",
                    "hideDuration": "10000",
                    "timeOut": "10000",
                    "extendedTimeOut": "10000",
                });

            }
                
        },
        error: function(response) {
            toastr.error('Something went wrong!', '', {
                "progressBar": true,
                "positionClass": "toast-top-center",
                "showDuration": "10000",
                "hideDuration": "10000",
                "timeOut": "10000",
                "extendedTimeOut": "10000",
            });
        }
    });

}


$(function() {
        $("#add_company").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_company_button'));
                l.start();
                var formData = new FormData($('#add_company')[0]);
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/create-order",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();

                        if(response.status) {
                            console.log(response)   
                            $('#billing_form').hide();
                            $('#payment_form').show();

                            $('#reference_id').val(response.data.uuid)
                        } else {
                            
                            toastr.error('Something went wrong!', '', {
                                "progressBar": true,
                                "positionClass": "toast-top-center",
                                "showDuration": "10000",
                                "hideDuration": "10000",
                                "timeOut": "10000",
                                "extendedTimeOut": "10000",
                            });

                        }
                           
                    },
                    error: function(response) {
                        l.stop();
                        toastr.error('Something went wrong!', '', {
                            "progressBar": true,
                            "positionClass": "toast-top-center",
                            "showDuration": "10000",
                            "hideDuration": "10000",
                            "timeOut": "10000",
                            "extendedTimeOut": "10000",
                        });
                    }
                });
            }
        });
    });
</script>

     
@endsection