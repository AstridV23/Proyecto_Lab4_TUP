@extends('layouts.invention')

@section('titulo', 'Reporte de Estudiantes')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Estudiantes Inscritos</h2>
        <div class="btn-group">
            <a href="{{ route('reports.students.pdf') }}" class="btn btn-outline-danger" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a href="{{ route('reports.students.excel') }}" class="btn btn-outline-success" title="Exportar a Excel">
                <i class="fas fa-file-excel"></i>
            </a>
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                                    @foreach ($student['enrollments'] as $enrollment)
                                        <span class="badge bg-primary">
                                            {{ $enrollment['subject'] }} - {{ $enrollment['commission'] }}
                                        </span>
                                    @endforeach
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
            {{ $students->links() }}
        </div>
    </div>
</div>
@endsection
