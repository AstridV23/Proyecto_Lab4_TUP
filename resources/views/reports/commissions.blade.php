@extends('layouts.invention')

@section('titulo', 'Reporte de Comisiones')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Comisiones y Horarios</h2>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Reporte de Comisiones</h5>
            <div class="btn-group">
                <button type="button" class="btn btn-light" data-bs-toggle="tooltip" title="Exportar a PDF">
                    <i class="fas fa-file-pdf text-danger"></i>
                </button>
                <button type="button" class="btn btn-light" data-bs-toggle="tooltip" title="Exportar a Excel">
                    <i class="fas fa-file-excel text-success"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Materia</th>
                            <th>Curso</th>
                            <th>Aula</th>
                            <th>Horario</th>
                            <th>Profesores</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commissions as $commission)
                            <tr>
                                <td>{{ $commission['subject'] }}</td>
                                <td>{{ $commission['course'] }}</td>
                                <td>{{ $commission['classroom'] }}</td>
                                <td>{{ $commission['schedule'] }}</td>
                                <td>
                                    @forelse ($commission['professors'] as $professor)
                                        <div>{{ $professor }}</div>
                                    @empty
                                        <span class="text-muted">Sin profesores asignados</span>
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay comisiones registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection