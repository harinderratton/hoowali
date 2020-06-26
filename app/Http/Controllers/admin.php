<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\weekly;
use App\free_events;
use App\free_events1;
use App\fcm;
use App\tokens;
use App\free_training;
use App\vip;
use App\news;
use App\live_stream;
use App\vip_users;
use App\chat;
use App\short;
use App\picture;

class admin extends Controller
{
  public function logout(Request $request)
  {
    Auth::logout();
    return redirect()->route('login');

  }

    public function login(Request $request)
    {
      if (Auth::check()){
        return redirect()->route('admin.fcm');
      }
      else{
        return view('admin.login'); 
      }
    
    }

      public function loginauth(Request $request)
    {                
            $response=[];      
          if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'isadmin'=>1])){
            $response['status']=1;
            $response['msg']='Logged in';
            $response['path']= redirect()->intended('admin/fcm')->getTargetUrl();
      }
      else{
			$response['status']=0;
			$response['msg']='Invalid Credentials, Try again';       
          }
            echo json_encode($response);
    }

     public function dashboard(Request $request)
    {
      return view('admin.dashboard');
    }

      public function messages(Request $request)
    {
      $chats= chat::where('reciever_id',1)->groupBy('sender_id')->orderBy('id','desc')->get();

      $lastchat= chat::orderBy('id','desc')->limit(1)->first();

      if($lastchat!=null){
 $singlechat= chat::where('sender_id',$lastchat->sender_id)->orwhere('reciever_id',$lastchat->sender_id)->get();
 
           if($lastchat->sender_id!=1){
        $lastchatid= $lastchat->sender_id;
        
      }
      else{
        $lastchatid= $lastchat->reciever_id;
      }

      }else{
        $lastchatid=[];
        $singlechat=[];
      }
         
     

      return view('admin.chat',array('chats'=>$chats,'singlechat'=> $singlechat,'lastchatid'=>$lastchatid));
    }

      public function weekly(Request $request)
    {
      return view('admin.weekly');
    }

       public function add_weekly(Request $request)
    {
     $response=[]; 	
     $query= weekly::insert(['title'=>$request->title,'desc'=>$request->desc]);
     if($query){			
			$response['status']=1;
			$response['msg']='Offer has been published';
     }
     else{			
			$response['status']=0;
			$response['msg']='Server error';
     }
    echo json_encode($response);
    
    }

    public function delete_weekly(Request $request)
    {
     $response=[]; 	
     $query= weekly::where('id',$request->id)->delete();
     if($query){			
			$response['status']=1;
			$response['msg']='Offer has been deleted';
     }
     else{			
			$response['status']=0;
			$response['msg']='Server error';
     }
    echo json_encode($response);
    
    }


    public function free_events(Request $request)
    {
      return view('admin.events');
    }
    
    public function free_events1(Request $request)
       {
         return view('admin.events1');
       }

       public function add_free_events(Request $request)
    {
     $response=[]; 	
     $query= free_events::insert(['title'=>$request->title,'descr'=>$request->desc]);
     if($query){			
			$response['status']=1;
			$response['msg']='Event has been published';
     }
     else{			
			$response['status']=0;
			$response['msg']='Server error';
     }
    echo json_encode($response);
    
    }
    
      public function add_free_events1(Request $request)
    {
     $response=[];
     $query= free_events1::insert(['title'=>$request->title,'descr'=>$request->desc]);
     if($query){
            $response['status']=1;
            $response['msg']='Event has been published';
     }
     else{
            $response['status']=0;
            $response['msg']='Server error';
     }
    echo json_encode($response);
    
    }
    

       public function delete_free_events(Request $request)
    {
      $response=[]; 	
      $query= weekly::where('id',$request->id)->delete();
      if($query){			
       $response['status']=1;
       $response['msg']='Event has been deleted';
      }
      else{			
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }


    public function free_training(Request $request)
    {
      return view('admin.free_training');
    }

       public function add_free_training(Request $request)
    {
            $response=[]; 	
            // $random = Str::random(4);              
            // $video =$request->file('video');
            // $name =time().$random.$request->video->getClientOriginalName();
            // $real_name= preg_replace("/[^a-z0-9\_\-\.]/i", '',$name); // Removes special chars.
            // $destinationPath = public_path('/free_videos');
            // $upload= $video->move($destinationPath,$real_name);
            $query= free_training::insert(['title'=>$request->title,'descr'=>$request->desc,'video'=>$request->video]);           
           
            if($query){
              $response['status'] =1;
              $response['msg'] ='Training is published';

            }
            else{
              $response['status'] =0;
              $response['msg'] ='Server error';
            }
            
            echo json_encode($response);       
          
     
    
    }




    public function vip_training(Request $request)
    {
      return view('admin.vip_training');
    }

       public function add_vip_training(Request $request)
    {
      $response=[]; 	
      
      $query= vip::insert(['title'=>$request->title,'descr'=>$request->desc,'video'=>$request->video]);
      if($query){
        $response['status'] =1;
        $response['msg'] ='Training is published';

      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error';
      }
      
      echo json_encode($response);       
    
    
    }

 

    public function news(Request $request)
    {
      return view('admin.news');
    }

       public function add_news(Request $request)
    {
     $response=[]; 	
     $query= news::insert(['title'=>$request->title,'descr'=>$request->desc]);
     if($query){			
			$response['status']=1;
			$response['msg']='News has been published';
     }
     else{			
			$response['status']=0;
			$response['msg']='Server error';
     }
    echo json_encode($response);
    
    }

           public function news_list(Request $request)
    {
     
      $query= news::get();
     return view('admin.newslist',array('data'=>$query));
    }


       public function delete_news(Request $request)
    {
      $response=[]; 	
      $query= news::where('id',$request->id)->delete();
      if($query){			
       $response['status']=1;
       $response['msg']='News has been deleted';
      }
      else{			
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

    public function fcm(Request $request)
    {
      return view('admin.fcm');
    }

    public function send_fcm(Request $request)
    {
      $response=[]; 
      $tokens= tokens::get()->toArray(); 
      $ids=[];
      foreach($tokens as $keys){
        $ids[]= $keys['token'];
      } 
    
        if (!is_array( $ids)) { 
          return FALSE; 
        } 
        $result = array(); 
        foreach ( $ids as $key => $value) { 
          if (is_array($value)) { 
            $result = array_merge($result, array_flatten($value)); 
          } 
          else { 
            $result[$key] = $value; 
          } 
        }       
			 
				$url = 'https://fcm.googleapis.com/fcm/send';
				$fields = array (
                'registration_ids' =>$result,
				        'notification' => array (
				                "body" => $request->desc  ,
				                "title" => $request->title,
				               
				        )
				);
				$fields = json_encode ( $fields );
				$headers = array (
				        'Authorization: key=' . "AAAAAuhfqaM:APA91bE1iYLoIQRCFMFhlzMX6kRYvlvZsgJa38z8cbWbfVW6x35m51b8ee3vnCqSlMwLd1ZhSDmJNEeXHA1O2jV58nmuS7kDjpvYPrxk_2QfcpDe8DTUGyxfIoOmgwF4o",
				        'Content-Type: application/json'
				);

				$ch = curl_init ();
				curl_setopt ( $ch, CURLOPT_URL, $url );
				curl_setopt ( $ch, CURLOPT_POST, true );
				curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $results = curl_exec ( $ch );
        curl_close ( $ch );
        $json_resu= json_decode($results);
        if($json_resu->failure==0){
         $response['status']=1;   
         $response['msg']='Push notification sent';       
        }
        else{
          $response['status']=1;
          $response['msg']='Push notification sent';  
        }
        
        echo json_encode($response);
				
    }

    public function addvip(Request $request)
    {
      return view('admin.addvip');
    }

       public function addvip_user(Request $request)
    {
   
      $response=[];      
      if(vip_users::where('email',$request->email)->first()===null){
        $query= vip_users::insert(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>$request->password]);
        $last_insert_id =  DB::getPdo()->lastInsertId();
        $user= vip_users::where('id',$last_insert_id)->first();
        $response['status']=1;
        $response['password']=$request->password;
        $response['data']=$user;
        $response['msg']='VIP account is regstered with following credentials:'; 
      }
  else{
        $response['status']=0;
        $response['msg']='This email is already in use, Try another';       
      }
        echo json_encode($response);
    
    }

    public function room_chat(Request $request)
    {     
      $response=[];   
      $chats= chat::where('sender_id',$request->id)->orwhere('reciever_id',$request->id)->orderBy('created_at','asc')->get();
      // print_r($chats);
      // die;
      if($chats){
        $response['status']=1;
        $response['data']='';
      foreach($chats as $chat){
        if($chat->sender_id==1){
          $response['data'].='
          <div class="send-mess-wrap">        
          <div class="send-mess__inner">             
              <div class="send-mess-list">
                  <div class="send-mess">'.$chat->msg.'</div>
                
              </div>
          </div>
      </div>';
        }
        else{
          $response['data'].='
          <div class="recei-mess-wrap">        
          <div class="recei-mess__inner">
               <div class="avatar avatar--tiny">
                  <img src="'.URL('public/admin/images/icon/default-avatar.png').'" alt="John Smith">
              </div>
              <div class="recei-mess-list">
                  <div class="recei-mess">'.$chat->msg.'</div>
                
              </div>
          </div>
      </div>';
       
        }
 

      }
       
        
      }
      
      echo json_encode($response);    
      
    }

      public function savechat(Request $request)
    {
      $response=[];   
      $query= chat::insert(['sender_id'=>1,'reciever_id'=>$request->id,'msg'=>$request->msg]);
      if($query){     
       $response['status']=1;
       $response['msg']='yess';     
      }
      else{     
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

          public function weeklylist(Request $request)
    {
      $query=  weekly::get();
      return view('admin.weeklylist',array('data'=>$query));
    }

           public function eventlist(Request $request)
    {
      $query=  free_events::get();
      return view('admin.eventslist',array('data'=>$query));
    }

            public function free_training_list(Request $request)
    {
      $query=  free_training::get();
      return view('admin.freetraining_list',array('data'=>$query));
    }

              public function vip_training_list(Request $request)
    {
      $query=  vip::get();
      return view('admin.viptraining_list',array('data'=>$query));
    }

          public function delete_event(Request $request)
    {
      $response=[];   
      $query= free_events::where('id',$request->id)->delete();
      if($query){     
       $response['status']=1;
       $response['msg']='Event has been deleted';
      }
      else{     
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

              public function delete_free_training(Request $request)
    {
      $response=[];   
      $query= free_training::where('id',$request->id)->delete();
      if($query){     
       $response['status']=1;
       $response['msg']='Training has been deleted';
      }
      else{     
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

                public function delete_vip_training(Request $request)
    {
      $response=[];   
      $query= vip::where('id',$request->id)->delete();
      print_r($query);
      die;
      if($query){     
       $response['status']=1;
       $response['msg']='Training has been deleted';
      }
      else{     
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

               public function vip_user_list(Request $request)
    {
      $query=  vip_users::get();
      return view('admin.vip_user_list',array('data'=>$query));
    }
    
                  public function vip_user_delete(Request $request)
    {
      $response=[];   
      $query= vip_users::where('id',$request->id)->delete();
      if($query){     
       $response['status']=1;
       $response['msg']='User has been deleted';
      }
      else{     
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

        public function privacy_policy(Request $request)
    {
    return view('admin.privacy_policy');
    }



////church app
   public function short(Request $request)
    {
      return view('admin.short'); 
    
    }

        public function add_short(Request $request)
    {
            $response=[];   
            $query= short::insert(['title'=>$request->title,'descr'=>$request->desc,'video'=>$request->video]);           
           
            if($query){
              $response['status'] =1;
              $response['msg'] ='Training is published';

            }
            else{
              $response['status'] =0;
              $response['msg'] ='Server error';
            }
            
            echo json_encode($response);       
          
     
    
    }

  public function short_list(Request $request)
    {
      $query=  short::get();
      return view('admin.short_list',array('data'=>$query));
    }

               public function delete_short(Request $request)
    {
      $response=[];   
      $query= short::where('id',$request->id)->delete();
      if($query){     
       $response['status']=1;
       $response['msg']='Training has been deleted';
      }
      else{     
       $response['status']=0;
       $response['msg']='Server error';
      }
     echo json_encode($response);
    }

 public function change_picture(Request $request)
    {
      return view('admin.change-picture');
    }

  public function upload_picture(Request $request)
    {
        $response=[];   
        $random = Str::random(4);              
        $video =$request->file('video');
        $name =time().$random.$request->video->getClientOriginalName();
        $real_name= preg_replace("/[^a-z0-9\_\-\.]/i", '',$name); // Removes special chars.
        $destinationPath = public_path('/free_videos');
        $upload= $video->move($destinationPath,$real_name);
        $query= picture::insert(['picture'=>$real_name]);

        if($query){     
         $response['status']=1;
         $response['msg']='Picture has been uploaded';
        }
        else{     
         $response['status']=0;
         $response['msg']='Server error';
        }

         echo json_encode($response);
    }
    
    ////
    
    public function live_stream(Request $request)
    {
      $query=  live_stream::orderBy('id','desc')->first();
           return view('admin.live_stream',array('data'=>$query));
    }

       public function add_live_stream(Request $request)
    {
     $response=[];
     $query= live_stream::insert(['title'=>$request->title,'descr'=>$request->desc,'video'=>$request->video]);
     if($query){
            $response['status']=1;
            $response['msg']='Video has been published';
     }
     else{
            $response['status']=0;
            $response['msg']='Server error';
     }
    echo json_encode($response);
    
    }

           public function delete_live_stream(Request $request)
    {
     
      $response=[];
        
         $query= live_stream::where('id',$request->id)->delete();
         if($query){
          $response['status']=1;
          $response['msg']='Video has been deleted';
         }
         else{
          $response['status']=0;
          $response['msg']='Server error';
         }
        echo json_encode($response);
    }




}
