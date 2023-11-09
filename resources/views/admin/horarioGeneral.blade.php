

@extends('layouts.app')

@section('content')
    <!--link per el funcionamnet de la taula -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!--link per el funcionamnet de la taula -->
    <script>
        $(document).ready(function() {
            $('#horarioTable').DataTable();
        });
    </script>


    <h1 class="text-center">Panel de control del Administrador</h1>



    <div class="py-4 d-flex col-lg-9 gap-5 w-100">

        <div class="d-flex col-lg-2">
            @include('layouts._partials.nav')
        </div>

        <div class="col-lg-11 d-flex">

            <form action="{{ route('admin.horarioGeneral') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <label for="mes">Seleccionar:</label>
                        <!-- Desplegable de Mes -->
                        <select name="mes" id="mes" class="form-control">
                            @php
                                $meses = [
                                    1 => 'Enero',
                                    2 => 'Febrero',
                                    3 => 'Marzo',
                                    4 => 'Abril',
                                    5 => 'Mayo',
                                    6 => 'Junio',
                                    7 => 'Julio',
                                    8 => 'Agosto',
                                    9 => 'Septiembre',
                                    10 => 'Octubre',
                                    11 => 'Noviembre',
                                    12 => 'Diciembre',
                                ];
                            @endphp

                            <option value="" @if (!$mes) selected @endif>Mes</option>
                            @foreach ($meses as $key => $nombreMes)
                                <option value="{{ $key }}" @if ($mes == $key) selected @endif>
                                    {{ $nombreMes }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="anio">Seleccionar:</label>
                        <!-- Desplegable de Año -->
                        @php
                            $yearRange = range(date('Y') - 10, date('Y') + 10);
                        @endphp

                        <select name="anio" id="anio" class="form-control">
                            <option value="" @if (!$anio) selected @endif>Año</option>
                            @foreach ($yearRange as $year)
                                <option value="{{ $year }}" @if ($anio == $year) selected @endif>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
            </form>

            <section>
                <table id="horarioTable" class="table mx-5 text-center w-100">
                    <thead class="table-primary">
                        <th>Nombre</th>
                        <th>Fecha y Hora de Entrada</th>
                        <th>Fecha y Hora de Salida</th>
                        <th>Horas trabajadas</th>
                    </thead>
                    <tbody>
                        @foreach ($horarioGeneral as $registro)
                            <tr>
                                <td>{{ $registro->user->name }}</td>
                                <td>{{ $registro->entrada }}</td>
                                <td>{{ $registro->salida }}</td>
                                <td>
                                    <?php
                                    $entrada = \Carbon\Carbon::parse($registro->entrada);
                                    $salida = \Carbon\Carbon::parse($registro->salida);
                                    $diferencia = $salida->diff($entrada);
                                    echo $diferencia->format('%H:%I');
                                    ?>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button id="exportCSV" class="btn btn-success mt-3">Exportar a CSV</button>
                <script>
                    $('#exportCSV').on('click', function() {
                        // Captura los datos de la tabla DataTables actualmente mostrados en la página
                        var table = $('#horarioTable').DataTable();
                        var filteredData = table.rows({ search: 'applied' }).data();

                        var csvData = "Nombre,Fecha y Hora de Entrada,Fecha y Hora de Salida,Horas trabajadas\n";

                        // Itera a través de los datos filtrados y los agrega al CSV
                        filteredData.each(function (value, index) {
                            csvData += value.join(',') + '\n';
                        });

                        // Crea un enlace temporal y simula un clic para descargar el archivo
                        var blob = new Blob([csvData], {
                            type: 'text/csv'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'Horario.csv';
                        link.click();
                    });
                </script>

                <div class="d-flex justify-content-center">
                    {{ $horarioGeneral->links() }}
                </div>
            </section>
        </div>
    </div>
@endsection
