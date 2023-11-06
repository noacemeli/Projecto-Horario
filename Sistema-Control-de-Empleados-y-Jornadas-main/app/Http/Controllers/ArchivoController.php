<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ArchivoController extends Controller
{
    public function mostrarFormulario()
    {
        return view('archivos.formulario');
    }

    public function subirArchivo(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:jpeg,png,pdf,doc,docx|max:2048',
        ], [
            'archivo.required' => 'Debe seleccionar un archivo para subir.',
            'archivo.mimes' => 'El archivo debe ser de tipo jpeg, png, pdf, doc o docx.',
            'archivo.max' => 'El tamaño máximo del archivo es 2 MB.',
        ]);

        $empleadoId = Auth::user()->id;

        $archivo = $request->file('archivo');

        $nombreArchivo = $archivo->getClientOriginalName();

        $rutaArchivo = $archivo->store('archivos', 'public');

        Archivo::create([
            'empleado_id' => $empleadoId,
            'nombre' => $nombreArchivo,
            'ruta' => $rutaArchivo
        ]);

        return redirect()->back()->with('success', 'Archivo subido exitosamente.');
    }

    public function verMisDocs(Request $request){

        $userId=Auth::user()->id;

        $misDocs=Archivo::where('empleado_id', $userId)->get();

        return view('mis_docs', compact('misDocs'));
    }

    public function adminDocs(Request $request){

        $adminDocs=Archivo::join('users', 'users.id', '=', 'archivos.empleado_id')
        ->where('users.rol', '=','admin')
        ->get();

        return view('adminDocs',compact('adminDocs'));
    }

    public function empleados(Request $request){

        $empleados=User::where('rol','employee')->get();
        return view('admin.docsEmpleados', compact('empleados'));
    }
    public function verDocsEmpleados(Request $request){
        $empleadoId=$request->route('empleado');

        $archivos=Archivo::where('empleado_id',$empleadoId)->get();
        return view('admin.employeeDoc',compact('archivos'));
    }
}
