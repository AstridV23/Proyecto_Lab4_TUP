@extends('layouts.invention')

@section('titulo', 'Página Principal')

@section('contenido')
    <h1>Buscar en el sistema</h1>

    <form action="{{ route('home') }}" method="GET" class="form-inline mb-4">
        <input type="text" name="search" value="{{ old('search', $searchTerm) }}" class="form-control" placeholder="Buscar..." />
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <div class="search-results">
        <h3>Resultados de la búsqueda</h3>

        <h4>Cursos</h4>
        <ul>
            @foreach ($courses as $course)
                <li>{{ $course->name }}</li>
            @endforeach
        </ul>

        <h4>Comisiones</h4>
        <ul>
            @foreach ($commissions as $commission)
                <li>{{ $commission->aula }} - {{ $commission->horario }}</li>
            @endforeach
        </ul>

        <h4>Estudiantes</h4>
        <ul>
            @foreach ($students as $student)
                <li>{{ $student->name }}</li>
            @endforeach
        </ul>

        <h4>Profesores</h4>
        <ul>
            @foreach ($professors as $professor)
                <li>{{ $professor->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
