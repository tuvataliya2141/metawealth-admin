<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('message/send', [App\Http\Controllers\HomeController::class, 'send']);

Auth::routes();

// Social logins
Route::get('/login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('loginRedirectToGoogle');
Route::get('/login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('/signup/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('signupRedirectToGoogle');
Route::get('/signup/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('/verify-otp/{id}', [App\Http\Controllers\Auth\LoginController::class, 'verifyOtpByLogin'])->name('verifyOtpByLogin');
Route::post('/otpCheck', [App\Http\Controllers\Auth\LoginController::class, 'otpCheck'])->name('otpCheck');
Route::post('/otpResendEmail', [App\Http\Controllers\Auth\LoginController::class, 'otpResendEmail'])->name('otpResendEmail');
Route::post('/password/reset/reset-password', [App\Http\Controllers\Auth\LoginController::class, 'resetPassword'])->name('resetPassword');
Route::post('/password/reset/verify-otp', [App\Http\Controllers\Auth\LoginController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/password/reset/create-new-password', [App\Http\Controllers\Auth\LoginController::class, 'createNewPassword'])->name('createNewPassword');


Route::post('/registration', [App\Http\Controllers\Auth\RegisterController::class, 'registration'])->name('registration');
Route::get('/verify-email', [App\Http\Controllers\Auth\RegisterController::class, 'verifyEmail'])->name('verifyEmail');
Route::get('/verification/{email}', [App\Http\Controllers\Auth\RegisterController::class, 'verification'])->name('verification');
Route::post('/resendEmail', [App\Http\Controllers\Auth\RegisterController::class, 'resendEmail'])->name('resendEmail');

Route::get('/image-upload', [App\Http\Controllers\FileUpload::class, 'createForm']);
Route::post('/image-upload', [App\Http\Controllers\FileUpload::class, 'fileUpload'])->name('imageUpload');

Route::middleware(['auth', 'verifUser'])->group(function () {
    // Routs for admin
    Route::prefix('admin')->middleware(['VerifyIsAdmin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('adminDashboard');

        // Clients Route
        Route::prefix('clients')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'allClients'])->name('adminAllClients');
            Route::get('/add-client', [App\Http\Controllers\AdminController::class, 'addClient'])->name('adminAddClient');
            Route::post('/storeClient', [App\Http\Controllers\AdminController::class, 'storeClient'])->name('adminStoreClient');
            
            Route::get('/update-client/{id}', [App\Http\Controllers\AdminController::class, 'updateClient'])->name('adminUpdateClient');
            Route::post('/editClient', [App\Http\Controllers\AdminController::class, 'editClient'])->name('adminEditClient');
            Route::get('/view-client/{id}', [App\Http\Controllers\AdminController::class, 'viewClient'])->name('adminViewClient');
            Route::get('/delete-client/{id}', [App\Http\Controllers\AdminController::class, 'deleteClient'])->name('adminDeleteClient');
            
            Route::post('/addClientsIncome', [App\Http\Controllers\AdminController::class, 'addClientsIncome'])->name('addClientsIncome');
            Route::get('/editClientsIncome/{id}', [App\Http\Controllers\AdminController::class, 'editClientsIncome'])->name('editClientsIncome');
            Route::get('/delete-clientIncome/{id}', [App\Http\Controllers\AdminController::class, 'deleteClientIncome'])->name('adminDeleteClientIncome');
            
            Route::get('/getIncomeChartData/{id}', [App\Http\Controllers\AdminController::class, 'getIncomeChartData'])->name('getIncomeChartData');
            
            Route::post('/addClientsEvent', [App\Http\Controllers\AdminController::class, 'addClientsEvent'])->name('addClientsEvent');
            Route::get('/editClientsEvent/{id}', [App\Http\Controllers\AdminController::class, 'editClientsEvent'])->name('editClientsEvent');
            Route::get('/delete-clientsEvent/{id}', [App\Http\Controllers\AdminController::class, 'deleteClientsEvent'])->name('adminDeleteClientsEvent');

            Route::get('/adminSupport', [App\Http\Controllers\AdminController::class, 'allSupport'])->name('adminSupport');
            Route::get('/viewSupport/{id}', [App\Http\Controllers\AdminController::class, 'viewSupport'])->name('adminViewSupport');
        });

        

        // Advisors Route
        Route::prefix('advisors')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'allAdvisors'])->name('adminAllAdvisors');
            Route::get('/add-advisor', [App\Http\Controllers\AdminController::class, 'addAdvisor'])->name('adminAddAdvisor');
            Route::post('/storeAdvisor', [App\Http\Controllers\AdminController::class, 'storeAdvisor'])->name('adminStoreAdvisor');
            Route::get('/view-advisor/{id}', [App\Http\Controllers\AdminController::class, 'viewAdvisor'])->name('adminViewAdvisor');
            Route::get('/update-advisor/{id}', [App\Http\Controllers\AdminController::class, 'updateAdvisor'])->name('adminUpdateAdvisor');
            Route::post('/editAdvisor', [App\Http\Controllers\AdminController::class, 'editAdvisor'])->name('adminEditAdvisor');
            
            Route::get('/delete-advisor/{id}', [App\Http\Controllers\AdminController::class, 'deleteAdvisor'])->name('adminDeleteAdvisor');
            Route::post('/assign-advisor', [App\Http\Controllers\AdminController::class, 'assignAdvisor'])->name('adminAssignAdvisor');
        });

        // Sub Admin Route
        Route::prefix('subAdmin')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'allSubAdmins'])->name('adminAllSubAdmins');
            Route::get('/add-subAdmin', [App\Http\Controllers\AdminController::class, 'addSubAdmin'])->name('adminAddSubAdmin');
            Route::post('/storeSubAdmin', [App\Http\Controllers\AdminController::class, 'storeSubAdmin'])->name('adminStoreSubAdmin');
            
            Route::get('/update-subAdmin/{id}', [App\Http\Controllers\AdminController::class, 'updateSubAdmin'])->name('adminUpdateSubAdmin');
            Route::post('/editSubAdmin', [App\Http\Controllers\AdminController::class, 'editSubAdmin'])->name('adminEditSubAdmin');
            
            Route::get('/delete-subAdmins/{id}', [App\Http\Controllers\AdminController::class, 'deleteSubAdmin'])->name('adminDeleteSubAdmin');
            Route::post('/assign-subAdmin', [App\Http\Controllers\AdminController::class, 'assignSubAdmin'])->name('adminAssignSubAdmin');
        });

        // Booking Route
        Route::get('/booking', [App\Http\Controllers\AdminController::class, 'booking'])->name('adminBooking');

        // Role Route
        Route::prefix('roles')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'allRoles'])->name('adminAllRoles');
            Route::get('/update-role/{id}', [App\Http\Controllers\AdminController::class, 'updateRole'])->name('adminUpdateRole');
            Route::post('/editRole', [App\Http\Controllers\AdminController::class, 'editRole'])->name('adminEditRole');
        });        

        // Events Route
        Route::prefix('events')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'allEvents'])->name('adminAllEvents');
            Route::get('/add-event', [App\Http\Controllers\AdminController::class, 'addEvent'])->name('adminAddEvent');
            Route::post('/storeEvent', [App\Http\Controllers\AdminController::class, 'storeEvent'])->name('adminStoreEvent');
            
            Route::get('/update-event/{id}', [App\Http\Controllers\AdminController::class, 'updateEvent'])->name('adminUpdateEvent');
            Route::post('/editEvent', [App\Http\Controllers\AdminController::class, 'editEvent'])->name('adminEditEvent');
            
            Route::get('/delete-event/{id}', [App\Http\Controllers\AdminController::class, 'deleteEvent'])->name('adminDeleteEvent');
        });

        // Incomes Route
        Route::prefix('incomes')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'allIncomes'])->name('adminAllIncomes');
            Route::get('/add-income', [App\Http\Controllers\AdminController::class, 'addIncome'])->name('adminAddIncome');
            Route::post('/storeIncome', [App\Http\Controllers\AdminController::class, 'storeIncome'])->name('adminStoreIncome');
            
            Route::get('/update-income/{id}', [App\Http\Controllers\AdminController::class, 'updateIncome'])->name('adminUpdateIncome');
            Route::post('/editIncome', [App\Http\Controllers\AdminController::class, 'editIncome'])->name('adminEditIncome');
            
            Route::get('/delete-income/{id}', [App\Http\Controllers\AdminController::class, 'deleteIncome'])->name('adminDeleteIncome');
        });

        // Map Route
        Route::get('/map', [App\Http\Controllers\AdminController::class, 'map'])->name('adminMap');

        // Support Tickets Route
        Route::post('/addReplySupportTickets', [App\Http\Controllers\AdminController::class, 'addReplySupportTickets'])->name('addReplySupportTickets');
        
        // Profile Route
        Route::prefix('profile')->group(function () {
            Route::get('/', [App\Http\Controllers\AdminController::class, 'profile'])->name('adminProfile');
            Route::post('/editProfile', [App\Http\Controllers\AdminController::class, 'editProfile'])->name('adminEditProfile');
        });
    });
    
    // Routs for Sub Admin
    Route::prefix('sub-admin')->middleware(['VerifyIsSuperAdmin'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\SuperAdminController::class, 'index'])->name('subAdminDashboard');

        // Clients Route
        Route::prefix('clients')->group(function () {
            Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'allClients'])->name('subAdminAllClients');
            Route::get('/add-client', [App\Http\Controllers\SuperAdminController::class, 'addClient'])->name('subAdminAddClient');
            Route::post('/storeClient', [App\Http\Controllers\SuperAdminController::class, 'storeClient'])->name('subAdminStoreClient');
            
            Route::get('/update-client/{id}', [App\Http\Controllers\SuperAdminController::class, 'updateClient'])->name('subAdminUpdateClient');
            Route::post('/editClient', [App\Http\Controllers\SuperAdminController::class, 'editClient'])->name('subAdminEditClient');
            Route::get('/view-client/{id}', [App\Http\Controllers\SuperAdminController::class, 'viewClient'])->name('subAdminViewClient');
            Route::get('/delete-client/{id}', [App\Http\Controllers\SuperAdminController::class, 'deleteClient'])->name('subAdminDeleteClient');
            
            Route::post('/addClientsIncome', [App\Http\Controllers\SuperAdminController::class, 'addClientsIncome'])->name('addClientsIncome');
            Route::get('/editClientsIncome/{id}', [App\Http\Controllers\SuperAdminController::class, 'editClientsIncome'])->name('editClientsIncome');
            Route::get('/delete-clientIncome/{id}', [App\Http\Controllers\SuperAdminController::class, 'deleteClientIncome'])->name('adminDeleteClientIncome');
            
            Route::get('/getIncomeChartData/{id}', [App\Http\Controllers\SuperAdminController::class, 'getIncomeChartData'])->name('getIncomeChartData');
            
            Route::post('/addClientsEvent', [App\Http\Controllers\SuperAdminController::class, 'addClientsEvent'])->name('addClientsEvent');
            Route::get('/editClientsEvent/{id}', [App\Http\Controllers\SuperAdminController::class, 'editClientsEvent'])->name('editClientsEvent');
            Route::get('/delete-clientsEvent/{id}', [App\Http\Controllers\SuperAdminController::class, 'deleteClientsEvent'])->name('adminDeleteClientsEvent');
        });

        // Advisors Route
        Route::prefix('advisors')->group(function () {
            Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'allAdvisors'])->name('subAdminAllAdvisors');
            Route::get('/add-advisor', [App\Http\Controllers\SuperAdminController::class, 'addAdvisor'])->name('subAdminAddAdvisor');
            Route::post('/storeAdvisor', [App\Http\Controllers\SuperAdminController::class, 'storeAdvisor'])->name('subAdminStoreAdvisor');
            
            Route::get('/update-advisor/{id}', [App\Http\Controllers\SuperAdminController::class, 'updateAdvisor'])->name('subAdminUpdateAdvisor');
            Route::get('/view-advisor/{id}', [App\Http\Controllers\SuperAdminController::class, 'viewAdvisor'])->name('subAdminViewAdvisor');
            Route::post('/editAdvisor', [App\Http\Controllers\SuperAdminController::class, 'editAdvisor'])->name('subAdminEditAdvisor');
            
            Route::get('/delete-advisor/{id}', [App\Http\Controllers\SuperAdminController::class, 'deleteAdvisor'])->name('subAdminDeleteAdvisor');
            Route::post('/assign-advisor', [App\Http\Controllers\SuperAdminController::class, 'assignAdvisor'])->name('subAdminAssignAdvisor');
        });
        
        // Booking Route
        Route::get('/booking', [App\Http\Controllers\SuperAdminController::class, 'booking'])->name('subAdminBooking');

        // Map Route
        Route::get('/map', [App\Http\Controllers\SuperAdminController::class, 'map'])->name('subAdminMap');
        
        // Profile Route
        Route::prefix('profile')->group(function () {
            Route::get('/', [App\Http\Controllers\SuperAdminController::class, 'profile'])->name('subAdminProfile');
            Route::post('/editProfile', [App\Http\Controllers\SuperAdminController::class, 'editProfile'])->name('subAdminEditProfile');
        });
    });
    
    // Routs for Advisor
    Route::prefix('advisor')->middleware(['VerifyIsAdvisor'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdvisorController::class, 'index'])->name('advisorDashboard');

        // Clients Route
        Route::prefix('clients')->group(function () {
            Route::get('/', [App\Http\Controllers\AdvisorController::class, 'allClients'])->name('advisorAllClients');
            Route::get('/add-client', [App\Http\Controllers\AdvisorController::class, 'addClient'])->name('advisorAddClient');
            Route::post('/storeClient', [App\Http\Controllers\AdvisorController::class, 'storeClient'])->name('advisorStoreClient');
            
            Route::get('/update-client/{id}', [App\Http\Controllers\AdvisorController::class, 'updateClient'])->name('advisorUpdateClient');
            Route::post('/editClient', [App\Http\Controllers\AdvisorController::class, 'editClient'])->name('advisorEditClient');
            Route::get('/view-client/{id}', [App\Http\Controllers\AdvisorController::class, 'viewClient'])->name('advisorViewClient');
            Route::get('/delete-client/{id}', [App\Http\Controllers\AdvisorController::class, 'deleteClient'])->name('advisorDeleteClient');
            
            Route::post('/addClientsIncome', [App\Http\Controllers\AdvisorController::class, 'addClientsIncome'])->name('addClientsIncome');
            Route::get('/editClientsIncome/{id}', [App\Http\Controllers\AdvisorController::class, 'editClientsIncome'])->name('editClientsIncome');
            Route::get('/delete-clientIncome/{id}', [App\Http\Controllers\AdvisorController::class, 'deleteClientIncome'])->name('adminDeleteClientIncome');
            
            Route::get('/getIncomeChartData/{id}', [App\Http\Controllers\AdvisorController::class, 'getIncomeChartData'])->name('getIncomeChartData');
            
            Route::post('/addClientsEvent', [App\Http\Controllers\AdvisorController::class, 'addClientsEvent'])->name('addClientsEvent');
            Route::get('/editClientsEvent/{id}', [App\Http\Controllers\AdvisorController::class, 'editClientsEvent'])->name('editClientsEvent');
            Route::get('/delete-clientsEvent/{id}', [App\Http\Controllers\AdvisorController::class, 'deleteClientsEvent'])->name('adminDeleteClientsEvent');
            Route::post('/assign-advisor', [App\Http\Controllers\AdvisorController::class, 'assignAdvisor'])->name('subAdminAssignAdvisor');
            Route::get('/unassign-user/{id}', [App\Http\Controllers\AdvisorController::class, 'unAssignAdvisor'])->name('adminUnAssignAdvisor');
        });
        
        // Booking Route
        Route::get('/booking', [App\Http\Controllers\AdvisorController::class, 'booking'])->name('advisorBooking');

        // Map Route
        Route::get('/map', [App\Http\Controllers\AdvisorController::class, 'map'])->name('advisorMap');
        
        // Profile Route
        Route::prefix('profile')->group(function () {
            Route::get('/', [App\Http\Controllers\AdvisorController::class, 'profile'])->name('subAdminProfile');
            Route::post('/editProfile', [App\Http\Controllers\AdvisorController::class, 'editProfile'])->name('subAdminEditProfile');
        });

    });
    
    // Routs for user
    Route::middleware(['VerifyIsUser'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        Route::post('/change-risk-rate', [App\Http\Controllers\HomeController::class, 'changeRiskRate'])->name('changeRiskRate');
        Route::get('/booking', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking');
        Route::get('/supportTickets', [App\Http\Controllers\HomeController::class, 'supportTickets'])->name('supportTickets');
        Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
        Route::get('/personalDetails/{id}', [App\Http\Controllers\HomeController::class, 'personalDetails'])->name('personalDetails');
        Route::post('/updatePersonalDetails', [App\Http\Controllers\HomeController::class, 'updatePersonalDetails'])->name('updatePersonalDetails');
        Route::post('/user/addSupportTikets', [App\Http\Controllers\HomeController::class, 'addSupportTikets'])->name('addSupportTikets');
        Route::get('/viewSupport/{id}', [App\Http\Controllers\HomeController::class, 'viewSupport'])->name('userViewSupport');
        Route::post('/user/replySupportTickets', [App\Http\Controllers\HomeController::class, 'replySupportTickets'])->name('replySupportTickets');
    });
    
});
