<?php

use App\Http\Controllers\SavingController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'userIndex'])->name('index')->middleware('isUser');

Route::get('/home', function () {
    return view('home');
})->name('about');

Route::middleware('isGuest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');

    Route::get('/signup', function () {
        return view('auth.signup');
    })->name('signup');
    Route::post('/signup', [UserController::class, 'signup'])->name('signup.submit');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// user
Route::middleware('isUser')->group(function () {
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::get('/transactions/chart', [TransactionController::class, 'chartPengeluaran'])->name('transactions.chart');
    Route::prefix('/savings')->group(function () {
        Route::get('/', [SavingController::class, 'index'])->name('savings.index');
        Route::post('/store', [SavingController::class, 'store'])->name('savings.store');
    });
    Route::prefix('/targets')->group(function () {
        Route::get('/', [TargetController::class, 'index'])->name('targets.index');
        Route::post('/store', [TargetController::class, 'store'])->name('targets.store');
        Route::get('/create', [TargetController::class, 'create'])->name('targets.create');
        Route::delete('/delete/{id}', [TargetController::class, 'destroy'])->name('targets.destroy');
    });
});

// admin

Route::middleware('isAdmin')->prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::prefix('/data-staff')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.data-staff.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.data-staff.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.data-staff.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.data-staff.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.data-staff.update');
        Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('admin.data-staff.destroy');
        Route::patch('/restore/{id}', [UserController::class, 'restore'])->name('admin.data-staff.restore');
        Route::delete('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('admin.data-staff.force-delete');
        Route::get('/trash', [UserController::class, 'trash'])->name('admin.data-staff.trash');
        Route::get('/export', [UserController::class, 'exportExcel'])->name('admin.data-staff.export');
    });
});

// staff
Route::middleware('isStaff')->prefix('/staff')->group(function () {
    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');

    Route::prefix('/data-user')->group(function () {
        Route::get('/', [UserController::class, 'indexUser'])->name('staff.data-user.index');
        Route::get('/create', [UserController::class, 'createUser'])->name('staff.data-user.create');
        Route::post('/store', [UserController::class, 'storeUser'])->name('staff.data-user.store');
        Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('staff.data-user.edit');
        Route::put('/update/{id}', [UserController::class, 'updateUser'])->name('staff.data-user.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroyUser'])->name('staff.data-user.destroy');
        Route::get('/trash', [UserController::class, 'trashUser'])->name('staff.data-user.trash');
        Route::patch('/restore/{id}', [UserController::class, 'restoreUser'])->name('staff.data-user.restore');
        Route::delete('/force-delete/{id}', [UserController::class, 'forceDeleteUser'])->name('staff.data-user.force-delete');
    });
});
