@extends('layouts.invention')

@section('titulo', 'Reporte de Cursos por Materia')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Cursos por Materia</h2>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @forelse ($subjects as $subject)
                <div class="mb-4">
                    <h4 class="mb-3">{{ $subject['name'] }}</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Cantidad de Comisiones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subject['courses'] as $course)
                                    <tr>
                                        <td>{{ $course['name'] }}</td>
                                        <td>{{ $course['commissions_count'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No hay cursos para esta materia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <p class="text-center">No hay materias registradas</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
