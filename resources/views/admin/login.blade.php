<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{URL('public/admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{URL('public/admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
      <link rel="icon" href="{{URL('public/admin/images/icon/logo.png')}}">
    <!-- Vendor CSS-->
    <link href="{{URL('public/admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{URL('public/admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{URL('public/admin/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                 <img src="{{URL('public/admin/images/logo.png')}}" alt="Latin Branding" width="50%"/>
                            </a>
                        </div>
                      <div class="login-form">
                            <form id="login_form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label style="color:white">Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label  style="color:white">Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                </div>
                             
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

  <script src="{{URL('public/admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{URL('public/admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{URL('public/admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{URL('public/admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{URL('public/admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{URL('public/admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{URL('public/admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{URL('public/admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{URL('public/admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{URL('public/admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{URL('public/admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{URL('public/admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{URL('public/admin/vendor/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL('public/admin/js/jquery.validate.min.js')}}"></script>
    <!-- Main JS-->
    <script src="{{URL('public/admin/js/main.js')}}"></script>
     <script src="{{URL('public/admin/js/sweetalert.min.js')}}"></script>

</body>
<script>
     
$(function($) {
   $('#login_form').validate({
       // ignore:"hidden:not(select)",
   rules: {
    
       email:
       {
           
           email: true ,
           required: true ,          
       },  
        password:
       {
           
           required : true ,
          
       },  
   },  
   messages: 
       {       
       
         email: 
         {
           required: "Email  is missing",
           email:"Your email address must be in the format of name@domain.com",
          
         },
        password: 
         {
           required: "Password is missing",
       
          
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
                url:"{{route('loginauth')}}",
                data: new FormData(form),
                contentType: false, 
                cache: false, 
                processData:false,
                success:function(data)
                   { 
                    var status = $.parseJSON(data);
                    if(status.status==1){
                      window.location=status.path;                       
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
</html>
<!-- end document-->