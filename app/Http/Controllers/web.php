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
use App\free_events1;
use App\fcm;
use App\tokens;
use App\free_training;
use App\vip;
use App\news;
use App\vip_users;
use App\chat;
use App\short;
use App\picture;
use App\getStatus;
use App\live_stream;
use Stripe;
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
      
      $query= vip::where('deleted_at',null)->orderBy('id','desc')->get();
      if(count($query)>0){
      	$response['data'] =$query;
        $response['status'] =1;      

      }
      else if(count($query)==0){
        $response['status'] =2;
        $response['msg'] ='No videos found';
      } else{
        $response['status'] =0;
        $response['msg'] ='Server error, Try again';
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
      
      $query= free_events::orderBy('id','desc')->get();
     if(count($query)>0){
        $response['data'] =$query;
        $response['status'] =1;      

      }
      else if(count($query)==0){
        $response['status'] =2;
        $response['msg'] ='No events found';
      } 
      else{
        $response['status'] =0;
        $response['msg'] ='Server error, Try again';
      } 
       return json_encode($response);  
    
    }
    
            public function events1(Request $request)
    {
      $response=[];
      
      $query= free_events1::orderBy('id','desc')->get();
     if(count($query)>0){
        $response['data'] =$query;
        $response['status'] =1;

      }
      else if(count($query)==0){
        $response['status'] =2;
        $response['msg'] ='No events found';
      }
      else{
        $response['status'] =0;
        $response['msg'] ='Server error, Try again';
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
  
        $response['status'] =1; 
         }
      else{          
        $response['status'] =0; 
     
      }      
      return json_encode($response);    
    
    }

                public function getshort(Request $request)
    {
      $response=[];   
      
      $query= short::orderBy('id','desc')->get();
   
     if(count($query)>0){
        $response['data'] =$query;
        $response['status'] =1;      

      }
      else if(count($query)==0){
        $response['status'] =2;
        $response['msg'] ='No videos found';
      } 
      else{
        $response['status'] =0;
        $response['msg'] ='Server error, Try again';
      } 
       return json_encode($response);    
    
    }

 public function getpictures(Request $request)
    {
      $response=[];   
      
      $query= picture::orderBy('id','desc')->first();
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
    
                public function getlivestream(Request $request)
     {
        $response=[];
       
        $query= live_stream::orderBy('id','desc')->first();
    
        $response['data'] =$query;
        $response['status'] =1;
         
        return json_encode($response);
     
     }
    
              public function stripepay(Request $request)
     {
         
             Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
             $res= Stripe\Charge::create ([
                     "amount" => $request->amount*100,
                     "currency" => "usd",
                     "source" => $request->stripeToken,
                     "description" =>
                                      "name: ".  $request->fname.
                                      ", address: ".  $request->address.
                                      ", city: ".  $request->city.
                                      ", state: " . $request->state.
                                      ", zcode: " . $request->zcode
                             ]);
         
         if(isset($res->id)){
             $response['status'] =1;
         }else{
              $response['status'] =0;
             
         }
         return json_encode($response);
         
       
           
               
            
     
     }
    
    public function stripeSubscribe(Request $request){
        

             Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

           $plan =  \Stripe\Plan::create([
              'amount' => $request->amount*100 ,
              'currency' => 'usd',
              'interval' => $request->interval,
              'product' => ['name' => $request->plan_name
                                 ],
            ]);
        
                 if(isset($plan->id)){
                     
                               $customer = \Stripe\Customer::create([
                                  'email' => $request->email,
                                  'source'  => $request->stripeToken,
                                ]);
                             if(isset($customer->id)){
                                 
                                 $subscription = \Stripe\Subscription::create([
                                     'customer' => $customer->id,
                                     'items' => [['plan' => $plan->id]],
                                 ]);
                                 
                                 if(isset($subscription->id)){
                                        $response['status'] =1;
                                       
                                     
                                 }else{
                                      $response['status'] =0;
                                     
                                 }

                                 
                             }else{
                                  $response['status'] =0;
                                 
                             }
                
                     
                 
                      }else{
                           $response['status'] =0;
                          
                      }
           
        
         return json_encode($response);
        
    }
    
             public function paypal(Request $request)
    {
        
            
        
      
        
    }
    
             public function apple(Request $request)
    {
        
            
        
      
        
    }
    
           public function getStatusApi(Request $request)
    {
        $response=[];
          
          $query= getStatus::orderBy('id','desc')->first();
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
    
    
           public function savePushSetting(Request $request)
    {
        $response=[];
          
          $query= tokens::where('token',$request->token)->update(['status'=>$request->status]);
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
    
          public function getPushSetting(Request $request)
    {
        $response=[];
          
          $query= tokens::where('token',$request->token)->first();
          if($query){
            $response['data'] = $query;
            $response['status'] = 1;

          }
          else{
            $response['status'] =0;
            $response['msg'] ='Server error';
          }
          
          return json_encode($response);
            
    }
    
          public function saveToken(Request $request)
    {
          $response=[];
          $query= tokens::insert(['token'=>$request->token,'status'=>1]);
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
    
        public function meetUs(Request $request)
    {
          $response=[];
         
          $response['status'] =1;
          
          return json_encode($response);
            
    }

}
