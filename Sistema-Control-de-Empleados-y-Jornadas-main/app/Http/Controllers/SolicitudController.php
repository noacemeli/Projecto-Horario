<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SolicitudController extends Controller
{
    protected function validator(array $data){
        return Validator::make( $data, [
            'title'=>['required', 'string', 'max:255'],
            'start'=>['required', 'date'],
            'end'=>['required', 'date']
        ]);
    }
    public function create(Request $request){

        $this->validator($request->all())->validate();
        $id_user=Auth::user()->id;

        Solicitud::create([
            'id_user'=>$id_user,
            'titulo'=>$request['title'],
            'fecha_inicio'=>$request['start'],
            'fecha_final'=>$request['end'],
        ]);
        return redirect()->back()->with('success', 'Solicitud enviada correctamente');
    }
}
