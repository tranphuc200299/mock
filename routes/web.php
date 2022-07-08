<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SkillsController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Client\LineLoginController;
use App\Http\Controllers\Client\LoginController as WorkerLoginController;
use App\Http\Controllers\Admin\OccupationController;
use App\Http\Controllers\Client\PublicController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Admin\WorkerController as WorkerControllerAdmin;
use App\Http\Controllers\Client\WorkerController;

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
//login-register worker
Route::get('/register', [WorkerLoginController::class, 'register'])->name('register.worker');
Route::get('/registerWorkerProfile', [WorkerLoginController::class, 'registerWithPhone'])->name('register.worker.profile');
Route::post('/registerWorkerProfile', [WorkerLoginController::class, 'registerWithPhonePost'])->name('register.worker.profile.post');
Route::get('/confirmSmsWorker/{id}', [WorkerLoginController::class, 'confirmSmsWorker'])->name('confirm.worker.sms');
Route::post('/confirmSmsWorker/{id}', [WorkerLoginController::class, 'confirmSmsWorkerPost'])->name('confirm.worker.sms.post');
Route::get('/setPassword/{id}/{token}', [WorkerLoginController::class, 'setPassword'])->name('setPassword.worker');
Route::post('/setPassword/{id}/{token}', [WorkerLoginController::class, 'setPasswordPost'])->name('setPassword.worker.post');
Route::get('/alertCheckMail', [WorkerLoginController::class, 'alertCheckMail'])->name('alert.check.mail');
Route::get('/confirmMail/{id}/{token}', [WorkerLoginController::class, 'confirmMail'])->name('confirm.mail');
Route::post('/login/worker', [WorkerLoginController::class, 'login'])->name('worker.login');
Route::get('/forgotPassword/worker', [WorkerLoginController::class, 'forgotPassword'])->name('worker.forgotPassword');
Route::post('/forgotPassword/worker', [WorkerLoginController::class, 'forgotPasswordPost'])->name('worker.forgotPassword.post');
Route::get('/forgotPassword/success/worker', [WorkerLoginController::class, 'forgotPasswordSuccess'])->name('worker.forgotPassword.success');
Route::get('/logout', [WorkerLoginController::class, 'logout'])->name('worker.logout');
Route::get('login/line', [LineLoginController::class, 'redirectToLine'])->name('workerLogin.redirectToLine');
Route::get('login/line/callback', [LineLoginController::class, 'lineSignIn'])->name('workerLogin.lineSignIn');

Route::group(['prefix' => '/', 'middleware' => 'worker'], function () {
    Route::get('/uploadfile', [WorkerController::class, 'upLoadFile'])->name('uploadfile.profile');
    Route::post('/uploadfile', [WorkerController::class, 'storeFile'])->name('uploadfile.store');
    Route::get('upload_passport_success', [WorkerController::class, 'uploadSuccess'])->name('uploadfile.uploadSuccess');
    Route::get('/confirm-uploadfile', [WorkerController::class, 'confirmUploadFile'])->name('confirmupload.profile');
    Route::get('/uploadDegree', [WorkerController::class, 'degree'])->name('degree.profile');
    Route::post('/uploadDegree', [WorkerController::class, 'uploadDegree'])->name('degree.profile.upload');
    Route::get('/workerProfile', [WorkerController::class, 'myPage'])->name('worker.profile');
    Route::get('/editProfile/{id}', [WorkerController::class, 'editProfile'])->name('edit.profile');
    Route::post('/uploadProfileImage/{id}', [WorkerController::class, 'uploadProfileImage'])->name('upload.image.profile');
    Route::post('/update/{id}', [WorkerController::class, 'updateWorkerProfile'])->name('worker.profile.update');
    Route::post('change-password/{id}', [WorkerController::class, 'changePassword'])->name('worker.change.password');
});

// home page
Route::get('/',[PublicController::class, 'index'])->name('home');
Route::get('/job/{id}',[PublicController::class, 'getDetailJob'])->name('get.detail.job');
Route::get('/multiple-filter',[PublicController::class, 'multipleFilter'])->name('multiple.filter');
Route::get('/get-sub-categories',[PublicController::class, 'getSubCategories'])->name('get.sub.categories');
Route::get('/get-station-route',[PublicController::class, 'getStationRoute'])->name('get.station.route');
Route::get('/favorite',[FavoriteController::class, 'favorite'])->name('favorite');
Route::post('/favorite',[FavoriteController::class, 'addFavorite'])->name('addFavorite');
Route::get('/history',[FavoriteController::class, 'history'])->name('history');



//router admin login
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('login', [LoginController::class, 'loginPost'])->name('admin.loginPost');
    Route::get('forgotPassword', [LoginController::class, 'forgotPassword'])->name('admin.forgotPassword');
    Route::post('forgotPassword', [LoginController::class, 'forgotPasswordPost'])->name('admin.forgotPasswordPost');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
});

//router admin
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('admin.home');

    //---CategoryController---//
    Route::group(['prefix' => 'category', 'middleware' => 'role:admin'], function () {
        Route::get('add', [CategoryController::class, 'create'])->name('categoryjob.create'); //add
        Route::post('store',[CategoryController::class, 'store'])->name('categoryjob.store'); //store
        Route::get('list', [CategoryController::class, 'index'])->name('categoryjob.index'); // list
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categoryjob.edit'); // edit
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('categoryjob.update'); // update
        Route::get('pagination', [CategoryController::class, 'pagination'])->name('categoryjob.pagination'); //pagination

    });

    //----SkillsController-----//
    Route::group(['prefix' => 'skill', 'middleware' => 'role:admin'], function () {
        Route::get('add', [SkillsController::class, 'create'])->name('skill.create'); //add
        Route::post('store',[SkillsController::class, 'store'])->name('skill.store'); //store
        Route::get('list', [SkillsController::class, 'index'])->name('skill.index'); // list
        Route::get('edit/{id}', [SkillsController::class, 'edit'])->name('skill.edit'); // edit
        Route::post('update/{id}', [SkillsController::class, 'update'])->name('skill.update'); // update
        Route::get('pagination-skill', [SkillsController::class, 'pagination'])->name('skill.pagination'); //pagination

    });

    // route company
    Route::group(['prefix' => 'company', 'middleware' => 'role:admin'], function () {
        Route::get('/search',[CompanyController::class, 'showCompany'])->name('company.search');
        Route::post('/addUserCompany/{id?}', [CompanyController::class, 'addCompanyUser'])->name('company.addCompanyUser');
        Route::get('/export-company',[CompanyController::class,'exportCompanyIntoCSV'])->name('export-company');
        Route::post('file/upload', [CompanyController::class,'uploadFile'])->name('file.upload');
        Route::post('/updateUserCompany', [CompanyController::class, 'updateCompanyUser'])->name('company.updateCompanyUser');
        Route::get('/get-user-company',[CompanyController::class,'getUserByCompanyId'])->name('get-user.company');
        Route::get('/get-file-upload-company',[CompanyController::class,'getFileUploadOfCompany'])->name('get.file.upload.company');
        // route action user
        Route::post('/delete-user', [CompanyController::class, 'deleteUserCompany'])->name('user.company.delete');
    });

    // route jobs
    Route::group(['prefix' => 'job',  'middleware' => 'role:store'], function (){
        Route::get('/', [JobController::class, 'index'])->name('jobs.index'); // list
        Route::get('/search',[JobController::class, 'showJob'])->name('jobs.search.pagination');
        Route::get('/create/{id?}',[JobController::class, 'create'])->name('job.create');
        Route::post('/confirm',[JobController::class, 'confirmCreate'])->name('job.confirm.create');
        Route::get('/detail',[JobController::class, 'getDetail'])->name('job.detail');
        Route::post('/store',[JobController::class, 'store'])->name('job.store');
        Route::get('/edit/{id?}',[JobController::class, 'edit'])->name('job.edit');
        Route::post('/update',[JobController::class, 'update'])->name('job.update');
        Route::post('/duplicate',[JobController::class, 'duplicate'])->name('job.duplicate');
    });

    //----Route Occupation-----//
    Route::group(['prefix' => 'occupation','middleware' => 'role:store'],function () {
        Route::get('/', [OccupationController::class, 'index'])->name('occupation.index');
        Route::get('/create', [OccupationController::class, 'create'])->name('occupation.create');
        Route::post('/store', [OccupationController::class, 'store'])->name('occupation.store');
        Route::get('/edit/{id}', [OccupationController::class, 'edit'])->name('occupation.edit');
        Route::post('/update/{id}', [OccupationController::class, 'update'])->name('occupation.update');
        Route::post('delete', [OccupationController::class, 'destroy'])->name('occupation.delete'); //delete
        Route::get('pagination', [OccupationController::class, 'pagination'])->name('occupation.pagination'); //pagination
        Route::post('upload-images', [OccupationController::class,'ajaxImageUploadPost'])->name('images.store');
        Route::post('delete', [OccupationController::class, 'destroy'])->name('occupation.delete'); //delete
        Route::get('pagination', [OccupationController::class, 'pagination'])->name('occupation.pagination'); //pagination

    });

    Route::resource('/company', CompanyController::class)->except(['show','destroy'])->middleware('role:admin');
    Route::post('/getDistrict', [AreaController::class, 'getDistrict'])->name('company.getDistrict');

    //route store
    Route::group(['prefix' => 'store', 'middleware' => 'role:company'], function () {
        Route::get('/', [StoreController::class, 'index'])->name('store.index');
        Route::get('/create', [StoreController::class, 'create'])->name('store.create');
        Route::post('/store', [StoreController::class, 'store'])->name('store.store');
        Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('store.edit');
        Route::post('/update/{id}', [StoreController::class, 'update'])->name('store.update');
        Route::get('/delete/{id}', [StoreController::class, 'delete'])->name('store.delete');
        Route::post('/search',[StoreController::class, 'search'])->name('store.search');
        Route::get('/list_user', [StoreController::class, 'getUserByStore'])->name('store.user.list');
        Route::post('/add_user', [StoreController::class, 'addStoreUser'])->name('store.user.add');
        Route::post('/update_user', [StoreController::class, 'updateStoreUser'])->name('store.user.update');
        Route::post('/delete_user', [StoreController::class, 'deleteStoreUser'])->name('store.user.delete');
    });

    Route::group(['prefix' => 'worker', 'middleware' => 'role:admin'], function () {
        Route::get('/', [WorkerControllerAdmin::class, 'index'])->name('admin.worker.index');
        Route::get('/search',[WorkerControllerAdmin::class, 'showWorkers'])->name('workers.search.pagination');
        Route::post('/delete', [WorkerControllerAdmin::class, 'deleteWorker'])->name('delete.worker');
        Route::get('/edit/{id}', [WorkerControllerAdmin::class, 'edit'])->name('admin.worker.edit');
        Route::post('/edit/{id}', [WorkerControllerAdmin::class, 'update'])->name('admin.worker.update');
        Route::get('/show/{id}', [WorkerControllerAdmin::class, 'show'])->name('admin.worker.show');
        Route::post('/approveProfile/{id}', [WorkerControllerAdmin::class, 'approveProfile'])->name('admin.worker.approveProfile');
        Route::post('/rejectProfile/{id}', [WorkerControllerAdmin::class, 'rejectProfile'])->name('admin.worker.rejectProfile');
    });

});

Route::get('/{slug?}',[PublicController::class, 'index']);
