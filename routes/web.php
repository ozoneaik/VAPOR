<?php

use App\Http\Controllers\UpdateLeaveForm\CEO\CEO_REQ_UpdateController;
use App\Http\Controllers\UpdateLeaveForm\HR\HR_REQ_UpdateController;
use App\Http\Controllers\UpdateLeaveForm\PM\PM_REQ_UpdateController;
use App\Http\Controllers\UpdateLeaveForm\REP_UpdateController;
use App\Http\Controllers\UpdateLeaveForm\REQ_UpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaveFormController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\UserAccess;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\SendMailController;


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes([
    'verify' => true
]);

//Auth::routes();

Route::get('/test', function () {
    return view('test');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
//['auth', 'verified']
Route::middleware(['auth','verified'])->group(function () {

    Route::get('/refresh',function (){
       return back();
    })->name('refresh');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('profile');
    Route::post('/profile_update/{id}', [HomeController::class, 'profile_update'])->name('profile.update');

    Route::get('/req_list', [REQ_UpdateController::class, 'req'])->name('req');
    Route::get('/req_list_detail/{id}', [REQ_UpdateController::class, 'req_list_detail'])->name('req.detail');
    Route::get('/cancel/{id}',[LeaveFormController::class,'cancel'])->name('cancel');
    Route::get('/form', [LeaveFormController::class, 'create'])->name('create');
    Route::post('/store', [LeaveFormController::class, 'store'])->name('leaveform.store');

    Route::get('/rep_list', [REP_UpdateController::class, 'rep'])->name('rep');
    Route::match(['get', 'post'], '/rep_list_detail/{id}', [REP_UpdateController::class, 'rep_list_detail'])->name('rep.detail');
    Route::put('/rep_list_detail_update/{id}', [REP_UpdateController::class, 'rep_list_detail_update'])->name('rep.update');

    //filter
    Route::get('/req/filter', [FilterController::class, 'filter'])->name('filter.req');


    //Normal Employee route list
    Route::middleware('user-access:emp')->group(function () {

    });

    //Project manager route list
    Route::middleware('user-access:pm')->group(function () {
        Route::get('/req_list_emp_pm', [PM_REQ_UpdateController::class, 'PM_req'])->name('pm.req.emp');
        Route::match(['get', 'post'], '/req_list_emp_detail/{id}', [PM_REQ_UpdateController::class, 'req_list_emp_detail'])->name('pm.req.emp.detail');
        Route::match(['get', 'post'], '/req_list_emp_detail_update/{id}', [PM_REQ_UpdateController::class, 'req_list_emp_detail_update'])->name('pm.req.emp.update');
    });

    //HR route list
    Route::middleware('user-access:hr(admin)')->group(function () {
        Route::get('/req_list_emp_hr', [HR_REQ_UpdateController::class, 'HR_req'])->name('hr.req.emp');
        Route::match(['get', 'post'], '/hr_req_list_emp_detail/{id}', [HR_REQ_UpdateController::class, 'hr_req_list_emp_detail'])->name('hr.req.emp.detail');
        Route::match(['get', 'post'], '/hr_req_list_emp_detail_update/{id}', [HR_REQ_UpdateController::class, 'hr_req_list_emp_detail_update'])->name('hr.req.emp.update');
    });

    //CEO route list
    Route::middleware('user-access:ceo')->group(function () {
        Route::get('/req_list_emp_ceo', [CEO_REQ_UpdateController::class, 'CEO_req'])->name('ceo.req.emp');
        Route::match(['get', 'post'], '/ceo_req_list_emp_detail/{id}', [CEO_REQ_UpdateController::class, 'ceo_req_list_emp_detail'])->name('ceo.req.emp.detail');
        Route::match(['get', 'post'], '/ceo_req_list_emp_detail_update/{id}', [CEO_REQ_UpdateController::class, 'ceo_req_list_emp_detail_update'])->name('ceo.req.emp.update');
    });

    Route::middleware(['auth', 'user-access:hr(admin),ceo,pm'])->group(function () {
        Route::get('/data_users', [HomeController::class, 'data_users'])->name('data.users');
        Route::get('/data_user_detail/{id}', [HomeController::class, 'data_user_detail'])->name('data.user.detail');
        Route::get('/data_user_history/{id}', [HomeController::class,'data_user_history'])->name('data.user.history');
        Route::match(['get', 'post'], '/leave_update/{id}', [HomeController::class, 'update_leave_data'])->name('leave.update');
        Route::get('/switch_per',[HomeController::class,'switch_per'])->name('hr.switch.per');
        Route::get('/update_per', [HomeController::class, 'update_per'])->name('hr.update.per');
    })->middleware(UserAccess::class);

    Route::get('pdf/{id}', [PDFController::class, 'pdf'])->name('pdf');
    Route::delete('/users/{id}', [HomeController::class,'destroy'])->name('hr.delete');
    Route::patch('/users/{id}/restore', [HomeController::class,'restore'])->name('user.restore');
    Route::get('/restore', [HomeController::class, 'recovery'])->name('restore.index');

});

//Login with Google
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

Route::get('/send-mail', [SendMailController::class, 'index']);
Route::get('/page-mail',function (){
    return view('emails.sample');
});
