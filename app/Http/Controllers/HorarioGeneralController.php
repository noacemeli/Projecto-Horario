<?php


namespace App\Http\Controllers;

use League\Csv\Writer;
use Illuminate\Support\Collection;
use App\Models\Registro;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HorarioGeneralController extends Controller
{

    //Recogerlosdatos--------------------------------------------------------------------
    public function horarioGeneral(Request $request)
    {
        $mes = $request->input('mes');
        $anio = $request->input('anio');

        $horarioGeneral = Registro::with('user')
            ->paginate(1000000);


        return view('admin.horarioGeneral', compact('horarioGeneral', 'mes', 'anio'));
    }

    //Recoger los datos filtrados--------------------------------------------------------
    public function filtrar(Request $request)
    {
        $mes = $request->input('mes');
        $anio = $request->input('anio');

        $horarioGeneral = Registro::whereMonth('entrada', $mes)
            ->whereYear('entrada', $anio)
            ->paginate(1000000);

        // Resto del código del controlador

        return view('admin.horarioGeneral', compact('horarioGeneral', 'mes', 'anio'));
    }

    //recoger los datos para exportar en csv---------------------------------------------
    public function exportarCSV()
    {
        $horarioGeneral = Registro::all(); // Recupera todos los registros

        $csvData = "Nombre,Fecha y Hora de Entrada,Fecha y Hora de Salida,Horas trabajadas\n";

        foreach ($horarioGeneral as $registro) {
            $entrada = \Carbon\Carbon::parse($registro->entrada);
            $salida = \Carbon\Carbon::parse($registro->salida);
            $diferencia = $salida->diff($entrada);

            $csvData .= "{$registro->user->name},{$registro->entrada},{$registro->salida},{$diferencia->format('%H:%I')}\n";
        }

        $fileName = 'horario_general.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return Response::make($csvData, 200, $headers);
    }
}
