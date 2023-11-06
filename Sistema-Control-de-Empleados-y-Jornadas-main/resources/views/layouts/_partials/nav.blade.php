<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a.text-white{
            background-color: #312F70;

        }
        a.text-white:hover{
            background-color: #4FB497;
        }
    </style>
</head>
<body>
    <nav class="position-fixed">
        <div class="d-flex flex-column gap-2 p-2">
            @if (Auth::user()->rol==='admin')
            <a class="text-white text-decoration-none nav-item btn"  href="{{route('fichar-admin')}}" >
                Fichar
            </a>
            <a href="{{route('admin.horarios')}}" class="text-white text-decoration-none nav-item btn ">
                Mis Horarios
            </a>
            <a href="{{route('admin.usuarios')}}" class="text-white text-decoration-none nav-item btn ">
                Gestionar Empleados
            </a>

            <a href="{{ route('mostrar.horario.general') }}" class="btn text-white">
                Consultar Horario General
            </a>
            <a class="text-white text-decoration-none nav-item btn " href="{{route('add.employee.form')}}">
                Añadir Empleados
            </a>
            <a class="text-white text-decoration-none nav-item btn " href="{{route('solicitudes-pendientes')}}">
                Solicitudes Pendientes
            </a>
            <a class="text-white text-decoration-none nav-item btn " href="{{route('calendario')}}">
                Calendario
            </a>
            <a class="text-white text-decoration-none nav-item btn " href="{{route('mapa')}}">
                Mapa de Fichajes
            </a>

            @else

            <a href="{{route('fichar-employee')}}" class="text-white text-decoration-none nav-item btn ">
                Fichar
            </a>
            <a href="{{route('employee.horarios')}}" class="text-white text-decoration-none nav-item btn ">
                Mis Horarios
            </a>
            <a href="{{route('solicitud')}}" class="text-white text-decoration-none nav-item btn ">
                Hacer una Solicitud
            </a>

            @endif
            <a class="text-white text-decoration-none nav-item btn " href="{{route('archivo.formulario')}}">
                Subir Archivos
            </a>
            <a class="text-white text-decoration-none nav-item btn " href="{{route('documentos')}}">
                Ver Documentos
            </a>
            </div>
    </nav>

</body>
</html>
