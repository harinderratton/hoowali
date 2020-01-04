@extends('admin.master')
@section('body')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                             <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Published Weekly Offers</h3>
                 
                               <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Title</th> 
                                                 <th>Descreption</th>                               
                                              
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($data as $weekly)
                                            <tr class="tr-shadow" id="{{$weekly->id.'id'}}">
                                            
                                                <td>{{$weekly->title}}</td>
                                                <td>
                                                    <span class="block-email">{{$weekly->desc}}</span>
                                                </td>
                                            
                                                <td>
                                                    <div class="table-data-feature">
                                                       <button class="item deletebtn" data-toggle="tooltip" data-placement="top" title="Delete" id="{{$weekly->id}}">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr class="spacer"></tr>
                                         
                                            
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
   $(document).on('click','.deletebtn',function(){
    console.log($(this).attr('id'));
   });
 
  $.ajax({
                type:'POST',
                url:"{{route('admin.send_fcm')}}",
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
                  if(status.status==1) 
                  { 
                        swal({
                        text:status.msg ,
                      });
                  }   
                   
                   }
           });

</script>
@endsection('script')