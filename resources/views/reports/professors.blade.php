@extends('layouts.invention')

@section('titulo', 'Reporte de Profesores')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Asistencia de Profesores</h2>
        <div class="btn-group">
            <a href="{{ route('reports.professors.pdf') }}" class="btn btn-outline-danger" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a href="{{ route('reports.professors.excel') }}" class="btn btn-outline-success" title="Exportar a Excel">
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
                            <th>Profesor</th>
                            <th>Email</th>
                            <th>Comisiones</th>
                            <th>Horarios</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($professors as $professor)
                            <tr>
                                <td>{{ $professor->name }}</td>
                                <td>{{ $professor->email }}</td>
                                <td>
                                    @foreach($professor->commissions as $commission)
                                        <span class="badge bg-info me-1">{{ $commission->course->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($professor->commissions as $commission)
                                        <div class="small text-muted">{{ $commission->schedule }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge bg-success">Activo</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay profesores registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($professors->hasPages())
            <div class="card-footer">
                <ul class="pagination justify-content-end mb-0">
                    @if($professors->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">Anterior</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $professors->previousPageUrl() }}">Anterior</a>
                        </li>
                    @endif

                    @if($professors->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $professors->nextPageUrl() }}">Siguiente</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">Siguiente</span>
                        </li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection