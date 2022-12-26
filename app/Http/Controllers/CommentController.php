<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
    }
    
    public function save(Request $request) {
        //validación
        $validate = $this->validate($request, [
           'image_id' => ['integer', 'required'],
           'content' => ['string', 'required']
        ]);
        //recoger datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        
        //asignar valores al objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        
        //guardar en la base de datos
        $comment->save();
        
        //redirección
        return redirect()->route('image.detail', ['id' => $image_id])        
                        ->with([
                            'message' => 'Tu comentario se ha publicado!!'
                        ]);
    }
    
    public function delete($id) {
        //conseguir datos del usuario identificado
        $user = \Auth::user();
        
        //conseguir objeto del comentario
        $comment = Comment::find($id);
        
        //comprobar si soy el dueño del comentario o de la publicación
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $comment->image->user_id])        
                        ->with([
                            'message' => 'Tu comentario se ha eliminado!!'
                        ]);
        }else{
            return redirect()->route('image.detail', ['id' => $comment->image->user_id])        
                        ->with([
                            'message' => 'Tu comentario no se ha podido eliminar!!'
                        ]);
        }
       
    }
}
