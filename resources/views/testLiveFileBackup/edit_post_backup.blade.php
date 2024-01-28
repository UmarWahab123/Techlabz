@extends('super_admin.layouts.master')
<script src="{{ URL::asset('assets/temporary/quill.snow.css')}}"></script>

@section('content')

<style>
    .error{
        color: red;
    }
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background-color: #4b49ac;
    }

</style>



<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php if(!empty($blog->id)) {?>
                    <p class="card-title">Edit Product</p>
                    <?php } else {?>
                        <p class="card-title">Add Product</p>
                        <?php }?>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-sales-product')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <?php if(!empty($blog->id)) {?>
                    <ul class="nav nav-tabs nav-pills nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="spec-tab" data-toggle="tab" href="#spec" role="tab" aria-controls="spec"
                                aria-selected="true">General</a>
                        </li>
                        <?php if(!empty($blog->id)) {?>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                aria-selected="true">Product Images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info"
                                aria-selected="true">Product Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addon-tab" data-toggle="tab" href="#addon" role="tab" aria-controls="addon"
                                aria-selected="true">Product Add On</a>
                        </li>
                        <?php }?>
                    </ul>
                    <?php }?>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="spec" role="tabpanel" aria-labelledby="spec-tab">
                            <div class="row">
                                <div class="col-12 col-md-8 offset-md-2">
                                    <h3 class="mb-4">Product Information</h3>
                                    <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                        @csrf
                                        <input type="hidden" name="id" value="{{@$blog->id}}">
                                        <div class="form-group">
                                            <label for="title">Product Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Product Title" required  value="{{@$blog->title}}">
                                            <span class="title_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="slug">Product Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Product Slug" required  value="{{@$blog->slug}}">
                                            <span class="slug_error"></span>
                                        </div>


                                        <div class="form-group">
                                            <label for="service_id">Category</label>
                                            <select class="form-control" id="service_id" name="service_id" required>
                                                <option value=""> Select Category </option>
                                                <?php foreach ($main_service as $service) {
                                                    ?>
                                                    <option value="{{@$service->id}}" <?php if(@$service->id == @$blog->service_id) { echo "selected"; } ?>> {{@$service->title}} </option>

                                                <?php }?>
                                            </select>
                                            <span class="service_id_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="service_id">Sub Category</label>
                                            <select class="form-control" id="service_id" name="sub_service_id">
                                                <option value=""> Select Sub Category </option>
                                                <?php foreach ($sub_service as $sub_service) {
                                                    ?>
                                                    <option value="{{@$sub_service->id}}" <?php if(@$sub_service->id == @$blog->sub_service_id) { echo "selected"; } ?>> {{@$sub_service->title}} </option>

                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="brand_id">Brand</label>
                                            <select class="form-control" id="brand_id" name="brand_id" required>
                                            <option value=""> Select Brand </option>
                                                <?php foreach ($brand as $brand_li) {
                                                    ?>
                                                    <option value="{{@$brand_li->id}}" <?php if(@$brand_li->id == @$blog->brand_id) { echo "selected"; } ?>> {{@$brand_li->title}} </option>
                                                <?php }?>
                                            </select>
                                            <span class="brand_id_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Featured Product Image</label>
                                            <input type="file" class="form-control" id="image" name="image" placeholder="Post image">
                                        </div>
                                        <?php if(!empty($blog->image)) { ?>
                                            <div class="form-group">
                                            <img src="<?php echo url('/public').'/'.@$blog->image; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                            </div>
                                        <?php } ?>

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

                                        <div class="form-group">
                                            <label for="metpricea_title">Price</label>
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Price"  value="{{@$blog->price}}">
                                            <span class="price_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description"  value="{{@$blog->short_description}}">
                                            <span class="short_description_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="metpricea_title">Product Grade</label>
                                            <input type="text" class="form-control" id="grade" name="grade" placeholder="Grade"  value="{{@$blog->grade}}">
                                            <span class="grade_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="metpricea_title">Product Processer Family</label>
                                            <input type="text" class="form-control" id="processer" name="processer" placeholder="Processer"  value="{{@$blog->processer}}">
                                            <span class="processer_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="metpricea_title">Product Tags</label>
                                            <input type="text" class="form-control" id="tags" name="tags" placeholder="Add tags with comma seprated like tag1,tag2,tag3"  
                                            value="<?php if(!empty(@$blog->tags)) {
                                              $t = array();
                                              foreach (@$blog->tags as $key => $val) {
                                                $t[] = $val->tag_name;
                                              }
                                              echo implode(',',$t);
                                            } ?>">
                                        </div>


                                        <button type="submit" class="btn btn-primary mr-2 ladda-button" data-style="expand-right" id="add_company_button">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-12 col-md-8 offset-md-2">
                                    <h3 class="mb-4">Product Images</h3>
                                    <form class="forms-sample" method="post" action="javascript:void(0)" id="product_images" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{@$blog->id}}">
                                        <div class="form-group">
                                            <label for="image">Product Images</label>
                                            <input type="file" class="form-control" id="images" name="images[]" placeholder="Post images" multiple>
                                        </div>
                                        
                                        <div class="row">

                                        <?php if(!empty($blog->images)) { 
                                            foreach ($blog->images as $key => $value) {
                                            ?>
                                            <div class="col-sm-12 col-md-4 image">
                                                <button type="button" class="btn btn-danger btn-icon float-right" data-id="{{@$value->id}}" onclick="delete_post(this)" ><i class="mdi mdi-delete-outline" aria-hidden="true"></i></button>
                                                <div class="form-group">
                                                    <img src="<?php echo url('/public').'/'.@$value->image; ?>" alt="Generic placeholder image" width="200" class="ml-lg-1 order-1 order-lg-2 img-thumbnail	">
                                                </div>
                                            </div>
                                        <?php } }?>
                                            </div>

                                        <button type="submit" class="btn btn-primary mr-2 ladda-button" data-style="expand-right" id="add_image_button">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="info" role="tabpanel" aria-labelledby="info-tab">
                            <div class="row">
                                <div class="col-12 col-md-8 offset-md-2">
                                    <h3 class="mb-4">Product Description & Specification</h3>
                                    <form class="forms-sample" method="post" action="javascript:void(0)" id="add_description">
                                        @csrf
                                        <input type="hidden" name="id" value="{{@$blog->id}}">
                                        <div class="form-group" id="full-container" style="height:200;">
                                            <label for="exampleFormControlTextarea1">Specification</label>
                                            <div id="full-container">
                                                <div class="editor">
                                                <?=(isset($blog->specification) ? $blog->specification : '')?>

                                                </div>
                                            </div>
                                            <textarea class="form-control d-none" name="specification">{{(isset($blog->specification) ? $blog->specification : '')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="quillExample1">Specification</label>
                                            <textarea id="editor" name="specification"><?php echo @$blog->specification;  ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="quillExample1">Description</label>
                                            <textarea id="description" name="description"><?php echo @$blog->description;  ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="quillExample1">Grading Info</label>
                                            <textarea id="grading" name="grading"><?php echo @$blog->grading;  ?></textarea>
                                        </div>
                                        <div class="form-group">Others
                                            <label for="quillExample1"></label>
                                            <textarea id="other" name="others"><?php echo @$blog->others;  ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2 ladda-button" data-style="expand-right" id="add_description_button">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="addon" role="tabpanel" aria-labelledby="addon-tab">
                            <div class="row">
                                <div class="col-12 col-md-8 offset-md-2">
                                    <h3 class="mb-4">Product Add Ons</h3>
                                    <form class="forms-sample" method="post" action="javascript:void(0)" id="add_ons">
                                        @csrf
                                        <input type="hidden" name="id" value="{{@$blog->id}}">
                                        <div class="row">
                                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                                <h5 class="font-weight-bold">Upgrade Your Hard Disk</h5>
                                            </div>
                                            <div class="col-12 col-xl-4">
                                                <div class="justify-content-end d-flex">
                                                    <button type="button" class="btn btn-primary btn-sm add_disk" >+</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="upgrade_div">
                                            <?php if(!empty($hard_disk) && $hard_disk->count() > 0) {
                                                foreach ($hard_disk as $key => $hard) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                    <input type="hidden" name="disk_id[]" value="{{@$hard->id}}">
                                                        <div class="form-group">
                                                            <label>Option Name</label>
                                                            <input type="text" class="form-control" name="disk[]" placeholder="Option Name"  value="{{@$hard->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="disk_price[]" placeholder="Price"  value="{{@$hard->price}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary mr-2 remove" data-id="{{@$hard->id}}" >Remove</button>
                                                    </div>
                                                </div>
                                            <?php } } else {?>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                    <input type="hidden" name="disk_id[]" value="">
                                                        <div class="form-group">
                                                            <label>Option Name</label>
                                                            <input type="text" class="form-control" name="disk[]" placeholder="Option Name"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="disk_price[]" placeholder="Price"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary mr-2 remove" >Remove</button>
                                                    </div>
                                                </div>
                                            <?php }?>
                                        </div>


                                        <div class="row">
                                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                                <h5 class="font-weight-bold">Upgrade Your RAM</h5>
                                            </div>
                                            <div class="col-12 col-xl-4">
                                                <div class="justify-content-end d-flex">
                                                    <button type="button" class="btn btn-primary btn-sm add_ram" >+</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="upgrade_ram_div">
                                            <?php if(!empty($ram) &&  $ram->count() > 0) {
                                                foreach ($ram as $key => $ra) {
                                                ?>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                    <input type="hidden" name="ram_id[]" value="{{@$ra->id}}">
                                                        <div class="form-group">
                                                            <label>Option Name</label>
                                                            <input type="text" class="form-control" name="ram[]" placeholder="Option Name"  value="{{@$ra->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="ram_price[]" placeholder="Price"  value="{{@$ra->price}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" data-id="{{@$ra->id}}" class="btn btn-primary mr-2 remove" >Remove</button>
                                                    </div>
                                                </div>
                                            <?php } } else {?>

                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                    <input type="hidden" name="ram_id[]" value="">
                                                        <div class="form-group">
                                                            <label>Option Name</label>
                                                            <input type="text" class="form-control" name="ram[]" placeholder="Option Name"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="ram_price[]" placeholder="Price"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary mr-2 remove" >Remove</button>
                                                    </div>
                                                </div>

                                            <?php }?>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                                <h5 class="font-weight-bold">Warranty</h5>
                                            </div>
                                            <div class="col-12 col-xl-4">
                                                <div class="justify-content-end d-flex">
                                                    <button type="button" class="btn btn-primary btn-sm add_warrenty" >+</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="upgrade_warrenty_div">

                                            <?php if(!empty($warrenty) &&  $warrenty->count() > 0) {
                                                foreach ($warrenty as $key => $war) {
                                                ?>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                <input type="hidden" name="warrenty_id[]" value="{{@$war->id}}">
                                                    <div class="form-group">
                                                        <label>Option Name</label>
                                                        <input type="text" class="form-control" name="warrenty[]" placeholder="Option Name"  value="{{@$war->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="number" class="form-control" name="warrenty_price[]" placeholder="Price"  value="{{@$war->price}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <label>&nbsp;</label>
                                                    <button type="button" data-id="{{@$war->price}}" class="btn btn-primary mr-2 remove" >Remove</button>
                                                </div>
                                            </div>
                                            <?php } } else {?>

                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                    <input type="hidden" name="warrenty_id[]" value="">
                                                        <div class="form-group">
                                                            <label>Option Name</label>
                                                            <input type="text" class="form-control" name="warrenty[]" placeholder="Option Name"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="warrenty_price[]" placeholder="Price"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary mr-2 remove" >Remove</button>
                                                    </div>
                                                </div>

                                            <?php }?>
                                        </div>
                                        
                                        
                                        <div class="row">
                                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                                <h5 class="font-weight-bold">Operating System</h5>
                                            </div>
                                            <div class="col-12 col-xl-4">
                                                <div class="justify-content-end d-flex">
                                                    <button type="button" class="btn btn-primary btn-sm add_os" >+</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="upgrade_os_div">
                                            <?php if(!empty($os) &&  $os->count() > 0) {
                                                foreach ($os as $key => $op) {
                                                ?>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                <input type="hidden" name="os_id[]" value="{{@$op->id}}">
                                                    <div class="form-group">
                                                        <label>Option Name</label>
                                                        <input type="text" class="form-control" name="os[]" placeholder="Option Name"  value="{{@$op->name}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="number" class="form-control" name="os_price[]" placeholder="Price"  value="{{@$op->price}}">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-2">
                                                    <label>&nbsp;</label>
                                                    <button type="button" data-id="{{@$op->id}}" class="btn btn-primary mr-2 remove" >Remove</button>
                                                </div>
                                            </div>

                                            <?php } } else {?>

                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                    <input type="hidden" name="os_id[]" value="">
                                                        <div class="form-group">
                                                            <label>Option Name</label>
                                                            <input type="text" class="form-control" name="os[]" placeholder="Option Name"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input type="number" class="form-control" name="os_price[]" placeholder="Price"  >
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary mr-2 remove" >Remove</button>
                                                    </div>
                                                </div>

                                            <?php }?>
                                        </div>

                                        
                                      <button type="submit" class="btn btn-primary mr-2 ladda-button" data-style="expand-right" id="add_ons_button">Submit</button>
                                    </form>
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
<script src="{{ URL::asset('assets/temporary/katex.min.js')}}"></script>
<script src="{{ URL::asset('assets/temporary/highlight.min.js')}}"></script>
<script src="{{ URL::asset('assets/temporary/quill.min.js')}}"></script>
<script src="{{ URL::asset('assets/temporary/form-quill-editor.js')}}"></script>
<!-- <script>
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

    tinymce.init({
        height:500,
      selector: '#description',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });

    tinymce.init({
        height:500,
      selector: '#grading',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });

    tinymce.init({
        height:500,
      selector: '#other',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script> -->

    <script>
    var id = '<?php echo @$blog->id; ?>';
    // $('#editor').summernote();
    // $('#description').summernote();
    // $('#grading').summernote();
    // $('#other').summernote();

    $(function() {
        $("#add_company").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_company_button'));
                l.start();
                var formData = new FormData($('#add_company')[0]);
                
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/save-sales-product",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                            
                            toastr.success(response.message, '', {
                                "progressBar": true
                            });

                            if(id == ''){
                                setTimeout(function(){ 
                                    window.location.href = ajax_url+"/edit-sales-product/"+response.data.id;   
                                }, 2000);
                            }
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


        $("#add_description").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_description_button'));
                l.start();
                $('textarea[name=text]').val($('.ql-editor').html());
                var formData = new FormData($('#add_description')[0]);
                
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/save-product-description",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                            
                            toastr.success(response.message, '', {
                                "progressBar": true
                            });

                            setTimeout(function(){ 
                                window.location.reload();
                            }, 2000);
                            

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


        $("#product_images").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_image_button'));
                l.start();
                var formData = new FormData($('#product_images')[0]);
                
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/save-product-images",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                            
                            toastr.success(response.message, '', {
                                "progressBar": true
                            });

                            setTimeout(function(){ 
                                window.location.reload();
                            }, 2000);
                            

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


        $("#add_ons").validate({
            submitHandler: function() {
                var l = Ladda.create(document.querySelector('#add_ons_button'));
                l.start();
                var formData = new FormData($('#add_ons')[0]);
                
                $.ajax({
                    data: formData,
                    type: "POST",
                    url: ajax_url+"/save-product-addon",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        l.stop();
                        if(response.status) {
                            
                            toastr.success(response.message, '', {
                                "progressBar": true
                            });

                            setTimeout(function(){ 
                                window.location.reload();
                            }, 2000);
                            
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
            content: 'Are you sure you want to delete this Image!',
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
                            url: ajax_url+'/delete-sales-image',
                            data: {
                                'id': $(obj).data('id'),
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    toastr.success(response.message, '', {
                                        "progressBar": true
                                    });
                                    self.close();
                                    $(obj).closest('.image').remove()
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

    $('.add_disk').on("click",function(){

        $('.upgrade_div').append('<div class="row"><div class="col-12 col-md-6"><input type="hidden" name="disk_id[]" value=""><div class="form-group"><label>Option Name</label><input type="text" class="form-control" name="disk[]" placeholder="Option Name"></div></div><div class="col-12 col-md-4"><div class="form-group"><label>Price</label><input type="number" class="form-control" name="disk_price[]" placeholder="Price"></div></div><div class="col-12 col-md-2"><label>&nbsp;</label><button type="button" class="btn btn-primary mr-2 remove">Remove</button></div></div>');

    });

    $('.add_ram').on("click",function(){

        $('.upgrade_ram_div').append('<div class="row"><div class="col-12 col-md-6"><input type="hidden" name="ram_id[]" value=""><div class="form-group"><label>Option Name</label><input type="text" class="form-control" name="ram[]" placeholder="Option Name"></div></div><div class="col-12 col-md-4"><div class="form-group"><label>Price</label><input type="number" class="form-control" name="ram_price[]" placeholder="Price"></div></div><div class="col-12 col-md-2"><label>&nbsp;</label><button type="button" class="btn btn-primary mr-2 remove">Remove</button></div></div>');

    });

    $('.add_warrenty').on("click",function(){

        $('.upgrade_warrenty_div').append('<div class="row"><div class="col-12 col-md-6"><input type="hidden" name="warrenty_id[]" value=""><div class="form-group"><label>Option Name</label><input type="text" class="form-control" name="warrenty[]" placeholder="Option Name"></div></div><div class="col-12 col-md-4"><div class="form-group"><label>Price</label><input type="number" class="form-control" name="warrenty_price[]" placeholder="Price"></div></div><div class="col-12 col-md-2"><label>&nbsp;</label><button type="button" class="btn btn-primary mr-2 remove">Remove</button></div></div>');

    });

    $('.add_os').on("click",function(){

        $('.upgrade_os_div').append('<div class="row"><div class="col-12 col-md-6"><input type="hidden" name="os_id[]" value=""><div class="form-group"><label>Option Name</label><input type="text" class="form-control" name="os[]" placeholder="Option Name"></div></div><div class="col-12 col-md-4"><div class="form-group"><label>Price</label><input type="number" class="form-control" name="os_price[]" placeholder="Price"></div></div><div class="col-12 col-md-2"><label>&nbsp;</label><button type="button" class="btn btn-primary mr-2 remove">Remove</button></div></div>');

    });

    $("#addon").on('click','.remove',function() {
        var obj = this;
        if($(this).data('id') != '') {
            $(this).closest('.row').remove();
            $.ajax({
                type: 'POST',
                url: ajax_url+'/delete-addon',
                data: {
                    'id': $(obj).data('id'),
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        
                    } 
                },
                error: function(response) {
                    toastr.error("Something went wrong", '', {
                        "progressBar": true
                    });
                }
            });
        } else {
            $(this).closest('.row').remove();
        }
        
    })
        
    </script>
@endsection 




