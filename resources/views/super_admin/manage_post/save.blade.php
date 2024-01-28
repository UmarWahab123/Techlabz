@extends('super_admin.layout.header')
@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/forms/form-validation.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/forms/form-file-uploader.css')}}">
@endsection
@section('breadcrumb')
<h2 class="content-header-title float-left mb-0">Manage Posts</h2>
<div class="breadcrumb-wrapper">
   <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('manage-post')}}">Posts</a>
      </li>
      <li class="breadcrumb-item"><a href="#">{{$data['page_title']}}</a>
      </li>
   </ol>
</div>
@endsection
@section('content')
<div class="content-body">
   <section id="basic-input">
      <form action="{{ url('/save-post') }}" class="" id="form_submit" method="post" enctype="multipart/form-data">
        @csrf
         <div class="col-md-12 text-right mb-2">    
            <button type="submit" class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 savepost">Save Changes</button>
            <a href="{{route('manage-post')}}" class="btn btn-outline-secondary">Back</a>
         </div>
         <div class="card">
            <div class="card-body">
               <input class="form-control" name="id" type="hidden" value="{{(isset($data['results']->id) ? $data['results']->id : '')}}">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group m-form__group">
                           <label for="title">Post Title</label>
                           <input type="text" name="title" class="form-control m-input m-input--square" placeholder="Enter Post Title" id="title" value="{{(isset($data['results']->title) ? $data['results']->title : '')}}" required>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group m-form__group">
                           <label for="slug">Post Slug</label>
                           <input type="text" id="slug" name="slug" placeholder="Enter Post slug" class="form-control m-input m-input--square" value="{{(isset($data['results']->slug) ? $data['results']->slug : '')}}">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group m-form__group">
                           <label for="slug">Short Description</label>
                           <textarea type="text" id="short_description" name="short_description" placeholder="Enter Short Description" rows="5" class="form-control m-input m-input--square">{{(isset($data['results']->short_description) ? $data['results']->short_description : '')}}</textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group" >
                           <label>
                           Upload Post Image
                           </label>
                           <div action="{{url('/upload_file?url=-public-storage-uploads-brand_type') }}" class="dropzone" id="dropzonepostsupload">
                              <div class="dz-message">Drop files here or click to upload.</div>
                           </div>
                        </div>
                     </div>
                     <input type="hidden" id="image" name="image" class="form-control m-input m-input--square" value="{{(isset($data['results']->image) ? $data['results']->image : '')}}">
                  </div>
                  @if(@$data['results']->id)
                  <img src="{{isset($data['results']->image) ?url('/').''. $data['results']->image:''}}" width="90" height="80"> 
                  @endif
                  <div class="row">
                     <div class="col-md-12 col-12">
                        <div class="form-group" id="full-container">
                           <label for="exampleFormControlTextarea1">Content</label>
                           <div id="full-container">
                              <div class="editor">
                                 <?=(isset($data['results']->description) ? $data['results']->description : '')?>
                              </div>
                           </div>
                           <textarea class="form-control d-none" name="description">{{(isset($data['results']->description) ? $data['results']->description : '')}}</textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </section>
</div>
@endsection
@section('js')
<script src="{{URL::asset('/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/js/scripts/forms/form-quill-editor.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script type="text/javascript">
    
    $(document).on('click','.savepost',function(e) {
      e.preventDefault();
      $('textarea[name=description]').val($('.ql-editor').html());
      $('#form_submit').submit();
   });
   $('.manage-posts').addClass('active');
   DropzoneSinglefunc('dropzonepostsupload','.webp,.png,.jpg,.jpeg',1.,'image');
</script>
@endsection