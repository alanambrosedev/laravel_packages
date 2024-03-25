<?php

use App\DataTables\UsersDataTable;
use App\Helpers\ImageFilter;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

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
    return view('welcome');
});

Route::get('/dashboard', function (UsersDataTable $dataTable) {
    // $users = User::paginate(10);

    // return view('dashboard', compact('users'));
    return $dataTable->render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('image', function () {
    $img = Image::make('download.png');
    $img->filter(new ImageFilter(100));
    // // $img->crop(400, 400);
    // ->fit(400,400)
    // // $img->blur(15);
    // ->greyscale();
    // $img->save('download4.jpg', 5);
    return $img->response();
});

Route::get('user/{id}/edit', function ($id) {
    return $id;
})->name('user.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
