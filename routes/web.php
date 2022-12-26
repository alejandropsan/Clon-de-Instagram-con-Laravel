<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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
//use App\Models\Image;

Route::get('/', function () {
  
    /*
    $images = Image::all();
    foreach ($images as $image) {
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo $image->user->name.' '.$image->user->subname."<br/>";
        
        if(count($image->comments) >= 1){
            echo "<br/><h4>Comentarios </h4>";
            foreach ($image->comments as $comment) {
            echo $comment->user->name.' '.$comment->user->subname.": ";
            echo $comment->content;
            echo"<br/>";
            }
        }
        
        echo "LIKES: ".count($image->likes);
        
        echo "<hr/>";
    }
    die();
    */
    
    return view('welcome');
});

Auth::routes();
//GENERALES
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USUARIO
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('avatar');
Route::get('/perfil/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/perfiles/{search?}', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');


//IMAGEN
Route::get('/subir-imagen', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/imagen/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/delete/{id}', [App\Http\Controllers\ImageController::class, 'delete'])->name('image.delete');
Route::get('/imagen_editar/{id}', [App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update', [App\Http\Controllers\ImageController::class, 'update'])->name('image.update');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');


//COMENTARIO
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');


//LIKE
Route::get('/like/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [App\Http\Controllers\LikeController::class, 'disLike'])->name('like.delete');
Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes');


