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
use App\Http\Controllers\EmployerOrderController;
use App\Http\Controllers\EmployerJobController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'index']);
Route::get('/jobs', function () {
    return view('jobs');
})->name('jobs');
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
Route::get('/jobs/details/{id}', [HomeController::class,'jobDetails']);

Route::get('/company/details/{id}', [HomeController::class,'companyDetails'])->name('company-details');

Route::post('/jobs/apply/{id}', [HomeController::class,'applyJobs']);

//get jobs by location(division/state)
Route::get('/jobs/state/{stateId}', [HomeController::class,'getJobsByState'])->name('jobs-by-state');
//get jobs by job category
Route::get('/jobs/category/{categoryId}', [HomeController::class,'getJobsByCategory'])->name('jobs-by-category');
//get jobs of company
Route::get('/jobs/company/{companyId}', [HomeController::class,'getJobsByCompany'])->name('jobs-by-company');
//get jobs of industry
Route::get('/jobs/industry/{industryId}', [HomeController::class,'getJobsByIndustry'])->name('jobs-by-industry');
Route::get('/industries/all',[HomeController::class,'industries'])->name('all-industries');
Route::get('/categories/all',[HomeController::class,'categories'])->name('all-categories');
Route::get('/locations/all',[HomeController::class,'locations'])->name('all-locations');
Route::get('/companies/all',[HomeController::class,'companies'])->name('all-companies');

Route::get('/register',function(){
    return view('register');
});
Route::get('/jobseeker/register',function(){
    return view('register-jobseeker');
});
Route::post('/jobseeker/register',[JobSeekerController::class,'register']);
Route::get('/login',function(){
    return view('login');
});
Route::get('/admin',function(){
    return view('dashboard');
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

Route::get('/admin/job-seekers',[JobSeekerController::class,'allJobSeekers']);
// Route::get('/admin/job-seekers/add',[JobSeekerController::class,'insertGet']);
// Route::post('/admin/job-seekers/add',[JobSeekerController::class,'insert']);
Route::get('/admin/job-seekers/details/{id}',[JobSeekerController::class,'viewDetails']);
Route::get('/admin/job-seekers/delete/{id}',[JobSeekerController::class,'delete']);

Route::get('/admin/jobs',[JobController::class,'index'])->name('jobs-manage');
Route::get('/admin/job/details/{id}',[JobController::class,'viewDetails']);
Route::get('/admin/job/delete/{id}',[JobController::class,'delete']);

Route::get('/admin/companies',[CompanyController::class,'index']);
Route::get('/admin/company/add',[CompanyController::class,'insertGet']);
Route::post('/admin/company/add',[CompanyController::class,'insert']);
Route::get('/admin/company/delete/{id}',[CompanyController::class,'delete']);
Route::get('/admin/company/details/{id}',[CompanyController::class,'viewDetails']);
Route::get('/admin/company/add/credit/{id}',[CompanyController::class,'getCreditData']);
Route::post('/admin/company/add/credit/{id}',[CompanyController::class,'addCredit']);

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
Route::get('/employer/jobs',[EmployerJobController::class,'index'])->name('employer.jobs');
Route::get('/employer/jobs/deactivated',[EmployerJobController::class,'deactivatedJobs'])->name('employer.deactivated-jobs');
Route::get('/employer/jobs/expired',[EmployerJobController::class,'expiredJobs'])->name('employer.expired-jobs');
Route::get('/employer/jobs/inactive',[EmployerJobController::class,'inactiveJobs'])->name('inactive-jobs');
Route::get('/employer/buy/credit',[EmployerController::class,'buyCreditGet']);
Route::post('/employer/buy/credit',[EmployerController::class,'buyCredit']);
Route::get('/employer/order',[EmployerOrderController::class,'getOrders']);
Route::get('/employer/confirmed/order/details/{oid}',[EmployerOrderController::class,'confirmedOrderDetails']);
Route::get('/employer/awaiting/order/details/{oid}',[EmployerOrderController::class,'awaitingOrderDetails']);

Route::get('/employer/jobs/insert',[EmployerJobController::class,'checkCredit']);
Route::post('/employer/jobs/insert',[EmployerJobController::class,'insert']);
Route::get('/employer/job/update/{id}',[EmployerJobController::class,'updateGet']);
Route::post('/employer/job/update/{id}',[EmployerJobController::class,'update']);
Route::get('/employer/job/delete/{id}',[EmployerJobController::class,'delete']);
Route::get('/employer/job/details/{id}',[EmployerJobController::class,'viewDetails'])->name('employer.job.detail');
Route::get('/employer/job/deactivate/{id}',[EmployerJobController::class,'deactivate']);
Route::get('/employer/job/activate/{id}',[EmployerJobController::class,'activate']);

Route::get('/multiStepForm',[EmployerJobController::class,'insertGet'])->name('insert.job');
Route::post('/multiStepForm/add',[EmployerJobController::class,'insert'])->name('multistepForm.add');
Route::get('/employer/profile',[CompanyController::class,'viewProfile']);
Route::get('/employer/profile/update/{id}',[CompanyController::class,'updateSetData']);
Route::post('/employer/profile/update/{id}',[CompanyController::class,'update']);

Route::post('/employer/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
Route::post('/employer/profile/add/industry/{cid}',[CompanyController::class,'addIndustry']);
Route::get('/employer/profile/delete/industry/{cid}/{iid}',[CompanyController::class,'deleteIndustry']);

Route::post('/employer/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
Route::post('/employer/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
Route::post('/employer/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);

Route::get('/employer/profile/delete/branch/{cid}/{addId}',[CompanyController::class,'deleteBranchCity']);
Route::post('/employer/profile/add/branch/{cid}',[CompanyController::class,'addBranchCity']);
Route::post('/employer/profile/add/images/{cid}',[CompanyController::class,'addImages']);
Route::get('/employer/profile/remove/images/{cid}/{imageId}',[CompanyController::class,'removeImage']);

Route::get('api/fetch-cities/{id}', [DropdownController::class, 'fetchCities']);
Route::get('api/fetch-payment-accounts/{id}', [DropdownController::class, 'fetchPaymentAccounts']);

Route::get('/employer/applications',[EmployerController::class,'getApplications'])->name('applications');
Route::get('/employer/application/reject/{id}',[EmployerController::class,'reject']);
Route::get('/employer/application/shortlist/{id}',[EmployerController::class,'shortlist']);
Route::get('/employer/applications/shortlisted',[EmployerController::class,'shortlistedApplications']);
Route::get('/employer/applications/rejected',[EmployerController::class,'rejectedApplications']);

// Route::get('/employer/view/cv',function(){
//     return view('cv');
// });
Route::get('/job-seeker',[JobSeekerController::class,'index']);
Route::get('/job-seeker/applications/pending',[JobSeekerController::class,'pendingApplication']);
Route::get('/job-seeker/applications/shortlisted',[JobSeekerController::class,'shortlistedApplication']);
Route::get('/job-seeker/applications/rejected',[JobSeekerController::class,'rejectedApplication']);
Route::get('/job-seeker/profile/{id}',[JobSeekerController::class,'viewDetails']);
Route::post('/job-seeker/update/image/{id}',[JobSeekerController::class,'updateImage']);
Route::get('/job-seeker/update/profile/{id}',[JobSeekerController::class,'getProfileData']);
Route::post('/job-seeker/update/profile/{id}',[JobSeekerController::class,'update']);