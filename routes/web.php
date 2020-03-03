<?php

Route::group(['prefix'=>'admin'], function(){ 
        Route::get('login','admin@login')->name('login');
});

Route::post('/loginauth','admin@loginauth')->name('loginauth');
Route::post('/loginauth','admin@loginauth')->name('loginauth');
Route::get('/privacy-policy','admin@privacy_policy');


Route::group(['prefix'=>'admin', 'as'=>'admin.','middleware'=>'authmiddleware'], function(){ 
	Route::get('/',function(){
           return view('admin.weekly');
	});	
		Route::get('/dashboard','admin@dashboard')->name('dashboard');
		Route::get('/messages','admin@messages')->name('messages');

		Route::get('/weekly','admin@weekly')->name('weekly');
		Route::post('/add-weekly','admin@add_weekly')->name('add_weekly');
		Route::post('/delete-weekly','admin@add_weekly')->name('add_weekly');

		Route::get('/free-events','admin@free_events')->name('free_events');
		Route::post('/add-free-events','admin@add_free_events')->name('add_free_events');
		Route::post('/delete-free-events','admin@delete_free_events')->name('delete_free_events');

		Route::get('/free-training','admin@free_training')->name('free_training');
		Route::post('/add-free-training','admin@add_free_training')->name('add_free_training');
	
		Route::get('/vip-training','admin@vip_training')->name('vip_training');
		Route::post('/add-vip-training','admin@add_vip_training')->name('add_vip_training');
		
		Route::get('/news','admin@news')->name('news');
		Route::post('/add-news','admin@add_news')->name('add_news');
		

		Route::get('/fcm','admin@fcm')->name('fcm');
		Route::post('/send-fcm','admin@send_fcm')->name('send_fcm');

		Route::get('/logout','admin@logout')->name('logout');

		Route::get('/addvip','admin@addvip')->name('addvip');
		Route::post('/addvip_user','admin@addvip_user')->name('addvip_user');

		Route::post('/room_chat','admin@room_chat')->name('room_chat');

		Route::post('/savechat','admin@savechat')->name('savechat');

		Route::get('/weeklylist','admin@weeklylist')->name('weeklylist');


		Route::get('/eventlist','admin@eventlist')->name('eventlist');

		Route::get('/free-training-list','admin@free_training_list')->name('free_training_list');

		Route::get('/vip-training-list','admin@vip_training_list')->name('vip_training_list');

		Route::post('/delete_weekly','admin@delete_weekly')->name('delete_weekly');
		
		Route::post('/delete_event','admin@delete_event')->name('delete_event');

		Route::post('/delete_free_training','admin@delete_free_training')->name('delete_free_training');

		Route::post('/delete_vip_training','admin@delete_vip_training')->name('delete_vip_training');

		Route::get('/vip-user-list','admin@vip_user_list')->name('vip_user_list');

		Route::post('/vip_user_delete','admin@vip_user_delete')->name('vip_user_delete');
		Route::get('/news-list','admin@news_list')->name('news_list');
		Route::post('/delete-news','admin@delete_news')->name('delete_news');
		
});

 
Route::group(['prefix'=>'web'], function(){ 

		Route::post('/loginauth','web@loginauth');
		Route::post('/vip_training','web@vip_training');
		Route::post('/free_training','web@free_training');
		Route::post('/news','web@news');
		Route::post('/events','web@events');
		Route::post('/weekly','web@weekly');
		Route::post('/updatetokens','web@updatetokens');
		Route::post('/getchat','web@getchat');
		Route::post('/savechat','web@savechat');


});

