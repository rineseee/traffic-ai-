<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TrafficController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AdminPostController;



/*
|--------------------------------------------------------------------------
| Rrugët publike (për të gjithë)
|--------------------------------------------------------------------------
*/

Route::post('/chatbot/ask', [ChatbotController::class, 'ask']);
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/', [TrafficController::class, 'index'])->name('home');
Route::get('/search', [TrafficController::class, 'search'])->name('search');
Route::post('/report', [TrafficController::class, 'storeUserReport'])->name('report.store');
Route::get('/traffic-assistant', function () {
    return view('traffic-assistant');
})->name('traffic-assistant');


/*
|--------------------------------------------------------------------------
| Dashboard për admin (me middleware 'is_admin')
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware(IsAdmin::class);
});


/*
|--------------------------------------------------------------------------
| Profile (edit, update, delete)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Postimet (CRUD) dhe AI – vetëm për të kyçurit
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['show']);
    Route::get('/user/posts/search', [PostController::class, 'search'])->name('posts.search');
    Route::get('/postimet', [PostController::class, 'index'])->name('posts.index');
    Route::get('/traffic', [TrafficController::class, 'index'])->name('traffic.index');
    // Route::get('/dashboard', [TrafficController::class, 'dashboard'])->name('dashboard');
    Route::post('/ai-suggestions', [TrafficController::class, 'submitAIQuestion'])->name('ai.suggestions.submit');
    // Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('auth')->name('dashboard');
});

Route::post('/chatbot/ask', [ChatbotController::class, 'ask'])->name('ai.submit');
Route::post('/ask-ai', [TrafficController::class, 'submitAIQuestion'])->name('ai.ask');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//routat per admin
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
});


require __DIR__ . '/auth.php';
