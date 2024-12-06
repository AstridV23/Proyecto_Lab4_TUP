@extends('layouts.invention')

@section('titulo', 'Reporte de Comisiones')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Comisiones y Horarios</h2>
        <div class="btn-group">
            <a href="{{ route('reports.commissions.pdf') }}" class="btn btn-outline-danger" title="Exportar a PDF">
                <i class="fas fa-file-pdf"></i>
            </a>
            <a href="{{ route('reports.commissions.excel') }}" class="btn btn-outline-success" title="Exportar a Excel">
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
                                        <span class="badge bg-info me-1">
                                            {{ $professor }}
                                        </span>
                                    @empty
                                        <span class="badge bg-secondary">Sin profesores</span>
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
        <div class="card-footer">
            <ul class="pagination justify-content-end mb-0">
                @if($commissions->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Anterior</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $commissions->previousPageUrl() }}">Anterior</a>
                    </li>
                @endif

                @if($commissions->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $commissions->nextPageUrl() }}">Siguiente</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Siguiente</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection