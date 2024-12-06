@extends('layouts.invention')

@section('titulo', 'Editar Profesor')

@section('contenido')
<div class="container-fluid px-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Profesor</h5>
            <a href="{{ route('professors.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('professors.update', $professor) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $professor->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="specialization" class="form-label">Especialización</label>
                    <input type="text" class="form-control @error('specialization') is-invalid @enderror" 
                           id="specialization" name="specialization" 
                           value="{{ old('specialization', $professor->specialization) }}" required>
                    @error('specialization')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Comisiones Asignadas</label>
                    <div class="card">
                        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                            @foreach($commissions as $commission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="commissions[]" value="{{ $commission->id }}" 
                                           id="commission{{ $commission->id }}"
                                           {{ $professor->commissions->contains($commission->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="commission{{ $commission->id }}">
                                        {{ $commission->course->name }} - {{ $commission->horario }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Actualizar Profesor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
