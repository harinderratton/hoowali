@extends('admin.master')
@section('body')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                              <div class="col-lg-6">
                                   
                                <div class="card">
                                     <form class="form-horizontal" id="weekly">
                                    {{csrf_field()}}
                                    <div class="card-header">
                                        LIVE</strong> Stream
                                    </div>
                                    <div class="card-body card-block">
                                       
                                        <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Video Title</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="title" placeholder="Title" class="form-control">
                                                  
                                                </div>
                                            </div>
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Video Description</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="desc"  rows="9" placeholder="Description..." class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                    <div class="col col-md-3">
                                                        <label for="file-input" class=" form-control-label">Video</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text"  name="video" placeholder="Youtube video id" class="form-control">
                                                    </div>
                                          </div>
                                          
                                      
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" id="button">
                                            <i class="fa fa-dot-circle-o"></i> Publish
                                        </button>
                                        <button  id="loader" style="display: none">
                                        <img src="{{URL('public/admin/images/91.gif')}}" style="width:80%">
                                         </button>
                                    </div>
                                      </form>
                                </div>
                     
                            </div>
                        </div>

                  
   

                     <div class="row">
                                        <div class="row">
                                       <div class="col-md-12">
                                           <!-- DATA TABLE -->
                                           <h3 class="title-5 m-b-35">Published Video</h3>
                            
                                          <div class="table-responsive table-responsive-data2">
                                               <table class="table table-data2">
                                                   <thead>
                                                       <tr>
                                                         <th>Title</th>
                                                         <th>Descreption</th>
                                                         <th>Video</th>
                                                         <th></th>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                   
                                    @if(isset($data['id']))
                                                  <tr class="tr-shadow thisrow" id="{{$data['id']}}">
                                                    
                                                        <td>{{$data['title']}}</td>
                                                        <td>
                                                            <span class="block-email">{{$data['descr']}}</span>
                                                        </td>

                                                                <td>
                                                          <iframe width="260" height="115" src="{{$data['video']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </td>
                                                    
                                                    
                                                        <td>
                                                            <div class="table-data-feature">
                                                               <button class="item deletebtn" data-toggle="tooltip" data-placement="top" title="Delete" id="{{$data['id']}}">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                    @endif
                                                   </tbody>
                                               </table>
                                           </div>
                                           <!-- END DATA TABLE -->
                                       </div>
                                   </div>
                                   </div>



                    </div>
                </div>
            </div>
@endsection('body')


@section('script')
<script>
     
$(function($) {
   $('#weekly').validate({
       // ignore:"hidden:not(select)",
   rules: {
    
       title:
       {
           
         
           required: true ,
       },
        desc:
       {
           
           required : true ,
          
       },
       video:
       {
           
           required : true ,
          
       },
   },
   messages:
       {
       
         title:
         {
           required: "Title  is missing",
          
          
         },
        desc:
         {
           required: "Desc is missing",
       
          
         },
         video:
         {
           required: "video is missing",
       
          
         },
       },
         highlight: function(element) {
           $(element).parent().addClass('has-error');
         },
         unhighlight: function(element) {
           $(element).parent().removeClass('has-error');
         },
             errorElement: 'span',
             errorClass: 'validation-error-message help-block form-helper bold',
             errorPlacement: function(error, element) {
               if (element.parent('.input-group').length) {
                 error.insertAfter(element.parent());
               } else {
                 error.insertAfter(element);
              }
            },
       submitHandler: function(form)
       {
                $('#loader').css('display','block');
                $('#button').css('display','none');
                $.ajax({
                type:'POST',
                url:"{{route('admin.add_live_stream')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                success:function(data)
                   {
                    $('#button').css('display','block');
                    $('#loader').css('display','none');
                    var status = $.parseJSON(data);
                    if(status.status==1){
                         $('#weekly')[0].reset();
                          swal({
                        text:status.msg ,
                      });
                    }
                  if(status.status==1)
                  {
                       window.location.reload();
                  }
                   
                   }
           });
         }
       
   });
});


 $(document).on('click','.deletebtn',function(){
    var id= $(this).attr('id');
    var rowid = $(this).closest('tr').attr('id');
       
    swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this data!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
       $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url:"{{route('admin.delete_live_stream')}}",
                data: {id:id},
               
                success:function(data)
                   {
                    var status = $.parseJSON(data);
                    if(status.status==1){
                     $('#'+rowid).remove();

                    }
                  if(status.status==1)
                  {
                        swal({
                        text:status.msg ,
                      });
                  }
                   
                   }
           });


  }
});
    
   });

</script>
@endsection('script')
