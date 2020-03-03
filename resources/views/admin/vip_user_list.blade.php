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
                                <h3 class="title-5 m-b-35">Register Users</h3>
                 
                               <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                              <th>Name</th> 
                                              <th>Email</th> 
                                               <th>Password</th> 
                                            
                                              <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($data as $weekly)
                                            <tr class="tr-shadow thisrow" id="{{$weekly->id.'id'}}">
                                            
                                                <td>{{$weekly->name}}</td>
                                                <td>
                                                    <span class="block-email">{{$weekly->email}}</span>
                                                </td> 
                                                <td>
                                                    <span class="block-email">{{$weekly->password}}</span>
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
                url:"{{route('admin.vip_user_delete')}}",
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