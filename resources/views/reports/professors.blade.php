@extends('layouts.invention')

@section('titulo', 'Reporte de Profesores')

@section('contenido')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reporte de Asistencia de Profesores</h2>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Profesor</th>
                            <th>Comisiones Asignadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($professors as $professor)
                            <tr>
                                <td>{{ $professor['name'] }}</td>
                                <td>
                                    @forelse ($professor['commissions'] as $commission)
                                        <div class="mb-2">
                                            <strong>{{ $commission['course'] }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                Comisión: {{ $commission['name'] }}
                                                <br>
                                                Horario: {{ $commission['schedule'] }}
                                            </small>
                                        </div>
                                    @empty
                                        <span class="text-muted">Sin comisiones asignadas</span>
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No hay profesores registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection