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
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/jobs', [HomeController::class,'allJobs'])->name('all-jobs');
Route::get('/jobs/filter', [HomeController::class,'filterJobs']);
Route::get('/jobs/details/{id}', [HomeController::class,'jobDetails'])->name('job-details');
Route::get('/company/details/{id}', [HomeController::class,'companyDetails'])->name('company-details');
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
})->name('register');
Route::get('/reports',[AdminDashBoardController::class,'reports']);
Route::post('/employer/register',[EmployerController::class,'register'])->name('register.employer');
Route::post('/jobseeker/register',[JobSeekerController::class,'register'])->name('register.jobseeker');
Route::get('api/fetch-cities/{id}', [DropdownController::class, 'fetchCities']);
Route::get('api/fetch-payment-accounts/{id}', [DropdownController::class, 'fetchPaymentAccounts']);

Route::group(  ['prefix' => 'admin','middleware'=>['auth:admin']], function () {
    Route::get('/',[AdminDashBoardController::class,'index'])->name('admin.dashboard');
    Route::get('/pricing',[CreditPriceController::class,'index']);
    Route::post('/pricing/insert',[CreditPriceController::class,'insertPrice']);
    Route::post('/pricing/update/{id}',[CreditPriceController::class,'updatePrice']);

    Route::get('/payment',[OrderController::class,'index']);
    Route::get('/order',[OrderController::class,'getAwaitingOrder']);
    Route::get('/order/approve/{id}',[OrderController::class,'acceptOrder']);
    Route::get('/order/reject/{id}',[OrderController::class,'rejectOrder']);
    Route::get('/order/confirmed/details/{id}',[OrderController::class,'confirmedOrderDetails']);
    Route::get('/order/awaiting/details/{id}',[OrderController::class,'awaitingOrderDetails']);

    Route::get('/job-seekers',[JobSeekerController::class,'allJobSeekers']);
    // Route::get('/job-seekers/add',[JobSeekerController::class,'insertGet']);
    // Route::post('/job-seekers/add',[JobSeekerController::class,'insert']);
    Route::get('/job-seekers/details/{id}',[JobSeekerController::class,'viewDetails']);
    Route::get('/job-seekers/delete/{id}',[JobSeekerController::class,'delete']);

    Route::get('/jobs',[JobController::class,'index'])->name('jobs-manage');
    Route::get('/job/details/{id}',[JobController::class,'viewDetails']);
    Route::get('/job/delete/{id}',[JobController::class,'delete']);

    Route::get('/companies',[CompanyController::class,'index']);
    Route::get('/company/add',[CompanyController::class,'insertGet']);
    Route::post('/company/add',[CompanyController::class,'insert']);
    Route::get('/company/delete/{id}',[CompanyController::class,'delete']);
    Route::get('/company/details/{id}',[CompanyController::class,'viewDetails']);
    Route::get('/company/add/credit/{id}',[CompanyController::class,'getCreditData']);
    Route::post('/company/add/credit/{id}',[CompanyController::class,'addCredit']);

    Route::get('/payment-methods',[PaymentMethodController::class,'index']);
    Route::post('/payment-methods/add',[PaymentMethodController::class,'insert']);
    Route::post('/payment-methods/update/{id}',[PaymentMethodController::class,'update']);
    Route::get('/payment-methods/delete/{id}',[PaymentMethodController::class,'delete']);
    Route::post('/payment-accounts/add',[PaymentMethodController::class,'insertPaymentAccount']);
    Route::post('/payment-accounts/update/{id}',[PaymentMethodController::class,'updatePaymentAccount']);
    Route::get('/payment-accounts/delete/{id}',[PaymentMethodController::class,'deletePaymentAccount']);
    Route::get('/profile/{id}',function(){
        return view('admin-profile');
    });
    Route::get('/manage',[AdminController::class,'index'])->name('manage-admin');
    Route::get('/add',[AdminController::class,'addGet']);
    Route::post('/add',[AdminController::class,'add']);
    Route::get('/delete/{id}',[AdminController::class,'delete']);
    Route::get('/details/{id}',[AdminController::class,'viewDetails'])->name('admin-details');
});

Route::group(  ['prefix' => 'employer','middleware' => ['auth:employer']], function () {
    Route::get('/',[EmployerController::class,'index'])->name('employer.dashboard');
    Route::get('/jobs',[EmployerJobController::class,'index'])->name('employer.jobs');
    Route::get('/jobs/deactivated',[EmployerJobController::class,'deactivatedJobs'])->name('employer.deactivated-jobs');
    Route::get('/jobs/expired',[EmployerJobController::class,'expiredJobs'])->name('employer.expired-jobs');
    Route::get('/jobs/inactive',[EmployerJobController::class,'inactiveJobs'])->name('inactive-jobs');
    Route::get('/buy/credit',[EmployerController::class,'buyCreditGet']);
    Route::post('/buy/credit',[EmployerController::class,'buyCredit']);
    Route::get('/order',[EmployerOrderController::class,'getOrders']);
    Route::get('/confirmed/order/details/{oid}',[EmployerOrderController::class,'confirmedOrderDetails']);
    Route::get('/awaiting/order/details/{oid}',[EmployerOrderController::class,'awaitingOrderDetails']);
    
    Route::get('/jobs/insert',[EmployerJobController::class,'checkCredit']);
    Route::post('/jobs/insert',[EmployerJobController::class,'insert']);
    Route::get('/job/update/{id}',[EmployerJobController::class,'updateGet']);
    Route::post('/job/update/{id}',[EmployerJobController::class,'update']);
    Route::get('/job/delete/{id}',[EmployerJobController::class,'delete']);
    Route::get('/job/details/{id}',[EmployerJobController::class,'viewDetails'])->name('employer.job.detail');
    Route::get('/job/deactivate/{id}',[EmployerJobController::class,'deactivate']);
    Route::get('/job/activate/{id}',[EmployerJobController::class,'activate']);
    
    Route::get('/multiStepForm',[EmployerJobController::class,'insertGet'])->name('insert.job');
    Route::post('/multiStepForm/add',[EmployerJobController::class,'insert'])->name('multistepForm.add');
    Route::get('/profile',[CompanyController::class,'viewProfile']);
    Route::get('/profile/update/{id}',[CompanyController::class,'updateSetData']);
    Route::post('/profile/update/{id}',[CompanyController::class,'update']);
    
    Route::post('/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
    Route::post('/profile/add/industry/{cid}',[CompanyController::class,'addIndustry']);
    Route::get('/profile/delete/industry/{cid}/{iid}',[CompanyController::class,'deleteIndustry']);
    
    Route::post('/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
    Route::post('/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
    Route::post('/profile/update/logo/{id}',[CompanyController::class,'updateLogo']);
    
    Route::get('/profile/delete/branch/{cid}/{addId}',[CompanyController::class,'deleteBranchCity']);
    Route::post('/profile/add/branch/{cid}',[CompanyController::class,'addBranchCity']);
    Route::post('/profile/add/images/{cid}',[CompanyController::class,'addImages']);
    Route::get('/profile/remove/images/{cid}/{imageId}',[CompanyController::class,'removeImage']);
    
 
    Route::get('/applications',[EmployerController::class,'getApplications'])->name('applications');
    Route::get('/application/reject/{id}',[EmployerController::class,'reject']);
    Route::get('/application/shortlist/{id}',[EmployerController::class,'shortlist']);
    Route::get('/applications/shortlisted',[EmployerController::class,'shortlistedApplications']);
    Route::get('/applications/rejected',[EmployerController::class,'rejectedApplications']);
    
});

Route::group(  ['prefix' => 'job-seeker','middleware' => ['auth:jobseeker']], function () {
    Route::get('/',[JobSeekerController::class,'index'])->name('jobseeker.dashboard');
    Route::get('/applications/pending',[JobSeekerController::class,'pendingApplication']);
    Route::get('/applications/shortlisted',[JobSeekerController::class,'shortlistedApplication']);
    Route::get('/applications/rejected',[JobSeekerController::class,'rejectedApplication']);
    Route::get('/profile/{id}',[JobSeekerController::class,'viewDetails']);
    Route::post('/update/image/{id}',[JobSeekerController::class,'updateImage']);
    Route::get('/update/profile/{id}',[JobSeekerController::class,'getProfileData']);
    Route::post('/update/profile/{id}',[JobSeekerController::class,'update']);
    Route::post('/jobs/apply/{id}', [HomeController::class,'applyJobs'])->name('apply.job');
});

Auth::routes(['register' => false]);