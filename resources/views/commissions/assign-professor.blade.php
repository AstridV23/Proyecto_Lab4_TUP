@extends('layouts.invention')

@section('titulo', 'Asignar Profesores a Comisión')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Asignar Profesores - {{ $commission->course->name }}</h5>
            <a href="{{ route('commissions.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('commissions.assign-professor.store', $commission) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Información de la Comisión</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            <p class="mb-1"><strong>Curso:</strong> {{ $commission->course->name }}</p>
                            <p class="mb-1"><strong>Aula:</strong> {{ $commission->aula }}</p>
                            <p class="mb-0"><strong>Horario:</strong> {{ $commission->horario }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Seleccionar Profesores</label>
                    <div class="card p-3">
                        @foreach($professors as $professor)
                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" 
                                       name="professor_ids[]" value="{{ $professor->id }}"
                                       id="professor{{ $professor->id }}"
                                       {{ in_array($professor->id, $assignedProfessors) ? 'checked' : '' }}>
                                <label class="form-check-label" for="professor{{ $professor->id }}">
                                    {{ $professor->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Asignaciones
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
