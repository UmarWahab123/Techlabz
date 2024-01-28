@extends('super_admin.layouts.master')

@section('content')
<style>
    .error{
        color:red;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Sales Sub Category</p>
                    <div class="card-description pb-5">
                        <a class="btn btn-primary float-right btn-icon-text" href="{{route('manage-sales-category')}}"> <i class="mdi mdi-arrow-left"></i> Back</a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8 offset-md-2">
                            <form class="forms-sample" method="post" action="javascript:void(0)" id="add_company">
                                @csrf
                                <div class="form-group">
                                    <label for="category_id">Catgory</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php if($main_service->count() > 0) { 
                                            foreach ($main_service as $key => $val) {
                                            ?>
                                            <option value="{{@$val->id}}">{{@$val->title}}</option>
                                        <?php } } ?>
                                    </select>
                                    <span class="category_id_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="category">Subcategoy Name</label>
                                    <input type="text" class="form-control" id="category" name="category" placeholder="Subcategoy Name" required/>
                                    <span class="category_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" required/>
                                    <span class="slug_error"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Category Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Category image">
                                </div>

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

   
    $(function() {
            $("#add_company").validate({
                submitHandler: function() {
                    var l = Ladda.create(document.querySelector('#add_company_button'));
                    l.start();
                    var formData = new FormData($('#add_company')[0]);
                    
                    $.ajax({
                        data: formData,
                        type: "POST",
                        url: ajax_url+"/save-sales-category",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            l.stop();
                            if(response.status) {
                               
                               toastr.success(response.message, '', {
                                    "progressBar": true
                                });
                               window.location.href = ajax_url+"/manage-sales-category";

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




