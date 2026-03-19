<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataCollection\BranchesController;
use App\Http\Controllers\DataCollection\DepartmentController;
use App\Http\Controllers\NewTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});


// Register
Route::get('auth/register', [AuthController::class,'showRegister'])->name('register');
Route::post('auth/register', [AuthController::class, 'registerUser']);

// Login
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'logUserIn']);

// Logout
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function(){

    // Dashboard
    Route::get('home_page/dashboard', [DashboardController:: class, 'index'])->middleware('auth')->name('home');
    
    
    // // Registered Users info page
    // Route::get('information/info', [InformationController::class, 'index'])->name('registered.users');
    
    // New Ticket
    Route::get('/new_ticket', [NewTicketController::class, 'index'])->name('new.ticket');
    Route::post('/new_ticket', [NewTicketController::class, 'ticket_store']);
    
    // // Fetch Registered Users
    // Route::get('information/info', [InformationController::class, 'index'])-> name('registered.users');
    
    // Download Sample Table
    // Route::get('download_table', [InformationController::class, 'download_table']);
    
    
    // Departments
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::post('/departments', [DepartmentController::class, 'departments_store'])->name('departments.store');
    Route::get('/departments/datatable', [DepartmentController::class, 'departments_datatable'])->name('departments.datatable'); 
    Route::put('/departments/{id}', [DepartmentController::class, 'departments_update'])->name('departments.update');
    
    // Delete
    Route::delete('/departments/{id}', [DepartmentController::class, 'department_destroy'])->name('department.destroy');
    Route::delete('/departments', [DepartmentController::class, 'bulk_department_destroy'])->name('department.bulk_destroy');
    
    
    // Branches
    Route::get('/branches', [BranchesController::class, 'index'])->name('branches');
    Route::post('/branches', [BranchesController::class, 'branches_store']);
    Route::get('/branches/datatable', [BranchesController::class, 'branches_datatable'])->name('branches.datatable');
    Route::put('/branches/{id}', [BranchesController::class, 'branches_update'])->name('branches.update');
    Route::delete('/branches/{id}', [BranchesController::class, 'branches_destroy'])->name('branches.destroy');
    Route::delete('/branches', [BranchesController::class, 'bulk_branch_destroy'])->name('branch.bulk_destroy');

});

