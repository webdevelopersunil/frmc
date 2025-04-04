<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Nodal\WorkCenterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SuperAdmin\RoleManagementController;

use App\Http\Controllers\Nodal\DashboardController as NodalDashboardController;
use App\Http\Controllers\Nodal\ComplainantController as NodalComplaintController;

use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ComplaintController as UserComplaintController;

use App\Http\Controllers\Fco\ReportController as FcoReportController;
use App\Http\Controllers\Fco\DashboardController as FcoDashboardController;
use App\Http\Controllers\Fco\ComplainantController as FcoComplaintController;
use App\Http\Controllers\Fco\UserReportsController  as FcoUserReportsController;

use App\Http\Controllers\FrmcUser\DashboardController as FrmcUserDashboardController;
use App\Http\Controllers\FrmcUser\ComplaintController as FrmcComplaintController;

use App\Http\Controllers\UserManagementController;

use App\Services\OtpService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// User Frontend Routes Start
Route::get('/',                                         [FrontendController::class, 'index'])->name('welcome');
Route::get('/admin',                                    [FrontendController::class, 'adminWelcome'])->name('admin');
Route::get('/user/login',                               [FrontendController::class, 'userLogin'])->name('user.login');
Route::get('/admin/login',                              [FrontendController::class, 'adminLogin'])->name('admin.login');
Route::get('complainant/login',                         [FrontendController::class, 'complainantLogin'])->name('complainant.login');
Route::post('/confirm/otp-verification',                [RegisteredUserController::class, 'confirmOtpVerification'])->name('confirm.otp-verification');


Route::middleware(['auth', 'verified', 'role:super-admin'])->group(function () {
    // User Role Management Routes Start
    Route::get('/users',                                    [RoleManagementController::class, 'index'])->name('user.roles.list');
    Route::get('/user/edit/{token}',                        [RoleManagementController::class, 'edit'])->name('user.edit');
    Route::patch('/user-role/{id}',                         [RoleManagementController::class, 'update'])->name('user.role.update');
});


// OTP Test Purpose Route
Route::get('/send-otp', function () {
    
    $otpService = new OtpService();
    $status = $otpService->sendOtp(7876976192, 202422, 'ABCD1234');
    echo $status;
});

Route::fallback([ProfileController::class, 'dashboard']);



Route::middleware(['session.timeout'])->group(function () {


// Authenticated User File Preview Routes
Route::middleware(['auth', 'verified', 'role:user,nodal,fco'])->group(function () { 
    Route::get('/preview/file/{file_id}',               [CommonController::class, 'previewFile'])->name('preview.file');
});


// User Routes
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {

    Route::get('/user-dashboard',                       [UserDashboardController::class, 'index'] )->name('user.dashboard');
    Route::get('/user-complaints/list',                 [UserComplaintController::class, 'index'] )->name('user.complaints');
    Route::get('/user-complaints/edit/{id}',            [UserComplaintController::class, 'edit'] )->name('user.complaint.edit');

    Route::post('/user-complaints/update',              [UserComplaintController::class, 'update'] )->name('user.complaint.update');

    Route::get('/user-complaint/create',                [UserComplaintController::class, 'create'] )->name('user.complaint.create');
    Route::post('/user-complaint/store',                [UserComplaintController::class, 'store'] )->name('user.complaint.store');
    Route::get('/user-complaint/view/{complain_id}',    [UserComplaintController::class, 'view'] )->name('user.complaint.view');
});


// Nodal Officer Routes
Route::middleware(['checkUserStatus', 'auth', 'verified', 'role:nodal'])->group(function () {
    
    Route::get('/nodal-dashboard',                      [NodalDashboardController::class, 'index'] )->name('nodal.dashboard');
    Route::get('/nodal-complaints/list',                [NodalComplaintController::class, 'index'] )->name('nodal.complaints');
    Route::get('/nodal-complaints/edit/{list_id}',      [NodalComplaintController::class, 'edit'] )->name('nodal.complaint.edit');
    Route::post('/nodal-complaints/update',             [NodalComplaintController::class, 'update'] )->name('nodal.complaint.update');
    Route::get('/nodal-complaint/view/{complain_id}',   [NodalComplaintController::class, 'view'] )->name('user.nodal.view');
    Route::get('/storage/app/{path}/{file}',            [CommonController::class, 'previewview'])->name('storage.preview');
});


// FCO Officer Routes
Route::middleware(['auth', 'verified', 'role:fco'])->group(function () {

    Route::get('/complains/export', [FcoComplaintController::class, 'export'])->name('complains.export');

    Route::get('/fco-report',                           [FcoReportController::class, 'index'] )->name('fco.report');
    Route::get('/fco-dashboard',                        [FcoDashboardController::class, 'index'] )->name('fco.dashboard');
    Route::get('/fco-complaints/list',                  [FcoComplaintController::class, 'index'] )->name('fco.complaints');
    Route::get('/fco-complaints/edit/{list_id}',        [FcoComplaintController::class, 'edit'] )->name('fco.complaint.edit');
    Route::get('/fco-complaints/view/{complain_id}',    [FcoComplaintController::class, 'view'] )->name('fco.complaint.view');
    Route::post('/fco-complaints/update',               [FcoComplaintController::class, 'update'] )->name('fco.complaint.update');
    Route::get('/fco-complaints/{id}/change-work-centre', [FcoComplaintController::class, 'workCentreEdit'] )->name('fco.change.work.centre');
    Route::post('/fco-complaints/update-work-centre',   [FcoComplaintController::class, 'workCentreUpdate'] )->name('fco.complaint.work-centre.update');

    // User  Report
    Route::get('/fco/user-reports',                      [FcoUserReportsController::class, 'index'])->name('fco.user.report');
    Route::get('/fco/user-reports/export',               [FcoUserReportsController::class, 'reportExport'])->name('user.report.export');
    Route::get('/fco/user-profile/{user_id}',            [FcoUserReportsController::class, 'profileView'])->name('fco.user.profile');
    Route::post('/fco/user-profile',                     [FcoUserReportsController::class, 'UserProfileUpdate'])->name('fco.user-profile.update');
    
    // Audit Logs Routes Start
    Route::get('/audits',                               [AuditController::class, 'index'])->name('audit');
    Route::get('/view/audits/{id}',                     [AuditController::class, 'viewAudit'])->name('view.audit');
    Route::get('/set-audit/filter/',                    [AuditController::class, 'setFilter'])->name('set.filter');

    // User Management
    Route::get('/user-management/{type}',               [UserManagementController::class, 'index'])->name('user.manage.index');
    Route::post('/user-management/create',              [UserManagementController::class, 'registrationForm'])->name('user.manage.registration.form');

    Route::post('/user-management/revoke-access',       [UserManagementController::class, 'revokeAccess'])->name('user.manage.revoke.access');

    Route::post('/user-management/delegate-complaints', [UserManagementController::class, 'delegateComplaints'])->name('user.manage.delegate.complaints');
    Route::post('/user-management/delegate-complaints/to-nodal', [UserManagementController::class, 'delegateComplaintsToNodal'])->name('user.manage.delegate.complaints.to.nodal');

});


// FRMC USER Officer Routes
Route::middleware(['auth', 'verified', 'role:frmc_user'])->group(function () {

    Route::get('/frmc-dashboard',                       [FrmcUserDashboardController::class, 'index'] )->name('frmc.dashboard');
    Route::get('/frmc-complaints/list',                 [FrmcComplaintController::class, 'index'] )->name('frmc.complaints');
    Route::get('/frmc-complaints/view/{complain_id}',   [FrmcComplaintController::class, 'view'] )->name('frmc.complaint.view');
});


Route::middleware('auth')->group(function () {

    // User Profile Routes
    Route::get('/profile',                              [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',                            [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',                           [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Phone updation Routes
    Route::patch('/update/phone',                       [ProfileController::class, 'updatePhone'])->name('phone.update');
    Route::post('/otp/verification',                    [ProfileController::class, 'otpVerification'])->name('otp.verification');


    Route::post('/profile-send-otp',                    [ProfileController::class, 'profileSendOtp'])->name('profile.send.otp');
    Route::get('/profile/{source}/{token}',             [ProfileController::class, 'profileEditOtp'])->name('profile.edit.otp');

    // Work Center Routes
    Route::resource('work-centers', WorkCenterController::class);
});

});

Route::get('/send-test-sms', function () {
    $response = Http::get('http://10.205.48.190:13013/cgi-bin/sendsms?username=ongc&password=ongc12&from=ONGC&to=8751982638&text=Your%20Complaint%20has%20been%20register%20with%20ticket%20no.%201213%20and%20status%20is%201313.%20Regards%20ONGC.&charset=UTF-8&meta-data=%3Fsmpp%3FEntityID%3D1001186049255234740%26ContentID%3D1407166814975984061');

    // Return the response body or handle it as needed
    return $response->body();
});


Route::get('/phpinfo', function () {
    return response()->make(phpinfo(), 200, [
        'Content-Type' => 'text/html',
    ]);
});


require __DIR__.'/auth.php';