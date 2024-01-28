@extends('super_admin.layout.header')
@section('css')
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')
{{ csrf_field() }}
<section id="basic-datatable">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header border-bottom">
               <h4 class="card-title">{{$data['page_title']}}</h4>
               <a class="btn btn-primary" href="{{route('add-post')}}">Add Post</a>
            </div>
            <div class="card-datatable p-2">
               <table class="table dynamic_table font-weight-bold">
                <thead>
                    <tr role="row">
                       <th >S.No</th>
                        <th >Image</th>
                        <th>Post Name</th>
                        <th >Status</th>
                        <th >Share Post</th>
                        <th> Action </th>
                    </tr>
                </thead>
                  <tbody>
                     @foreach($data['results'] as $key=>$value)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td><img src="{{url('/')}}/{{$value->image}}" style="height:80px; width:80px;"></td>
                        <td>{{strlen($value->title) > 35 ? substr($value->title,0,35)."..." : $value->title;}}</td>
                        <td> @if($value->status==1)
                        <span data-id="{{$value->id}}" data-status="{{$value->status}}"  class="badge badge-pill badge-light-primary mr-1  pointerclass">Active</span>
                        @else
                        <span data-id="{{$value->id}}" data-status="{{$value->status}}" class="badge adge-pill badge-light-warning  pointerclass">Inactive</span>
                        @endif
                        </td>
                        <td>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blogpostdetail', ['slug' => $value->slug]) }}"  id="" target="_blank">
                        <img src="{{URL::asset('/app-assets/images/icons/icons8-facebook-48.png')}}" style="height:24px !important; width:24px !important; ">
                        <!-- <svg viewBox="0 0 24 24" width="24" height="24" stroke="#0E86D4" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg> -->
                        </a>
                        <a href="https://twitter.com/intent/tweet?text='.$value->title.'; &amp;url='.route('blogpostdetail', ['slug' => $value->slug]).'" id="" target="_blank">
                        <img src="{{URL::asset('/app-assets/images/icons/icons8-twitter-circled-48.png')}}" style="height:24px !important; width:24px !important; ">

                        <!-- <svg viewBox="0 0 24 24" width="24" height="24" stroke="#0E86D4" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg> -->
                        </a>
                        <a href="https://wa.me/?text={{ route('blogpostdetail', ['slug' => $value->slug]) }}" class="action-icon font-medium-3" id="" target="_blank">
                        <img src="{{URL::asset('/app-assets/images/icons/icons8-whatsapp-48.png')}}" style="height:24px !important; width:24px !important; ">
                       </a>
                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('blogpostdetail', ['slug' => $value->slug]) }}&amp;title={{ $value->title }}&amp;summary={{ $value->short_description }}" id="" target="_blank">
                        <img src="{{URL::asset('/app-assets/images/icons/icons8-linkedin-circled-48.png')}}" style="height:24px !important; width:24px !important; ">
                        
                        <!-- <svg viewBox="0 0 24 24" width="24" height="24" stroke="#0E86D4" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg> -->
                        </a>
                      
                        <!-- <ul class="list-inline m-0">
                        <li class="list-inline-item mail-unread mr-2 ml-1">
                           <a href="https://wa.me/?text={{ route('blogpostdetail', ['slug' => $value->slug]) }}" class="action-icon font-medium-3" id="" target="_blank">
                                 <span class="mdi mdi-whatsapp mdi-24px"></span>
                           </a>
                        </li> 
                     </ul> -->
                        </td>
                        <td>
                           <div class="dropdown">
                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                 </svg>
                                 <time></time>
                              </button>
                              <div class="dropdown-menu">
                              <a data-id="{{$value->id}}" data-status="{{$value->status}}"  data-toggle="modal"  class="dropdown-item btnstatus">
                              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                              <span>Update Status</span>
                              </a>
                                <a class="dropdown-item" href="{{url('/add-post/'.$value->id )}}">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                 <span>Edit</span>
                                </a>
                                 <a data-href="{{url('/delete-post/'.$value->id)}}" data-toggle="modal" data-target="#confirm-delete" class="dropdown-item" href="javascript:void(0);">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                 <span>Delete</span>
                                 </a>
                              </div>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
<!-- <div class="modal fade" id="confirm-active" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Active</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{url(app()->getLocale().'/admin/bidstatus')}}" method="post">
               {{ csrf_field() }}
               <input class="form-control" name="id" type="hidden" value="">
               <input type="hidden" name="status" value="">
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="Submit" class="btn btn-primary">Confrim</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="confirm-inactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color: red !important">
            <h5 class="modal-title" id="exampleModalLabel">Confirm Inacive</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="rejected-form" method="post">
               {{ csrf_field() }}
               <input class="form-control" name="id" type="hidden" value="">
               <input type="hidden" name="status" value="">
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="Submit" class="btn btn-primary">Confrim</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div> -->
</div>
</section>
@include('includes.delete')
@endsection
@section('js')
<script src="{{URL::asset('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{URL::asset('/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}">

<script type="text/javascript">
 $( document ).ready(function() {
    $('.dynamic_table').DataTable();
   $('.manage-posts').addClass('active');
   $(document).on('click','.btnstatus',function () {
      var id=$(this).attr('data-id');
      var status=$(this).attr('data-status');
      var formdata={'id':id,'status':status};
      var token = $('input[name=_token]').val();
      Swal.fire({
         title: 'Are you sure?',
         text: "You want to update the post status?",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Yes, confirm it!',
         customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ml-1'
         },
         buttonsStyling: false
      }).then(function (result) {
         if (result.value) {
            $.ajax({
                  type:'POST',
                  headers: {'X-CSRF-TOKEN': token},
                  dataType:'json',
                  data:formdata,
                  url:'{{url('/update-post-status')}}',
                  success: function(response){
                     window.location.href = '{{url('/manage-post')}}';
                  }

            });

         }

      });

   });

   });

</script>
@endsection