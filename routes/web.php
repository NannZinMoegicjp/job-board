<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditPriceController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerJobController;

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

Route::get('/', function () {
    return view('test');
});
Route::get('/jobs', function () {
    return view('jobs');
});
Route::get('/categories', function () {
    return view('categories');
});
Route::get('/industries', function () {
    return view('industries');
});
Route::get('/locations', function () {
    return view('locations');
});
Route::get('/companies', function () {
    return view('companies');
});
Route::get('/job/details/{id}', function () {
    return view('job-details');
});
Route::get('/company/details/{id}', function () {
    return view('company-details');
});
Route::get('/register',function(){
    return view('register');
});
Route::get('/login',function(){
    return view('login');
});
Route::get('/admin',function(){
    return view('master_admin');
});
Route::get('/admin/profile/{id}',function(){
    return view('admin-profile');
});
Route::get('/admin',[AdminDashBoardController::class,'index']);
Route::get('/admin/pricing',[CreditPriceController::class,'index']);
Route::post('/admin/pricing/insert',[CreditPriceController::class,'insertPrice']);
Route::post('/admin/pricing/update/{id}',[CreditPriceController::class,'updatePrice']);

Route::get('/admin/payment',[OrderController::class,'index']);
Route::get('/admin/order',[OrderController::class,'getAwaitingOrder']);
Route::get('/admin/order/approve/{id}',[OrderController::class,'acceptOrder']);
Route::get('/admin/order/reject/{id}',[OrderController::class,'rejectOrder']);
Route::get('/admin/order/confirmed/details/{id}',[OrderController::class,'confirmedOrderDetails']);
Route::get('/admin/order/awaiting/details/{id}',[OrderController::class,'awaitingOrderDetails']);

Route::get('/admin/job-seekers',[JobSeekerController::class,'index']);
Route::get('/admin/job-seekers/add',[JobSeekerController::class,'insertGet']);
Route::post('/admin/job-seekers/add',[JobSeekerController::class,'insert']);
Route::get('/admin/job-seekers/update/{id}',[JobSeekerController::class,'updateSetData']);
Route::post('/admin/job-seekers/update/{id}',[JobSeekerController::class,'update']);
Route::post('/admin/job-seekers/update/image/{id}',[JobSeekerController::class,'updateImage']);
Route::get('/admin/job-seekers/details/{id}',[JobSeekerController::class,'viewDetails']);
Route::get('/admin/job-seekers/delete/{id}',[JobSeekerController::class,'delete']);

Route::get('/admin/jobs',[JobController::class,'index']);
Route::get('/admin/job/details/{id}',[JobController::class,'viewDetails']);

Route::get('/admin/companies',[CompanyController::class,'index']);
Route::get('/admin/company/add',[CompanyController::class,'insertGet']);
Route::post('/admin/company/add',[CompanyController::class,'insert']);
Route::get('/admin/company/update/{id}',[CompanyController::class,'updateSetData']);
Route::post('/admin/company/update/{id}',[CompanyController::class,'update']);
Route::post('/admin/company/update/logo/{id}',[CompanyController::class,'updateLogo']);
Route::get('/admin/company/delete/industry/{cid}/{iid}',[CompanyController::class,'deleteIndustry']);
Route::post('/admin/company/add/industry/{cid}',[CompanyController::class,'addIndustry']);

Route::get('/admin/company/delete/branch/{cid}/{addId}',[CompanyController::class,'deleteBranchCity']);
Route::post('/admin/company/add/branch/{cid}',[CompanyController::class,'addBranchCity']);
Route::post('/admin/company/add/images/{cid}',[CompanyController::class,'addImages']);
Route::get('/admin/company/remove/images/{cid}/{imageId}',[CompanyController::class,'removeImage']);

Route::get('/admin/company/delete/{id}',[CompanyController::class,'delete']);
Route::get('/admin/company/details/{id}',[CompanyController::class,'viewDetails']);

Route::get('/admin/payment-methods',[PaymentMethodController::class,'index']);
Route::post('/admin/payment-methods/add',[PaymentMethodController::class,'insert']);
Route::post('/admin/payment-methods/update/{id}',[PaymentMethodController::class,'update']);
Route::get('/admin/payment-methods/delete/{id}',[PaymentMethodController::class,'delete']);
Route::post('/admin/payment-accounts/add',[PaymentMethodController::class,'insertPaymentAccount']);
Route::post('/admin/payment-accounts/update/{id}',[PaymentMethodController::class,'updatePaymentAccount']);
Route::get('/admin/payment-accounts/delete/{id}',[PaymentMethodController::class,'deletePaymentAccount']);

Route::get('/admin/manage',[AdminController::class,'index'])->name('manage-admin');
Route::get('/admin/add',[AdminController::class,'addGet']);
Route::post('/admin/add',[AdminController::class,'add']);
Route::get('/admin/delete/{id}',[AdminController::class,'delete']);
Route::get('/admin/details/{id}',[AdminController::class,'viewDetails'])->name('admin-details');

Route::get('/employer',[EmployerController::class,'index']);
Route::get('/employer/jobs',[EmployerJobController::class,'index']);
Route::get('/employer/jobs/insert',[EmployerJobController::class,'insertGet']);
Route::post('/employer/jobs/insert',[EmployerJobController::class,'insert']);
Route::get('/employer/jobs/update/{id}',[EmployerJobController::class,'updateGet']);
Route::post('/employer/jobs/update/{id}',[EmployerJobController::class,'update']);
Route::get('/employer/jobs/delete/{id}',[EmployerJobController::class,'delete']);
Route::get('/employer/jobs/details/{id}',[EmployerJobController::class,'viewDetails']);

Route::get('/multiStepForm',[EmployerJobController::class,'insertGet']);
Route::post('/multiStepForm/add',[EmployerJobController::class,'insert'])->name('multistepForm.add');