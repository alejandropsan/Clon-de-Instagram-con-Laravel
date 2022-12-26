<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;

class UserController extends Controller{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($search = null) {
        if(!empty($search)){
            $users = User::where('nickname', 'LIKE', '%'.$search.'%')
                              ->orWhere('name', 'LIKE', '%'.$search.'%')
                              ->orWhere('subname', 'LIKE', '%'.$search.'%')
                              ->orderBy('id', 'desc')
                              ->paginate(5);
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
        }
        
        
        return view('user.index', [
            'users' => $users
        ]);
    }
    
    public function config() {
        return view('user.config');
    }
    
    public function update(Request $request) {
        
        //Conseguir usuario identificado
        $user = \Auth::user();
        $id = \Auth::user()->id;
        
        //Validación del formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'subname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);
        
        //Recoger los datos del formulario
        $id = \Auth::user()->id;
        $name = $request->input('name');
        $subname = $request->input('subname');
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        
        //Asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->subname = $subname;
        $user->nickname = $nickname;
        $user->email = $email;
        
        //Subir la imagen
        $image_path = $request->file('image_path');
        if($image_path){
            //Poner nombre único
            $image_path_name = time().$image_path->getClientOriginalName();
            
            //Guardar en la carpeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            
            //Seteo el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        //Ejecutar consulta y cambios en la base de datos
        $user->update();
        
        return redirect()->route('config')
                         ->with(['message' => 'Usuario actualizado correctamente']);
    }
    
    public function getImage($filename) {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    public function profile($id) {
        $user = User::find($id);
        
        return view('user.profile', [
            'user' => $user
        ]);
    }
    
    
}
