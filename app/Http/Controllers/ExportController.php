<?php

namespace App\Http\Controllers;
use League\Csv\Writer;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportarCSV(Request $request)
{
    $horarioGeneral = obtenerHorariosFiltrados($request->input('mes'), $request->input('anio'));

    $csv = Writer::createFromFileObject(new \SplTempFileObject());

    // Encabezados del CSV
    $csv->insertOne(['Nombre', 'Fecha y Hora de Entrada', 'Fecha y Hora de Salida', 'Horas trabajadas']);

    foreach ($horarioGeneral as $registro) {
        $csv->insertOne([
            $registro->user->name,
            $registro->entrada,
            $registro->salida,
            calcularHorasTrabajadas($registro),
        ]);
    }

    $csv->output('horarios.csv');
}

}
