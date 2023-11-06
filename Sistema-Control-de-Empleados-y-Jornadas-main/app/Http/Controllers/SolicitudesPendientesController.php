<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Solicitud;

class SolicitudesPendientesController extends Controller
{
    public function showPending(){
        // Obtener todas las solicitudes pendientes
        $solicitudesPendientes = Solicitud::where('aprobada', false)->get();

        // Mostrar las solicitudes pendientes en una vista
        return view('admin.solicitudes_pendientes', ['solicitudes' => $solicitudesPendientes]);
    }

    public function approve(Solicitud $solicitud)
    {
        // Aprobar la solicitud
        $solicitud->update(['aprobada' => true]);

        Evento::create([
            'id_user'=>$solicitud->id_user,
            'title'=>$solicitud->titulo,
            'start'=>$solicitud->fecha_inicio,
            'end'=>$solicitud->fecha_final
        ]);

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Solicitud aprobada correctamente');
    }

    public function reject(Solicitud $solicitud)
    {
        // Rechazar la solicitud
        $solicitud->delete();

        // Redireccionar o mostrar un mensaje de éxito
        return redirect()->back()->with('success', 'Solicitud rechazada correctamente');
    }
}
