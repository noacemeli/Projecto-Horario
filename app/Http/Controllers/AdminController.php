<?php

namespace App\Http\Controllers;
use App\Models\Solicitud;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function __construct()
    {
    $this->middleware('auth');
    $this->middleware('rol:admin'); // Middleware para el rol de "admin" en AdminController
    }

    public function showPending()
    {
        // Obtener todas las solicitudes pendientes
        $solicitudesPendientes = Solicitud::where('estado', 'pendiente')->get();

        // Mostrar las solicitudes pendientes en una vista
        return view('admin.solicitudes.pending', ['solicitudes' => $solicitudesPendientes]);
    }

    public function approve(Solicitud $solicitud)
    {
        // Aprobar la solicitud
        $solicitud->update(['estado' => 'aprobada']);

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Solicitud aprobada correctamente');
    }

    public function reject(Solicitud $solicitud)
    {
        // Rechazar la solicitud
        $solicitud->update(['estado' => 'rechazada']);

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Solicitud rechazada correctamente');
    }
}
