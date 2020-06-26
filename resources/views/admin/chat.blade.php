@extends('admin.master')
@section('body')
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-inbox-wrap js-inbox-wrap new-chts-sm">
                                        <div class="row mr-ns">
                                            <div class="col-md-4 p-0">
                                                <div class="au-message">
                                                    <div class="au-message__noti">
                                                        <p class="chat-las">Chat List </p>
                                                  
                                                    </div>
                                                  
                                                    @if(count($chats)>0)
                                                    <div class="au-message-list mCustomScrollbar">
                                                            <?php
                                                            $i=1;
                                                            ?>
                                                      @foreach($chats as $chat)
                                                  
                                                    <div class="au-message__item unread message" id="{{$chat->sender_id}}" roomno="{{$i}}">
                                                            <div class="au-message__item-inner">
                                                                <div class="au-message__item-text">
                                                                    <div class="avatar-wrap">
                                                                        <div class="avatar">
                                                                            <img src="{{URL('public/admin/images/icon/default-avatar.png')}}" alt="John Smith">
                                                                        </div>
                                                                    </div>
                                                                    <div class="text">
                                                                    <h5 class="name">Room{{$i}}</h5>
                                                                    <p>{{$chat->msg}}</p>
                                                                      
                                                                    </div>
                                                                </div>
                                                                <div class="au-message__item-time">
                                                                <span> {{ \Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <?php
                                                        $i++;
                                                        ?>
                                                        @endforeach                                                       
                                                  
                                                   
                                                    </div>
                                                  @endif

                                                </div>
                                            </div>

                                            @if(count($singlechat)>0)
                                            <div class="col-md-8 p-0">
                                                <div class="au-chat">
                                                    <div class="au-chat__title">
                                                        <div class="au-chat-info">
                                                            <div class="avatar-wrap online">
                                                                  
                                                                {{-- <div class="avatar avatar--small">
                                                                    <img src="{{URL('public/admin/images/icon/avatar-02.jpg')}}" alt="John Smith">
                                                                </div> --}}
                                                            </div>
                                                            <span class="nick">
                                                                
                                                            <a href="#" id="roomno">Room 1</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="au-chat__content mCustomScrollbar" id="scroll">
                                                        <div class="pss-cds" id="chatbox" newid="{{$lastchatid}}">
                                                             @foreach($singlechat as $single)
                                                          
                                                             @if($single->reciever_id==1)
                                                            <div class="recei-mess-wrap">                                                      
                                                                <div class="recei-mess__inner">
                                                                    <div class="avatar avatar--tiny">
                                                                        <img src="{{URL('public/admin/images/icon/default-avatar.png')}}" >
                                                                    </div>
                                                                    <div class="recei-mess-list">
                                                                        <div class="recei-mess">{{$single->msg}}</div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @else
                                                              <div class="send-mess-wrap"> 
                                                                  <div class="send-mess__inner">
                                                                      <div class="send-mess-list">
                                                                          <div class="send-mess">{{$single->msg}}</div> 
                                                                      </div> 
                                                                 </div>  
                                                             </div>
                                                            @endif



                                                            @endforeach                                                        
                                                       
                                                   
                                            
                                                        </div>
                                                    </div>
                                                    <div class="au-chat-textfield">
                                                        <form class="au-form-icon">
                                                            <input class="au-input au-input--full au-input--h65" type="text" placeholder="Type a message....." id="get_mesage_text">
                                                            <button class="au-input-icon" onclick="send()" type="button">
                                                                <i class="fas fa-paper-plane"></i>
                                                            </button>
                                                         
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection('body')

@section('script')
<script>

$('.message').click(function(){
   var id= $(this).attr('id');
   var roomno= $(this).attr('roomno');
    $('#chatbox').attr('newid',id);

    // ajax
        $.ajax({       
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url:"{{route('admin.room_chat')}}",
                data:{id:id},                      
                success:function(data)
                {   $('#roomno').html('Room '+roomno); 
                    var results=$.parseJSON(data);
                    $('#chatbox').html(results.data);
                    console.log(data);                      
                
                }
                });

});

function send(){
    let msg= $('#get_mesage_text').val();
    let errors=['',null,undefined];
    if(errors.indexOf(msg)==-1){
  $('#get_mesage_text').val('');
  if(msg!='' && msg!=null && msg!=undefined){
    $('#chatbox').append(' <div class="send-mess-wrap"> <div class="send-mess__inner"> <div class="send-mess-list"> <div class="send-mess">'+msg+'</div> </div>  </div>  </div>');
    $("#scroll").mCustomScrollbar("update");
    $("#scroll").mCustomScrollbar("scrollTo","bottom");
   } 
   
    socket.emit('admin_post', {message :msg });  
   
      $.ajax({       
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:'POST',
                url:"{{route('admin.savechat')}}",
                data:{id:$('#chatbox').attr('newid'),msg:msg},                      
                success:function(data)
                { 
                    var results= $.parseJSON(data);
                   
                    console.log(results);                      
                
                }
                });
    }
  

   
}
 var socket = io('http://13.58.91.205:3001');
 socket.on('admin_get', function(data){
            if($('#chatbox').attr('newid')==data.id){
                        $('#chatbox').append('<div class="recei-mess-wrap"> <div class="recei-mess__inner"> <div class="avatar avatar--tiny"> <img src="{{URL("public/admin/images/icon/default-avatar.png")}}" > </div> <div class="recei-mess-list"> <div class="recei-mess">'+data.message+'</div> </div> </div> </div>');
            
                         $("#scroll").mCustomScrollbar("update");
                        $("#scroll").mCustomScrollbar("scrollTo","bottom");}

    });


</script>
@endsection('script')