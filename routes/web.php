

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VotingController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');



Auth::routes();

/*------------------------------------------
| All Normal Users (Voters) Routes
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('voter.home');

    // Home untuk voter
    Route::get('/voter/home', [HomeController::class, 'index'])->name('voter.home');

    // Halaman kandidat untuk voter
    Route::get('/voter/candidates', [CandidateController::class, 'voterIndex'])->name('voter.candidates');

    Route::get('/voter', [CandidateController::class, 'show'])->name('voter.show');
    Route::get('/voter/showpilihan', [CandidateController::class, 'showPilihan'])->name('voter.showpilihan');

    // Route untuk menyimpan suara
    Route::post('/voter/vote', [VotingController::class, 'store'])->name('vote.store');
});

/*------------------------------------------
| All Admin Routes
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.adminHome');
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');

    // Route untuk mengelola kandidat
    Route::prefix('admin/candidate')->group(function () {
        Route::get('/', [CandidateController::class, 'index'])->name('admin.candidate.index');
        Route::get('/create', [CandidateController::class, 'create'])->name('admin.candidate.create');
        Route::post('/', [CandidateController::class, 'store'])->name('admin.candidate.store');
        Route::get('/{id}/edit', [CandidateController::class, 'edit'])->name('admin.candidate.edit');
        Route::put('/{id}', [CandidateController::class, 'update'])->name('admin.candidate.update');
        Route::delete('/{id}', [CandidateController::class, 'destroy'])->name('admin.candidate.destroy');
    });
});

/*------------------------------------------
| All Manager Routes
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});

/*------------------------------------------
| Shared Routes (Profile and Settings)
--------------------------------------------*/
Route::middleware(['auth'])->group(function () {

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});

