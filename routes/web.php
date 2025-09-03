<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/home', function () {
    return view('welcome');
});

Route::redirect('/', '/launch')->name('home');


// Route::any('{any}', function () {
//     return redirect()->route('countdown');
// })->where('any', '^(?!count-down).*');

Route::get('/count-down', function () {
    return view('countdown');
})->name('countdown');

Route::get('/launch', function () {
    return view('launch');
})->name('launch');

// Route::redirect('/home', '/')->name('home');
Route::redirect('/user', '/login');
Route::redirect('/rep', '/rep/login');
Route::redirect('/admin','/admin/login');

// login routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('user.login');
Route::post('/login', 'Auth\LoginController@login')->name('login.post');

// Forgot Password Routes
Route::get('/forgot-password', 'Auth\LoginController@showForgotPassword')->name('password.request');
Route::post('/forgot-password', 'Auth\LoginController@sendResetLink')->name('password.email');

// Reset Password Routes
Route::get('/reset-password/{token}', 'Auth\LoginController@showResetForm')->name('password.reset');
Route::post('/reset-password', 'Auth\LoginController@resetPassword')->name('password.update');



// registration routes
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('user.register');
Route::post('/register', 'Auth\RegisterController@register')->name('register.post');
// logout route
Route::match(['get', 'post'], '/logout', 'Auth\LoginController@logout')->name('logout');











// Auth::routes();


// Route::redirect('/home','/')->name('home');


// Route::redirect('/smyl','/smyl/login');
// Route::redirect('/rep','/rep/login');
// Route::redirect('/admin','/admin/login');


// Route::get('/smyl/create-account', function () {
//   $reps = 'App\Models\Rep';
//     return view('auth.register',['refs' => $reps]);
// });

// Route::get('/smyl/login', function () {
//     return view('auth.login');
// });

// Route::get('/contact', 'Account\HomeController@contact')->name('contact');
// Route::post('/contact', 'ContactController@store')->name('contact');

// USER ROUTES
Route::group([
  'prefix'=>'/userend',
  'as' => 'userend.',
  'middleware'=> ['auth', 'Userlock'],
], function(){
    // die('count down in progress');
    Route::get('dashboard', 'User\DefaultController@index')->name('dashboard');
    Route::get('plans', 'User\DefaultController@plans')->name('plans');
    
    Route::get('withdrawal', 'User\WithdrawalController@index')->name('withdraw');
    Route::post('withdrawal', 'User\WithdrawalController@store')->name('withdrawal');
    
      Route::get('fund', 'User\WithdrawalController@page')->name('manual-funding');
    Route::post('fund', 'User\WithdrawalController@mfund')->name('manual-fund-request');

    
    Route::get('plans/{plan}/details', 'User\DefaultController@planDetails')->name('planDetails');
    Route::get('transactions', 'User\DefaultController@transactions')->name('transactions');
    Route::get('wallet', 'User\DefaultController@wallet')->name('wallet');
    Route::get('profile', 'User\DefaultController@profile')->name('profile');
    Route::get('editProfile', 'User\DefaultController@editProfile')->name('editProfile');
    Route::put('updateProfile', 'User\DefaultController@updateProfile')->name('updateProfile');
    Route::get('contact', 'User\DefaultController@contact')->name('contact');
    Route::get('documentation', 'User\DefaultController@documentation')->name('documentation');
    Route::get('contact-us', 'User\DefaultController@contactUs')->name('contactUsnew');
    
});



// SMYL
Route::group([
  'prefix'=>'/smyl',
  'as' => 'smyl.'
   // 'namespace' => 'User'
], function(){

  // Route::get('/create-account', function () {
  //   $reps = App\Models\Rep::all();
  //     return view('auth.register',['refs' => $reps]);
  // });

  Route::get('/login', function () {
      return view('auth.login');
  })->name('login');

  Route::group([
    'middleware'=> ['auth','Userlock']
  ],function(){
    //   die('count down in progress');
    Route::get('dashboard','Account\SmylController@index')->name('dashboard');
    
    Route::get('profile','Account\SmylController@profile')->name('profile');
    Route::get('editProfile/{user}','Account\SmylController@editProfile')->name('editProfile');
    Route::put('updateProfile/{userID}','Account\SmylController@updateProfile')->name('updateProfile');
    
    Route::get('transactions','Account\SmylController@transactions')->name('transactions');
    
    Route::get('wallet','Account\SmylController@wallet')->name('wallet');
    
    Route::get('contact',function(){
        return view('smyl.contact');
    })->name('contact');
    
    Route::get('documentation','Account\SmylController@documentation')->name('documentation');
    
    Route::get('get-pin','Account\SmylController@getPin')->name('getPin');
    
   Route::get('airtime','Account\SmylController@airtime')->name('airtime');
   Route::post('airtime','Account\SmylController@pairtime')->name('pairtime');

   Route::get('data','Account\SmylController@data')->name('data');
   Route::post('data','Account\SmylController@pdata')->name('pdata');
   
   Route::get('bankTransfer','Account\SmylController@bankTransfer')->name('bankTransfer');
   Route::post('bankTransfer','Account\SmylController@pbankTransfer')->name('bankTransfer');
   
   Route::get('phcn','Account\SmylController@phcn')->name('phcn');
   Route::post('phcn','Account\SmylController@pphcn')->name('pphcn');
   
   Route::get('tvsub','Account\SmylController@tvsub')->name('tvsub');
   Route::post('tvsub','Account\SmylController@ptvsub')->name('ptvsub');
   
  });


});


// REP ROUTES

Route::group([
  'prefix'=>'/rep',
  'as' => 'rep.',
  'namespace' => 'Rep'
], function(){

    // authentication routes.....
    Route::get('login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('login','Auth\LoginController@login')->name('repLogin');
    Route::post('logout','Auth\LoginController@logout')->name('repLogout');

  Route::group([
    'middleware'=> ['auth:rep','Replock' ]
  ],function(){
    Route::get('dashboard','DefaultController@index')->name('dashboard');
    Route::get('users','DefaultController@users')->name('users');
    Route::get('userDetails/{user}', 'DefaultController@userDetails')->name('userDetails');
    Route::get('plans','DefaultController@plans')->name('plans');
    Route::post('plans/create','DefaultController@createPlan')->name('createPlan');
    Route::put('plans/{plan}','DefaultController@updatePlan')->name('updatePlan');
    Route::delete('plans/{plan}','DefaultController@deletePlan')->name('deletePlan');
    Route::get('plans/{plan}/details','DefaultController@planDetails')->name('planDetails');
    Route::post('plans/{plan}/contribute','DefaultController@makeContribution')->name('makeContribution');
    Route::post('plans/{plan}/revisit','DefaultController@revisitContribution')->name('revisitContribution');
    Route::get('transactions','DefaultController@transactions')->name('transactions');
    Route::get('usersWallet','DefaultController@usersWallet')->name('usersWallet');
    Route::get('profile','DefaultController@profile')->name('profile');
    Route::get('editProfile/{rep}','DefaultController@editProfile')->name('editProfile');
    Route::put('updateProfile/{repID}','DefaultController@updateProfile')->name('updateProfile');
    Route::get('users','DefaultController@users')->name('users');
    
    Route::get('user-transactions','DefaultController@userTransaction')->name('userTransaction');
        
    Route::get('contact',function(){
       return view('repEnd.contact'); 
    })->name('contact');
    
    Route::get('wallet','DefaultController@usersWallet')->name('usersWallet');
    Route::get('accUsers','DefaultController@accUsers')->name('accUsers');
    Route::get('user/{transType}/{userID}','DefaultController@DebitOrCreditUser')->name('user');
    Route::post('updateUserWallet/{transType}/{userID}','DefaultController@updateUserWallet')->name('updateUserWallet');
    Route::get('editUser/{user}','DefaultController@editUser')->name('editUser');
    Route::put('updateUserProfile/{userID}','DefaultController@updateUserProfile')->name('updateUserProfile');
    Route::get('changeUserPassword/{user}','DefaultController@changeUserPassword')->name('changeUserPassword');
    Route::put('updateUserPassword/{userID}','DefaultController@updateUserPassword')->name('updateUserPassword');
    Route::get('transactions','DefaultController@transactions')->name('transactions');
    
        Route::get('Ptransactions','DefaultController@Ptransactions')->name('Ptransactions');
        
    Route::get('deleteUser/{user}','DefaultController@deleteUser')->name('deleteUser');

  });


});



// MANAGER ROUTES

Route::group([
  'prefix'=>'/manager',
  'as' => 'manager.',
  'namespace' => 'Manager'
], function(){

     // authentication routes.....
     Route::get('login','Auth\LoginController@showLoginForm')->name('login');
     Route::post('login','Auth\LoginController@login')->name('adminLogin');
     Route::post('logout','Auth\LoginController@logout')->name('adminLogout');

  Route::group([
    'middleware'=> 'auth:manager'
  ],function(){
    Route::get('dashboard','DefaultController@index')->name('dashboard');
    Route::get('profile','DefaultController@profile')->name('profile');

    Route::get('addRep','DefaultController@addRep')->name('addRep');
    Route::post('createRep','DefaultController@createRep')->name('createRep');

    Route::get('editProfile/{admin}','DefaultController@editProfile')->name('editProfile');
    Route::put('updateProfile/{adminID}','DefaultController@updateProfile')->name('updateProfile');
    // Route::get('users','DefaultController@users')->name('users');
    Route::get('reps','DefaultController@reps')->name('reps');
    // Route::get('wallet','DefaultController@usersWallet')->name('usersWallet');
    Route::get('accUsers','DefaultController@accUsers')->name('accUsers');
    Route::get('user/{transType}/{userID}','DefaultController@DebitOrCreditUser')->name('user');
    Route::post('updateUserWallet/{transType}/{userID}','DefaultController@updateUserWallet')->name('updateUserWallet');
    Route::get('editUser/{user}','DefaultController@editUser')->name('editUser');
    
  Route::get('sendMessage','DefaultController@sendMessage')->name('sendMessage');
  Route::post('sendMessage','DefaultController@psendMessage')->name('psendMessage');
  
    Route::get('testSms','DefaultController@testSms')->name('testSms');
  Route::post('testSms','DefaultController@ptestSms')->name('ptestSms');

    
    Route::get('editRep/{rep}','DefaultController@editRep')->name('editRep');
    Route::put('updateUserProfile/{userID}','DefaultController@updateUserProfile')->name('updateUserProfile');
    Route::put('updateRepProfile/{repID}','DefaultController@updateRepProfile')->name('updateRepProfile');
    
    Route::get('changeUserPassword/{user}','DefaultController@changeUserPassword')->name('changeUserPassword');
    Route::put('updateUserPassword/{userID}','DefaultController@updateUserPassword')->name('updateUserPassword');
    Route::get('changeRepPassword/{rep}','DefaultController@changeRepPassword')->name('changeRepPassword');
    Route::put('updateRepPassword/{repID}','DefaultController@updateRepPassword')->name('updateRepPassword');
    Route::get('transactions','DefaultController@transactions')->name('transactions');
    
        Route::get('approveCredit/{transID}','DefaultController@approveCredit')->name('approveCredit');
        
    Route::get('disApproveCredit/{transID}','DefaultController@disApproveCredit');
    
    Route::get('approveAllCredits','DefaultController@approveAllCredits');

 Route::get('RepPtransactions/{repID}','DefaultController@RepPtransactions')->name('RepPtransactions');
 
    Route::get('Ptransactions','DefaultController@Ptransactions')->name('Ptransactions');
    
        Route::get('pendingUserCredit/{userID}','DefaultController@PUsertransactions')->name('PUsertransactions');

    Route::get('deleteUser/{user}','DefaultController@deleteUser')->name('deleteUser');
    Route::get('deleteRep/{rep}','DefaultController@deleteRep')->name('deleteRep');
    });

});

// ADMIN ROUTES

Route::group([
  'prefix'=>'/admin',
  'as' => 'admin.',
  'namespace' => 'Admin'
], function(){

     // authentication routes.....
     Route::get('login','Auth\LoginController@showLoginForm')->name('login');
     Route::post('login','Auth\LoginController@login')->name('adminLogin');
     Route::post('logout','Auth\LoginController@logout')->name('adminLogout');

  Route::group([
    'middleware'=> 'auth:admin'
  ],function(){
    Route::get('dashboard','DefaultController@index')->name('dashboard');
    
    //admin
    Route::get('profile','DefaultController@profile')->name('profile');
    
    Route::get('editProfile/{admin}','DefaultController@editProfile')->name('editProfile');
    Route::put('updateProfile/{adminID}','DefaultController@updateProfile')->name('updateProfile');
    
    //requests
    Route::get('withdrawal','DefaultController@withdrawal')->name('withdrawal');
    Route::post('withdrawal/{withdrawal}/update-status','DefaultController@updateWithdrawalStatus')->name('updateWithdrawalStatus');
    Route::get('manualfunding','DefaultController@manualfunding')->name('manualfunding');
    Route::post('manualfunding/{manualfund}/update-status','DefaultController@updateManualFundingStatus')->name('updateManualFundingStatus');

    
    // reps
    Route::get('reps','DefaultController@reps')->name('reps');
    Route::get('repDetails/{rep}','DefaultController@repDetails')->name('repDetails');
    Route::get('lockRep','DefaultController@lockrep')->name('lockrep');
    
    // plans
    Route::get('plans','DefaultController@plans')->name('plans');
    Route::get('plans/{plan}/details', 'DefaultController@planDetails')->name('planDetails');
    Route::get('breakPlan/{planId}','DefaultController@breakPlan')->name('breakPlan');
    
    Route::get('addRep','DefaultController@addRep')->name('addRep');
    Route::post('createRep','DefaultController@createRep')->name('createRep');
    
    Route::get('editRep/{rep}','DefaultController@editRep')->name('editRep');
    Route::put('updateRepProfile/{repID}','DefaultController@updateRepProfile')->name('updateRepProfile');

    Route::get('changeRepPassword/{rep}','DefaultController@changeRepPassword')->name('changeRepPassword');
    Route::put('updateRepPassword/{repID}','DefaultController@updateRepPassword')->name('updateRepPassword');
    
   Route::get('deleteRep/{rep}','DefaultController@deleteRep')->name('deleteRep');
   
   Route::get('RepPtransactions/{repID}','DefaultController@RepPtransactions')->name('RepPtransactions');


    // managers
    Route::get('managers','DefaultController@managers')->name('managers');
    Route::get('addManager','DefaultController@addManager')->name('addManager');
    Route::post('createManager','DefaultController@createManager')->name('createManager');
    
    Route::get('editManager/{manager}','DefaultController@editManager')->name('editManager');
    Route::put('updateManagerProfile/{managerID}','DefaultController@updateManagerProfile')->name('updateManagerProfile');

    Route::get('changeManagerPassword/{manager}','DefaultController@changeManagerPassword')->name('changeManagerPassword');
    Route::put('updateManagerPassword/{managerID}','DefaultController@updateManagerPassword')->name('updateManagerPassword');
    Route::get('deleteManager/{manager}','DefaultController@deleteManager')->name('deleteManager');


    // users
    Route::get('users','DefaultController@users')->name('users');
    Route::get('userDetails/{user}','DefaultController@userDetails')->name('userDetails');
    
    Route::get('user-transactions','DefaultController@userTransaction')->name('userTransaction');
    
    Route::get('editUser/{user}','DefaultController@editUser')->name('editUser');
    Route::put('updateUserProfile/{userID}','DefaultController@updateUserProfile')->name('updateUserProfile');

    Route::get('lockUser','DefaultController@lockUser')->name('lockUser');

    Route::get('changeUserPassword/{user}','DefaultController@changeUserPassword')->name('changeUserPassword');
    Route::put('updateUserPassword/{userID}','DefaultController@updateUserPassword')->name('updateUserPassword');
    
    Route::get('user/{transType}/{userID}','DefaultController@DebitOrCreditUser')->name('user');

    
    //general 
    Route::get('wallet','DefaultController@usersWallet')->name('usersWallet');
    Route::get('accUsers','DefaultController@accUsers')->name('accUsers');
    Route::post('updateUserWallet/{transType}/{userID}','DefaultController@updateUserWallet')->name('updateUserWallet');
    
  Route::get('sendMessage','DefaultController@sendMessage')->name('sendMessage');
  Route::post('sendMessage','DefaultController@psendMessage')->name('psendMessage');
  
    Route::get('testSms','DefaultController@testSms')->name('testSms');
  Route::post('testSms','DefaultController@ptestSms')->name('ptestSms');

    
    
    
    
    Route::get('transactions','DefaultController@transactions')->name('transactions');
    
   Route::get('approveCredit/{transID}','DefaultController@approveCredit')->name('approveCredit');
    Route::get('disApproveCredit/{transID}','DefaultController@disApproveCredit');
    Route::get('approveAllCredits','DefaultController@approveAllCredits');

 
    Route::get('Ptransactions','DefaultController@Ptransactions')->name('Ptransactions');
    
        Route::get('pendingUserCredit/{userID}','DefaultController@PUsertransactions')->name('PUsertransactions');

    Route::get('deleteUser/{user}','DefaultController@deleteUser')->name('deleteUser');
    
    //bills payment
     Route::resources([
      'productcats' =>'ProductcatController',
      'products' => 'ProductController',
    ]);
    
    });

});



