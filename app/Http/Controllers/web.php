<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mail;
use App\weekly;
use App\free_events;
use App\fcm;
use App\tokens;
use App\free_training;
use App\vip;
use App\news;
use App\vip_users;
use App\chat;

class web extends Controller
{
          public function loginauth(Request $request)
    {    

              $response=[];      
       if(vip_users::where('email',$request->email)->where('password',$request->password)->first()===null){
              $response['status']=0;
			  $response['msg']='Invalid credentials, Try again';   
      }
      else{
      	      $response['status']=1;
              $response['msg']='Logged in';           
			    
          }
            return json_encode($response);
    }

          public function vip_training(Request $request)
    {
      $response=[]; 	
      
      $query= vip::get();
      if($query){
      	$response['data'] =$query;
        $response['status'] =1;      

      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error';
      }
      
      return json_encode($response);       
    
    
    }

            public function free_training(Request $request)
    {
      $response=[]; 	
      
      $query= free_training::get();
      if($query){
      	$response['data'] =$query;
        $response['status'] =1;      

      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error';
      }
      
      return json_encode($response);    
    
    }

           public function news(Request $request)
    {
      $response=[]; 	
      
      $query= news::get();
      if($query){
      	$response['data'] =$query;
        $response['status'] =1;      

      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error';
      }
      
      return json_encode($response);    
    
    }

             public function events(Request $request)
    {
      $response=[]; 	
      
      $query= free_events::get();
      if($query){
      	$response['data'] =$query;
        $response['status'] =1;      

      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error';
      }
      
      return json_encode($response);    
    
    }

             public function weekly(Request $request)
    {
      $response=[]; 
      
      $query= weekly::get();
      if($query){
      	$response['data'] =$query;
        $response['status'] =1;      

      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error';
      }
      
      return json_encode($response);    
    
    }

            public function updatetokens(Request $request)
    {
      $response=[]; 
      
    
      if(tokens::where('token',$request->token)->first()===null){
      	tokens::insert(['token'=>$request->token]);
        $response['status'] =2; 
        $response['msg'] ='Inserted';     

      }
      else{
        $response['status'] =1;
        $response['msg'] ='Exists already';
      }
      
      return json_encode($response);    
    
    }

             public function getchat(Request $request)
    {
      $response=[]; 
      
       $data= chat::where('sender_id',$request->token)->orwhere('reciever_id',$request->token)->get();
      if(count($data)==0){      
        $response['status'] =0; 
        $response['msg'] ='no chat';     
      }
      else{

        $response['data'] =$data;
        $response['status'] =1;
        $response['msg'] ='Exists already';
      }
      
      return json_encode($response);    
    
    }

          public function savechat(Request $request)
    {



       $response=[]; 
      
       $query= chat::insert(['sender_id'=>$request->token,'reciever_id'=>1,'msg'=>$request->msg]);
      if($query){    
           $data = array(       
          'subject' =>'query',
          'bodyMessage' =>$request->msg,
          'postersemail' =>'harindersindiit@gmail.com');
          Mail::send('admin.mailmessage',$data,function($message) use ( $data)
           {      
                $message->to( $data['postersemail'] );
                $message->subject($data['subject']); 
                     
          });
  
        $response['status'] =1; 
         }
      else{          
        $response['status'] =0; 
     
      }      
      return json_encode($response);    
    
    }
}
