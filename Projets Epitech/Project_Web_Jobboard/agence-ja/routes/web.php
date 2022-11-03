<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\CompanyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Post\JobalertController;
use App\Http\Controllers\Post\PostalertController;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    $alljob = DB::table('job_alerts')
    ->join('companies', 'job_alerts.companies_id', '=', 'companies.id')
    ->select(
        'job_alerts.id',
        'job_alerts.title',
        'job_alerts.content',
        'job_alerts.job_type',
        'job_alerts.wage',
        'job_alerts.updated_at',
        'job_alerts.secteur',
        'job_alerts.wage_type',
        'companies.name',
        'companies.description',
    )->paginate(5);

    return view('master', compact('alljob'));

})->name('/');


Route::get('/login', function () {

    return view('loginUser');

})->name('login');


///// AUTHENTIFICATION

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');


Route::resource('users', UserController::class)->except('index');

Route::resource('companies', CompanyController::class)->except('index');

Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', function () {
        if (session('role') == 2) {
            $user = Auth::user();
            $company = DB::table('companies')->where('users_id', '=', $user['id'])->first();

            if ($company != null) {
                $posts = DB::table('job_alerts')->where('companies_id', '=', $company->id)->get();

                return view('dashboardUser', compact('posts'));
            } else {
                $posts = '';
                return view('dashboardUser', compact('posts'));
            }

        } else if (session('role') == 1) {
            $user = Auth::user();
            $company = Company::all();

            if ($company != null) {
                $postUser = DB::table('post_alerts')->where('users_id', '=', $user['id'])->get();

                if ($postUser != NULL) {

                    $postJob = collect();

                    foreach ($postUser as $post) {
                        $posts = DB::table('job_alerts')->where('id', '=', $post->job_alerts_id)->first();
                        $postComp = DB::table('companies')->where('id', '=', $posts->companies_id)->first();

                        $postJob->push(['id' =>  $posts->id, 'title' => $posts->title, 'content' => $posts->content, 'wage' => $posts->wage,
                        'wage_type' => $posts->wage_type, 'job_type' => $posts->job_type, 'updated_at' => $posts->updated_at, 'secteur' => $posts->secteur, 'name' => $postComp->name, 'description' => $postComp->description
                    ]);

                    }

                    return view('dashboardUser', compact('postJob'));
                } else {
                    $postJob = '';
                    return view('dashboardUser', compact('postJob'));
                }
            } else {
                return view('dashboardUser', compact('postJob'));
            }
        } else {
            return view('dashboardUser', compact('postJob'));
        }
    })->name('dashboard');



    Route::post('postalert/{id}', [PostalertController::class, 'store'])->name('postalert.store');
    Route::get('postalert/{id}', [PostalertController::class, 'show'])->name('postalert.show');

    Route::resource('jobsalert', JobalertController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function () {

        Route::resource('users', AdminUserController::class);
        Route::resource('companies', AdminCompanyController::class);
        Route::resource('posts', AdminPostController::class);

    });

});











/// COMPANIES
Route::get('/show-companies', [CompanyController::class, 'index'])->name('show-companies');
// dashboard(company)
// Route::get('/dashboard-company', [CompanyController::class, 'dashboardCompany'])->name('dashboard-company');

// logout(user && company)
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


