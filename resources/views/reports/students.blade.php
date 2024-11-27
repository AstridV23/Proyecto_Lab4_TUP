@extends('layouts.invention')

@section('titulo', 'Reporte de Estudiantes')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Estudiantes Inscritos</h2>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Reporte de Estudiantes</h5>
            <div class="btn-group">
                <a href="{{ route('reports.students.pdf') }}" class="btn btn-light" data-bs-toggle="tooltip" title="Exportar a PDF">
                    <i class="fas fa-file-pdf text-danger"></i>
                </a>
                <a href="{{ route('reports.students.excel') }}" class="btn btn-light" data-bs-toggle="tooltip" title="Exportar a Excel">
                    <i class="fas fa-file-excel text-success"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Cursos y Comisiones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student['name'] }}</td>
                                <td>{{ $student['email'] }}</td>
                                <td>
                                    @forelse ($student['enrollments'] as $enrollment)
                                        <div class="mb-2">
                                            <strong>{{ $enrollment['subject'] }}</strong> - 
                                            {{ $enrollment['course'] }}
                                            <br>
                                            <small class="text-muted">Comisión: {{ $enrollment['commission'] }}</small>
                                        </div>
                                    @empty
                                        <span class="text-muted">No inscrito en ningún curso</span>
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No hay estudiantes registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Mostrando {{ $students->firstItem() }} a {{ $students->lastItem() }} de {{ $students->total() }} registros
                </div>
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
