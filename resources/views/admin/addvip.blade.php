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
                                        <strong>Register</strong> VIP
                                    </div>
                                    <div class="card-body card-block">
                                       
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="name" placeholder="Name" class="form-control">
                                                  
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Email</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="email" placeholder="Email" class="form-control">
                                                  
                                                </div>
                                            </div>
                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Phone</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number"  name="phone" placeholder="Phone number is optional field" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">Password</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text"  name="password" placeholder="Password" class="form-control">
                                                </div>
                                            </div>
                                                                             
                                      
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm" id="button">
                                            <i class="fa fa-dot-circle-o"></i> Register
                                        </button>
                                
                                        <button  id="loader" style="display: none">
                                        <img src="{{URL('public/admin/images/91.gif')}}" style="width:80%">
                                         </button>
                                    </div>
                                      </form>
                                </div>
                     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title msg" id="smallmodalLabel"></h5>
                       </div>
                        <div class="modal-body">
                            <p>
                            <div id="vipname"></div>
                            <div id="vipemail"></div>
                            <div id="vippassword"></div>  
                            <br>
                            <div><span style="color:red">Note:</span> Please note the credentials or take a screenshot</div>                                    
                            </p>
                        </div>
                        <div class="modal-footer">
                             <button type="button" class="btn btn-primary" id="noted">Noted</button>
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
    
       name:
       {
           
         
           required: true ,          
       },  
        email:
       {
           email : true ,
           required : true ,
          
       },  
       password:
       {
           minlength: 6,
           required : true ,
          
       }, 
   },  
   messages: 
       {       
       
         name: 
         {
           required: "name  is missing",
          
          
         },
        email: 
         {
           required: "email is missing",
           email:"Your email address must be in the format of name@domain.com",
       
          
         },
         password:
       {
           minlength: "minimum length of password is 6",
           required : "password is missing" ,
          
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
                url:"{{route('admin.addvip_user')}}",
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
                    }
                  if(status.status==1) 
                  {                    
                        $('#vipname').html('Name: '+status.data.name);
                        $('#vipemail').html('Email: '+status.data.email);
                        $('#vippassword').html('Password: '+status.password); 
                        $('.msg').html(status.msg);                      
                        $('#myModal').modal('show');                                            
                      
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

$('#noted').click(function(){
    $('#myModal').modal('hide');
});
</script>
@endsection('script')