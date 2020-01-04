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
                                        <strong>Basic Form</strong> Elements
                                    </div>
                                    <div class="card-body card-block">
                                       
                                                                                   <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Offer Title</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="title" placeholder="Title" class="form-control">
                                                  
                                                </div>
                                            </div>
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Offer Description</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="desc"  rows="9" placeholder="Content..." class="form-control"></textarea>
                                                </div>
                                            </div>
                                          
                                      
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Publish
                                        </button>
                                    </div>
                                      </form>
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
                $.ajax({
                type:'POST',
                url:"{{route('admin.addweekly')}}",
                data: new FormData(form),
                contentType: false, 
                cache: false, 
                processData:false,
                success:function(data)
                   { 
                    var status = $.parseJSON(data);
                    if(status.status==1){
                         $('#weekly ')[0].reset();
                          swal({
                        text:status.msg ,
                      });                     
                    }
                  if(status.status==0) 
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