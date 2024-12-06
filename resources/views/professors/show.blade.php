@extends('layouts.invention')

@section('titulo', 'Detalles del Profesor')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Información del Profesor</h5>
            <a href="{{ route('professors.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="card-subtitle mb-2 text-muted">Información Personal</h6>
                    <p><strong>Nombre:</strong> {{ $professor->name }}</p>
                    <p><strong>Especialización:</strong> {{ $professor->specialization }}</p>
                </div>
                
                <div class="col-md-12 mt-4">
                    <h6 class="card-subtitle mb-2 text-muted">Comisiones Asignadas</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Curso</th>
                                    <th>Aula</th>
                                    <th>Horario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($professor->commissions as $commission)
                                    <tr>
                                        <td>{{ $commission->course->name }}</td>
                                        <td>{{ $commission->aula }}</td>
                                        <td>{{ $commission->horario }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No hay comisiones asignadas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
