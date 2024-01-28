@extends('front.layouts.master')

@section('css')
   <style>
    p {
        margin-bottom: 0;
    }
    .icon-type-image{
        height: 180px !important;
        width: 180px  !important;
    }
    table {
  border: 1px solid #ccc;
  border-collapse: collapse;
  margin: 0;
  padding: 0;
  width: 100%;
  table-layout: fixed;
}

table caption {
  font-size: 1.5em;
  margin: .5em 0 .75em;
}

table tr {
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  padding: .35em;
}

table th,
table td {
  padding: .625em;
  text-align: center;
}

table th {
  font-size: .85em;
  letter-spacing: .1em;
  text-transform: uppercase;
}

@media screen and (max-width: 600px) {
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: .625em;
  }
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}














/* general styling */
body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.25;
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
                        <h2 class="title text-white">Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="section-content">
                <div class="row justify-content-center">
                    <table id="cart" class="">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                            $total_price = 0;
                             if(!empty($product_list)) { 

                                
                                foreach ($product_list as $key => $product) {
                            ?>
                            <tr scope="row" data-id="{{$product['product']->id}}">
                                <td data-th="Product" >
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="<?php echo url('/public').'/'.$product['product']->image; ?>" width="100" height="100" class="img-responsive"/></div>
                                        <div class="col-sm-9">
                                            <h6>{{ @$product['product']->title }} ( £{{@$product['product']->price}})</h6>
                                            
                                            <?php if(!empty(@$product['disk'])) { ?>
                                                <div class="attributes">Hard Disk: <strong style="font-weight: 600;">{{ @$product['disk']->name }} 
                                                    <?php if(@$product['disk']->price > 0) { ?>    
                                                        (+£{{@$product['disk']->price}})
                                                    <?php } else {?>
                                                        (Included)
                                                    <?php }?>
                                                    </strong>
                                                </div>
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
                                            <?php }?></strong></div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price"><b>£ <?php echo @$product['product']->price + @$product['disk']->price + @$product['ram']->price + @$product['warrenty']->price + @$product['os']->price  ?> </b></td>
                                <td data-th="Quantity">
                                    <input type="number" value="{{@$product['quantity']}}" class="form-control quantity " />
                                </td>
                                <td data-th="Subtotal">£ <?php $price =  @$product['product']->price + @$product['disk']->price + @$product['ram']->price + @$product['warrenty']->price + @$product['os']->price; echo $price * $product['quantity'];  $total_price += $price * $product['quantity']; ?> </td>
                                <td class="actions">
                                    <button class="btn btn-primary btn-sm update-cart "><i class="fa fa-edit"></i></button>
                                    
                                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                                    
                                </td>
                            </tr>
                            <?php } }else {?>
                               <tr scope="row">
                                    <td colspan="5" class="text-center"><h5>No Product In Cart</h5></td>
                               </tr> 
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr scope="row">
                                <td colspan="5" class="text-right"><h5><strong>Total : £{{$total_price}}</strong></h5></td>
                            </tr>
                            <tr scope="row">
                                <td colspan="5" class="text-right">
                                    <a href="{{ url('/') }}" class="btn btn-theme-colored1 btn-sm">Continue Shopping</a>
                                    <?php if(!empty($product_list)) {  ?>
                                        <a class="btn btn-theme-colored1 btn-sm" href="{{route('checkout')}}">Checkout</a>
                                    <?php }?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection

@section('script-bottom')

<script type="text/javascript">
  
  $(".update-cart").on('click',function (e) {
      e.preventDefault();

      var ele = $(this);

      $.ajax({
          url: "{{ route('update.cart') }}",
          method: "patch",
          data: {
              _token: '{{ csrf_token() }}', 
              id: ele.closest("tr").data("id"), 
              quantity: ele.closest("tr").find(".quantity").val()
          },
          success: function (response) {
            toastr.success("Cart Updated Successfully!", '', {
                "progressBar": true
            });

            setTimeout(function () {
                window.location.reload();
            }, 4000);

          }
      });
  });

  $(".remove-from-cart").click(function (e) {
      e.preventDefault();

      var ele = $(this);

      if(confirm("Are you sure want to remove?")) {
          $.ajax({
              url: "{{ route('remove.from.cart') }}",
              method: "DELETE",
              data: {
                  _token: '{{ csrf_token() }}', 
                  id: ele.parents("tr").attr("data-id")
              },
              success: function (response) {
                  toastr.success("Product Removed from Cart Successfully!", '', {
                        "progressBar": true
                    });

                    setTimeout(function () {
                        window.location.reload();
                    }, 4000);
              }
          });
      }
  });

</script>

@endsection