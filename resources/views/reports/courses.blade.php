@extends('layouts.invention')

@section('titulo', 'Reporte de Cursos por Materia')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Cursos por Materia</h2>
        <div class="btn-group">
            <a href="{{ route('reports.courses.pdf') }}" class="btn btn-outline-danger" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a href="{{ route('reports.courses.excel') }}" class="btn btn-outline-success" title="Exportar a Excel">
                <i class="fas fa-file-excel"></i>
            </a>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @forelse ($subjects as $subject)
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-book text-primary me-2"></i>
                        <h5 class="mb-0">{{ $subject['name'] }}</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Comisiones</th>
                                    <th>Estudiantes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subject['courses'] as $course)
                                    <tr>
                                        <td>{{ $course['name'] }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $course['commissions_count'] }} comisiones
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $course['students_count'] ?? 0 }} estudiantes
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No hay cursos para esta materia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="fas fa-info-circle text-info mb-3 fs-2"></i>
                    <p class="text-muted">No hay materias registradas en el sistema</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
